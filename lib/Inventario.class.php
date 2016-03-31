<?php

/**
 * Description of Inventario
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class PInventario extends Geleia {

    function ListarInventario($OrderBy = null, $Search = null, $Paginacao = 'LIMIT 50', $sql = null) {
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

        echo $sql;

        $inventario = $db->GetObjectList($sql);

        return $inventario;
    }

}

class Inventario extends PInventario {

    function ExportarCsv($OrderBy, $Search, $Paginacao) {

        $sql = '
        SELECT l.leit_data, 
            e.etiq_cod_final, 
            m.mate_codigo, 
            d.depo_centro, 
            m.mate_nome, 
            m.mate_unidade_medida, 
            m.mate_valor_unitario, 
            (SELECT l.leit_quantidade_aferida FROM leitura l WHERE l.leit_nu_leitura = 1 AND l.leit_etiq_id = e.etiq_id) as leitura1,
            (SELECT l.leit_quantidade_aferida FROM leitura l WHERE l.leit_nu_leitura = 2 AND l.leit_etiq_id = e.etiq_id) as leitura2,
            (SELECT l.leit_quantidade_aferida FROM leitura l WHERE l.leit_nu_leitura = 3 AND l.leit_etiq_id = e.etiq_id) as leitura3,
            l.leit_loc_material, 
            l.leit_id_material, 
            l.leit_livre1, 
            l.leit_livre2 
            
        FROM etiquetas e
        INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
        INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
        LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id
        GROUP BY e.etiq_id 
        ';

        $InventarioLista = $this->ListarInventario($OrderBy, $Search, $Paginacao, $sql);

        $Cabecalho = ['Data', 'Cód Inventário', 'Cód Material', 'Centro', 'Descrição Material', 'Unidade de Medida', 'R$ Unitário', 'Leitura 1', 'Leitura 2', 'Leitura 3', 'Localização Interna', 'Material', 'Livre 1', 'Livre 2'];

        $arquivo = fopen('lista.csv', 'w');
        fputcsv($arquivo, $Cabecalho);
        foreach ($InventarioLista as $linhas) {
            $linhas = (array) $linhas;

            fputcsv($arquivo, $linhas);
        }
        fclose($arquivo);

        echo $sql;
    }

}
