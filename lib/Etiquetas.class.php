<?php

/**
 * Description of Etiquetas
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class Etiquetas extends Geleia {

    //put your code here

    function LoadSQL4Datasource() {

        $this->SQList['select.centro']['sql'] = "SELECT depo_centro FROM deposito WHERE depo_excluido = 0";
        $this->SQList['select.material']['sql'] = "SELECT mate_nome FROM materiais WHERE mate_excluido = 0";
//        $this->SQList['select.usuario']['key'] = 'usua_id';
//        $this->SQList['select.usuario']['value'] = 'usua_nome';
    }

}
