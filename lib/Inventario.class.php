<?php

/**
 * Description of Inventario
 */
require_once 'Etiquetas.class.php';
$Etiquetas = new Etiquetas();

class PInventario extends Geleia
{

    function ListarInventario($OrderBy = null, $Search = null, $Paginacao = '', $sql = null, $Limite = " ")
    {
        global $db;

        if ($OrderBy == null) {
            $OrderBy = ' ORDER BY l.leit_data DESC ';
        }

        if ($Search != null) {
            $Search = " WHERE ("
                . " m.mate_codigo LIKE '%" . $Search . "%' "
                . " OR m.mate_nome LIKE '%" . $Search . "%' "
                . " OR d.depo_centro LIKE '%" . $Search . "%' "
                . " OR d.depo_empresa LIKE '%" . $Search . "%' "
                . " OR l.leit_usua_nome LIKE '%" . $Search . "%' "
                . ") ";
        }

        $GroupBy = null;

        if ($sql == null) {

            $sql = 'SELECT * 
                FROM etiquetas e
                INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id 
                ';


        } elseif ($sql == 'listagem') {

            $sql = 'SELECT 
                    e.etiq_id, e.etiq_cod_final,
                    d.depo_centro,
                    m.mate_codigo, m.mate_nome, m.mate_unidade_medida,
                    l.leit_identificacao_material, l.leit_loc_material, l.leit_id_material, l.leit_livre1, l.leit_livre2
                    FROM etiquetas e
                    INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                    INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                    LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id';

            $GroupBy = ' GROUP BY e.etiq_cod_final ';

        } else if ($sql == 'quadro') {

            $sql = 'SELECT *                
                FROM etiquetas e
                INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id 
                ';

            $GroupBy = " GROUP BY etiq_depo_centro ";

        } else if ($sql == 'final') {

            $sql = "  ";
        }

        $sql .= $Search . $GroupBy . $OrderBy . $Paginacao . $Limite;

        $inventario = $db->GetObjectList($sql);

        return $inventario;
    }

    function RelatorioFinal()
    {
        global $db;

        $pularCodFinal = null;

        $sql = " SELECT leit_etiq_id FROM leitura";
        $Etiquetas = $db->GetObjectList($sql);

        foreach ($Etiquetas as $key => $etiqueta) {
            $etiqueta = $etiqueta->leit_etiq_id;

            // Identificar as leituras, e diferenciar contagem 1, 2 e 3
            $sql = "SELECT leit_etiq_id, (SELECT etiq_cod_final FROM etiquetas WHERE etiq_id = {$etiqueta}) as etiq_cod_final FROM leitura
                    WHERE
                    (SELECT SUM(leit_quantidade_aferida) as total1 FROM leitura WHERE leit_etiq_id = {$etiqueta} AND leit_nu_leitura = 1) != 
                    (SELECT SUM(leit_quantidade_aferida) as total2 FROM leitura WHERE leit_etiq_id = {$etiqueta} AND leit_nu_leitura = 2) 
                    AND leit_etiq_id = {$etiqueta}
                    GROUP BY leit_etiq_id";

            $res = $db->GetObjectList($sql);

            // Pegar informacoes iniciais das etiquetas
            $sql = "    SELECT leit_centro, 
                        (SELECT mate_codigo FROM materiais WHERE mate_id = leit_mate_id) as mate_codigo,
                        (SELECT  RIGHT(leit_centro, 4) ) AS centro_sap, 
                        (SELECT  mate_nome FROM materiais WHERE mate_id = leit_mate_id) AS mate_descricao,
                        (SELECT mate_unidade_medida FROM materiais WHERE mate_id = leit_mate_id) as mate_unidade_medida,
                        leit_id_material
                        FROM leitura
                        INNER JOIN etiquetas e ON etiq_id = leit_etiq_id
                        WHERE leit_etiq_id = {$etiqueta}
                        GROUP BY e.etiq_cod_final";

            $Resultado[$key] = $db->GetObject($sql);
            // caso tenha id, adicionar na busca (leit_identificacao_material)
            $idMaterial = (($id = $Resultado[$key]->leit_id_material) != 0) ? "-" . $id : '';

            // Salvar o Codigo Final, para identificação
            $CodFinal = $Resultado[$key]->leit_centro . "-" . $Resultado[$key]->mate_codigo;

            // Caso seja a soma da contagem 1 com a contagem 2
            // Gerando o total
            if (!$res && $pularCodFinal != $CodFinal) {

                $sql = " SELECT SUM(leit_quantidade_aferida) as total 
                         FROM leitura 
                         WHERE (leit_identificacao_material = '{$CodFinal}{$idMaterial}/1' 
                         OR leit_identificacao_material = '{$CodFinal}/1')   
                         AND leit_nu_leitura = 1";
                $total = $db->GetObject($sql)->total;

                // Adicionar no Resultado
                $Resultado[$key]->total = ($total) ? $total : 0;
//                $Resultado[$key]->total = $total;

                // Se a contagem 1 for diferente da 2
                // Obter a contagem 3 como total
            } else {

                // Pegar o total das leituras
                $sql = " SELECT SUM(leit_quantidade_aferida) as total 
                        FROM leitura 
                        WHERE (leit_identificacao_material = '{$CodFinal}{$idMaterial}/1' 
                        OR leit_identificacao_material = '{$CodFinal}/1')  
                        AND leit_nu_leitura = 3 ";
                $total = $db->GetObject($sql)->total;

                // Adicionar no Resultado
                $Resultado[$key]->total = ($total) ? $total : 0;

                // Etiqueta com terceira leitura, vale apenas o total somado
                $pularCodFinal = $CodFinal;

            }

            // haaaaaaack
            unset($Resultado[$key]->leit_id_material);

            // Agrupar por nome do material
            $Retorno[$CodFinal] = $Resultado[$key];


            // Parece gambiarra eu sei, mas procure um meio melhor, te desafio
        }

        return $Retorno;
    }

}

class Inventario extends PInventario
{

    function ExportarCsv($OrderBy, $Search, $Listagem)
    {
        global $Etiquetas;

        // Caso esteja exportando pela página de listagem/compacta
        // O processo será diferente, juntamente com as variáveis em questão 
        if ($Listagem === 'true') {
            $sql = 'SELECT 
                    e.etiq_cod_final, m.mate_codigo, d.depo_centro, m.mate_nome, e.etiq_id_bobina, m.mate_unidade_medida,
                    (null) as contagem1, (null) as contagem2, (null) as contagem3
                    FROM etiquetas e
                    INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                    INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                    LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id
                    GROUP BY e.etiq_cod_final';

            $Cabecalho = ['Cód Material', 'Centro', 'Descrição Material', 'ID', 'Unidade de Medida', 'Contagem 1', 'Contagem 2', 'Contagem 3'];

            // Fazer a listagem do inventário
            $InventarioLista = $this->ListarInventario($OrderBy, $Search, $Paginacao, $sql);

            // Obter a contagem de cada leitura e colocar dentro do array/objeto
            foreach ($InventarioLista as $key => $inve) {
                $InventarioLista[$key]->contagem1 = $Etiquetas->ObterLeitura($inve->depo_centro, 1, $inve->etiq_cod_final);
                $InventarioLista[$key]->contagem2 = $Etiquetas->ObterLeitura($inve->depo_centro, 2, $inve->etiq_cod_final);
                $InventarioLista[$key]->contagem3 = $Etiquetas->ObterLeitura($inve->depo_centro, 3, $inve->etiq_cod_final);
                unset($InventarioLista[$key]->etiq_cod_final);
            }

            // Caso não seja listagem, será o inventário normal
        } else {

            $sql = 'SELECT l.leit_data, l.leit_usua_nome, l.leit_nu_leitura, l.leit_identificacao_material, m.mate_codigo, d.depo_centro, m.mate_nome, m.mate_unidade_medida, m.mate_valor_unitario, l.leit_quantidade_aferida, l.leit_loc_material, e.etiq_id_bobina, l.leit_livre1, l.leit_livre2
                FROM etiquetas e
                INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id 
                ';

            $Cabecalho = ['Data', 'Nome Leitor', 'N. Leitura', 'Cód Inventário', 'Cód Material', 'Centro', 'Descrição Material', 'Unidade de Medida', 'R$ Unitário', 'Leitura', 'Localização Interna', 'Id Material', 'Livre 1', 'Livre 2'];

            $InventarioLista = $this->ListarInventario($OrderBy, $Search, $Paginacao, $sql);
        }

        $nome = 'Temp/' . date(d) . '.' . date(m) . '.' . date(o) . '.' . date(G) . '.' . date(i) . '.csv';

        if ($InventarioLista) {
            $arquivo = fopen($nome, 'w');
            fputcsv($arquivo, $Cabecalho);
            foreach ($InventarioLista as $linhas) {
                $linhas = (array)$linhas;
                fputcsv($arquivo, $linhas);
            }
            fclose($arquivo);

            return $nome;
        } else {
            return false;
        }
    }

}
