<?php

/**
 * Description of Inventario
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
require_once 'Etiquetas.class.php';
$Etiquetas = new Etiquetas();

class PInventario extends Geleia {

    // Implementar mais tarde, quando necessário
    function ListarRelatorio($OrderBy = null, $Search = null, $Paginacao = 'LIMIT 0', $sql = null) {
        global $db;

        if ($OrderBy == null) {
            $OrderBy = 'ORDER BY etiq_id ASC';
        }

        if ($Search != null) {
            $Search = "AND ("
                    . "m.mate_codigo LIKE '%" . $Search . "%'"
//                    . "OR inve_data LIKE '%" . $Search . "%'"                    
                    . "OR m.mate_nome LIKE '%" . $Search . "%'"
                    . "OR d.depo_centro LIKE '%" . $Search . "%'"
                    . "OR d.depo_empresa LIKE '%" . $Search . "%'"
                    . ") ";
        }

        if ($sql == null) {

            $sql = 'SELECT 
                e.etiq_id, e.etiq_depo_centro, e.etiq_mate_material, e.etiq_quantidade, e.etiq_cod_final, e.etiq_cod_leitura1, e.etiq_cod_leitura2, e.etiq_cod_leitura3, e.etiq_leitura,
                d.depo_id, d.depo_empresa, d.depo_centro, d.depo_cidade, d.depo_leitura,
                m.mate_id, m.mate_codigo, m.mate_nome, m.mate_unidade_medida, m.mate_valor_unitario,
                l.leit_livre1, l.leit_livre2, leit_cod_leitura, l.leit_nu_leitura, l.leit_id_material, l.leit_data 
                FROM etiquetas e
                INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id
                GROUP BY e.etiq_id ';
        }

        $sql .= $Search . $OrderBy . $Paginacao;

        $inventario = $db->GetObjectList($sql);

        return $inventario;
    }

    function ListarInventario($OrderBy = null, $Search = null, $Paginacao = '', $sql = null) {
        global $db;

        if ($OrderBy == null) {
            $OrderBy = ' ORDER BY l.leit_data ASC ';
        }

        if ($Search != null) {
            $Search = " WHERE ("
                    . " m.mate_codigo LIKE '%" . $Search . "%' "
                    . " OR m.mate_nome LIKE '%" . $Search . "%' "
                    . " OR d.depo_centro LIKE '%" . $Search . "%' "
                    . " OR d.depo_empresa LIKE '%" . $Search . "%' "
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
        }

        $sql .= $Search . $GroupBy . $OrderBy . $Paginacao;

        $inventario = $db->GetObjectList($sql);

        return $inventario;
    }

}

class Inventario extends PInventario {

    function ExportarCsv($OrderBy, $Search, $Listagem) {
        global $Etiquetas;
        
        // Caso esteja exportando pela página de listagem/compacta
        // O processo será diferente, juntamente com as variáveis em questão 
        if ($Listagem === 'true') {
            $sql = 'SELECT 
                    e.etiq_cod_final, m.mate_codigo, d.depo_centro, m.mate_nome, m.mate_unidade_medida,
                    (null) as contagem1, (null) as contagem2, (null) as contagem3
                    FROM etiquetas e
                    INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                    INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                    LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id
                    GROUP BY e.etiq_cod_final';

            $Cabecalho = ['Cód Material', 'Centro', 'Descrição Material', 'Unidade de Medida', 'Contagem 1', 'Contagem 2', 'Contagem 3'];
            
            // Fazer a listagem do inventário
            $InventarioLista = $this->ListarInventario($OrderBy, $Search, $Paginacao, $sql);
            
            // Obter a contagem de cada leitura e colocar dentro do array/objeto
            foreach ($InventarioLista as $key => $inve) {
                $InventarioLista[$key]->contagem1 = $Etiquetas->ObterLeitura($inve->depo_centro, 1, $inve->etiq_cod_final);
                $InventarioLista[$key]->contagem2 = $Etiquetas->ObterLeitura($inve->depo_centro, 2, $inve->etiq_cod_final);
                $InventarioLista[$key]->contagem3 = $Etiquetas->ObterLeitura($inve->depo_centro, 3, $inve->etiq_cod_final);
                unset($InventarioLista[$key]->etiq_cod_final);
            }
            
        } else {

            $sql = 'SELECT l.leit_data, l.leit_nu_leitura, l.leit_identificacao_material, m.mate_codigo, d.depo_centro, m.mate_nome, m.mate_unidade_medida, m.mate_valor_unitario, l.leit_quantidade_aferida, l.leit_loc_material, l.leit_id_material, l.leit_livre1, l.leit_livre2
                FROM etiquetas e
                INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id 
                ';

            $Cabecalho = ['Data', 'N. Leitura', 'Cód Inventário', 'Cód Material', 'Centro', 'Descrição Material', 'Unidade de Medida', 'R$ Unitário', 'Leitura', 'Localização Interna', 'Id Material', 'Livre 1', 'Livre 2'];
        
            $InventarioLista = $this->ListarInventario($OrderBy, $Search, $Paginacao, $sql);
        }

        $nome = 'Temp/' . date(d) . '.' . date(m) . '.' . date(o) . '.' . date(G) . '.' . date(i) . '.csv';

        if ($InventarioLista) {
            $arquivo = fopen($nome, 'w');
            fputcsv($arquivo, $Cabecalho);
            foreach ($InventarioLista as $linhas) {
                $linhas = (array) $linhas;
                fputcsv($arquivo, $linhas);
            }
            fclose($arquivo);

            return $nome;
        } else {
            return false;
        }
    }

}
