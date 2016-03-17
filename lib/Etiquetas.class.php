<?php

/**
 * Description of Etiquetas
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class PEtiquetas extends Geleia {

    //put your code here

    function PEtiquetas($Table = "") {

        parent::Geleia($Table);
        $this->LoadSQL4Datasource();
//        $this->LoadLiteralDatasource();
//        $this->DynamicVars['$1'] = $this->GetUserIdLogged();
//        $this->DynamicVars['$2'] = "'" . date('Y-m-d H:i:s') . "'";
    }

    function LoadSQL4Datasource() {

        $this->SQList['select.centro']['sql'] = "SELECT * FROM deposito WHERE depo_excluido = 0";
        $this->SQList['select.centro']['value'] = "depo_centro";
        $this->SQList['select.centro']['key'] = "depo_id";

        $this->SQList['select.material']['sql'] = "SELECT * FROM materiais WHERE mate_excluido = 0";
        $this->SQList['select.material']['value'] = "mate_nome";
        $this->SQList['select.material']['key'] = "mate_id";

//        $this->SQList['select. ']['key'] = '';
//        $this->SQList['select. ']['value'] = '';
    }

}

class Etiquetas extends PEtiquetas {
    
}
