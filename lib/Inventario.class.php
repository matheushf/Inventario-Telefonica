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

        $sql = 'SELECT * FROM etiquetas e
                INNER JOIN deposito ON depo_id = e.etiq_depo_centro AND deposito.depo_excluido = 0
                INNER JOIN materiais ON materiais.mate_id = e.etiq_mate_material AND materiais.mate_excluido = 0
                WHERE e.etiq_excluido = 0';

        $inventario = $db->GetObjectList($sql);

        return $inventario;
    }

}

class Inventario extends PInventario {
    
}
