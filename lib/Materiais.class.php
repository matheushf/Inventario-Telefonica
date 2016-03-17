<?php

/**
 * Description of Materiais
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class PMateriais extends Geleia {

    function ListarMateriais() {
        global $db;

        $sql = 'SELECT * FROM materiais WHERE mate_excluido = 0 ORDER BY mate_id ASC';

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
