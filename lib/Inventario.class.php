<?php

/**
 * Description of Inventario
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class PInventario extends Geleia {

    function ListarInventario($OrderBy = null, $Search = null, $Paginacao = 'LIMIT 50') {
        global $db;
        
        if ($OrderBy == null) {
            $OrderBy = 'ORDER BY etiq_id ASC';
        }

        if ($Search != null) {
            $Search = "AND ("
                    . "mate_codigo LIKE '%" . $Search . "%'"
//                    . "OR inve_data LIKE '%" . $Search . "%'"                    
                    . "OR mate_nome LIKE '%" . $Search . "%'"
                    . "OR depo_centro LIKE '%" . $Search . "%'"
                    . "OR depo_empresa LIKE '%" . $Search . "%'"
                    . ") ";
        }

        $sql = 'SELECT 
                e.etiq_id, e.etiq_depo_centro, e.etiq_mate_material, e.etiq_quantidade, e.etiq_cod_final, e.etiq_cod_leitura1, e.etiq_cod_leitura2, e.etiq_cod_leitura3, e.etiq_leitura,
                d.depo_id, d.depo_empresa, d.depo_centro, d.depo_cidade, d.depo_leitura,
                m.mate_id, m.mate_codigo, m.mate_nome, m.mate_unidade_medida, m.mate_valor_unitario,
                l.leit_livre1, l.leit_livre2, leit_cod_leitura, leit_nu_leitura, leit_id_material  
                FROM etiquetas e
                INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id
                GROUP BY e.etiq_id
               ' . $Search . $OrderBy . $Paginacao;
        
        $inventario = $db->GetObjectList($sql);

        return $inventario;
    }

}

class Inventario extends PInventario {
    
    function Exportar_Csv() {
        
        $sql = 'SELECT 
                e.etiq_id, e.etiq_depo_centro, e.etiq_mate_material, e.etiq_quantidade, e.etiq_cod_final, e.etiq_cod_leitura1, e.etiq_cod_leitura2, e.etiq_cod_leitura3, e.etiq_leitura,
                d.depo_id, d.depo_empresa, d.depo_centro, d.depo_cidade, d.depo_leitura,
                m.mate_codigo, m.mate_nome, m.mate_unidade_medida, m.mate_valor_unitario,
                l.leit_livre1, l.leit_livre2, leit_cod_leitura, leit_nu_leitura 
                FROM etiquetas e
                INNER JOIN deposito d ON depo_id = e.etiq_depo_centro
                INNER JOIN materiais m ON m.mate_id = e.etiq_mate_material
                LEFT OUTER JOIN leitura l ON leit_etiq_id = e.etiq_id
                GROUP BY e.etiq_id
               ' . $Search . $OrderBy . $Paginacao;
    }
    
}
