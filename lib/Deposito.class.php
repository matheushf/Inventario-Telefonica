<?php

/**
 * Description of Deposito
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
require_once 'DB.class.php';
$db = new DB();

class PDeposito extends Geleia {

    function PDeposito($Table = "") {

        parent::Geleia($Table);
        $this->LoadSQL4Datasource();
        $this->LoadLiteralDatasource();
        $this->DynamicVars['$1'] = $this->GetUserIdLogged();
        $this->DynamicVars['$2'] = "'" . date('Y-m-d H:i:s') . "'";
    }

    function LoadSQL4Datasource() {
        $this->SQList['select.deposito']['sql'] = "SELECT * FROM deposito WHERE depo_excluido = 0 ORDER BY depo_nome";
        $this->SQList['select.deposito']['key'] = 'depo_id';
        $this->SQList['select.deposito']['value'] = 'depo_empresa';
    }

    function Delete($Id) {
        $this->SQL_Delete = "UPDATE deposito SET depo_excluido = 1 WHERE depo_id = " . (int) $Id;
        return parent::Delete();
    }

    function LoadLiteralDatasource() {
        $this->LiteralList['status'] = 'Ativo#Inativo';
    }
    
    function ListarDeposito() {
        global $db;
        
        $sql = 'SELECT * FROM deposito WHERE depo_excluido = 0';
        
        $dep = $db->GetObjectList($sql);
        
//        var_dump($dep);
//        var_dump($db->ExecSQL($sql));
        
        return $dep;
        
    }

}

class Deposito extends PDeposito {
    
}
