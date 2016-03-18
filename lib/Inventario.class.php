<?php

/**
 * Description of Inventario
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class PInventario extends Geleia {

//put your code here

    function ListarInventario() {
        global $db;

        $sql = 'SELECT * FROM materiais, etiquetas
                INNER JOIN deposito ON depo_id = etiquetas.etiq_id';

        $inventario = $db->GetObjectList($sql);

        return $inventario;
    }

}

class Inventario extends PInventario {
    
}
