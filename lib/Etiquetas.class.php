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

    function ListarEtiquetas() {
        global $db;

        $sql = 'SELECT * FROM etiquetas
                INNER JOIN materiais ON mate_id = etiq_mate_material
                INNER JOIN deposito ON depo_id = etiq_depo_centro
                WHERE etiq_excluido = 0
                ORDER BY etiq_id ASC';

        $etiq = $db->GetObjectList($sql);

        return $etiq;
    }

    function GetById($Id, $IsArray = false) {
        global $db;

        $this->SQL_GetById = "SELECT * FROM etiquetas WHERE etiq_id=" . (int) $Id . " AND etiq_excluido=0";
        return parent::GetById($IsArray);
    }

}

class Etiquetas extends PEtiquetas {
    
}
