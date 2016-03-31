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

        $sql = 'SELECT * FROM etiquetas e
                INNER JOIN deposito ON depo_id = e.etiq_depo_centro
                INNER JOIN materiais ON materiais.mate_id = e.etiq_mate_material
                LEFT OUTER JOIN leitura ON leit_etiq_id = e.etiq_id
               ' . $Search . $OrderBy . $Paginacao;

        $inventario = $db->GetObjectList($sql);

        return $inventario;
    }

}

class Inventario extends PInventario {
    
}
