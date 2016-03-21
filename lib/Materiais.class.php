<?php

/**
 * Description of Materiais
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class PMateriais extends Geleia {

    function ListarMateriais($OrderBy = 'ORDER BY mate_id ASC', $Search = null, $Paginacao = 'LIMIT 50') {
        global $db;
        
        if ($Search != null) {
            $Search = " AND ("
                    . "mate_codigo LIKE '%" . $Search . "%'"
                    . "OR mate_nome LIKE '%" . $Search . "%'"
                    . ") ";
        }

        $sql = 'SELECT * FROM materiais WHERE mate_excluido = 0 ' . $Search . $OrderBy . $Paginacao;

        $mate = $db->GetObjectList($sql);

        return $mate;
    }

    function GetById($Id, $IsArray = false) {
        global $db;

        $this->SQL_GetById = "SELECT * FROM materiais WHERE mate_id=" . (int) $Id . " AND mate_excluido=0";
        return parent::GetById($IsArray);
    }
    
}

class Materiais extends PMateriais {
    
}
