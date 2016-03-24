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

    function ListarDeposito($OrderBy = 'ORDER BY depo_id ASC', $Search = null, $Paginacao = 'LIMIT 50') {
        global $db;

        if ($Search != null) {
            $Search = "AND "
                    . "(depo_empresa LIKE '%" . $Search . "%'"
                    . "OR depo_centro LIKE '%" . $Search . "%'"
                    . "OR depo_cidade LIKE '%" . $Search . "%'"
                    . ") ";
        }

        $sql = 'SELECT * FROM deposito WHERE depo_excluido = 0 ' . $Search . $OrderBy . $Paginacao;

        $dep = $db->GetObjectList($sql);

        return $dep;
    }

    function GetById($Id, $IsArray = false) {
        global $db;

        $this->SQL_GetById = "SELECT * FROM deposito WHERE depo_id=" . (int) $Id . " AND depo_excluido=0";
        return parent::GetById($IsArray);
    }

    function ObterIdPorCentro($Centro) {
        global $db;

        $sql = "SELECT * FROM deposito WHERE depo_centro = " . $Centro;

        $Id = $db->GetObject($sql);
        $Id = $Id->depo_id;

        return $Id;
    }

    function AlterarLeitura($DepoId, $Leitura) {
        global $db;

        $sql = "UPDATE deposito SET depo_leitura = '" . $Leitura . "' WHERE depo_id = " . $DepoId;

        return $db->ExecSQL($sql);
    }

    function VerificarLeituraDeposito($DepoId) {
        global $db;

        $sql = "SELECT depo_leitura FROM deposito WHERE depo_id = " . $DepoId;

        $leitura = $db->GetObject($sql);
        return $leitura->depo_leitura;
    }

}

class Deposito extends PDeposito {

    function ImportarDepositos() {
        $Campos = ['depo_id', 'depo_empresa', 'depo_centro', 'depo_cidade', 'depo_status', 'depo_livre1', 'depo_livre2', 'depo_livre3'];
        $Tabela = "deposito";
        $ArquivoNome = "depositos.csv";
        ImportarCSV($Campos, $Tabela, $ArquivoNome);
    }

}
