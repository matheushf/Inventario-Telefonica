<?php

/**
 * Description of Materiais
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class PMateriais extends Geleia {

    function ListarMateriais() {
        global $db;

        $sql = 'SELECT * FROM materiais WHERE mate_excluido = 0';

        $mate = $db->GetObjectList($sql);

        return $mate;
    }

}

class Materiais extends PMateriais {
    
}
