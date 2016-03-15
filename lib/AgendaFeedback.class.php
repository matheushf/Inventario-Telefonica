<?php
// require_once 'Geleia.class.php';

abstract class PAgendaFeedback extends Geleia {

		function PAgendaFeedback($Table = "") {
			parent::Geleia($Table);
			$this->LoadSQL4Datasource();
			$this->LoadLiteralDatasource();
			$this->DynamicVars['$1'] = $this->GetUserIdLogged();
			$this->DynamicVars['$2'] = "'" . date('Y-m-d H:i:s') . "'";
		}

		function LoadSQL4Datasource() {
			/*$this->SQList['select.product']['sql'] = "SELECT PROD_ID, CONCAT(PROD_NAME, \" - R$ \",  PROD_PRICE) AS PROD_NAME FROM `PRODUCT` WHERE PROD_DELETED=0 ORDER BY PROD_NAME ASC";
			$this->SQList['select.product']['key'] = 'PROD_ID';
			$this->SQList['select.product']['value'] = 'PROD_NAME';*/
		}

		function Delete($Id) {
			$this->SQL_Delete = "UPDATE agenda_feedback SET agfe_excluido=1 WHERE agfe_id=" . (int) $Id;
			return parent::Delete();
		}

		function LoadLiteralDatasource() {
			$this->LiteralList['status'] = 'Ativo#Inativo';
		}

		function GetById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM agenda_feedback WHERE agfe_id=" . (int) $Id . " AND agfe_excluido=0";
			return parent::GetById($IsArray);
		}

		function GetMineById($Id, $IsArray = false) {
			global $db;
			$sql  = "SELECT * FROM agenda_feedback LEFT JOIN usuario ON (usua_id = agfe_usua_id) WHERE agfe_agen_id=" . (int) $Id . " AND agfe_excluido=0 AND agfe_usua_id=" . $this->GetUserIdLogged() . " ORDER BY agfe_id DESC";
			return $db->GetObjectList($sql);
		}

		function GetAll() {
			global $db;
			return $db->GetObjectList("SELECT * FROM agenda_feedback WHERE agfe_excluido=0 ORDER BY agfe_id");
		}

		function Listing($_field = "agfe_id ASC", $limit = 0, $total_per_page = 50, $search = '') {
			global $db;

			$sql = "SELECT * FROM agenda_feedback WHERE agfe_excluido=0 ";

			if($search != "") {
				$search = str_replace("%", "", $search);
				$search = str_replace("?", "", $search);
				if( strlen($search) > 3) {
					$str_search = " '%$search%' ";
				} else if ( strlen($search) <= 3 ) {
					$str_search = " '$search%' ";
				}

				$sql .= " AND ( (agfe_id LIKE ". $str_search . ") ) ";
			}


			$sql .= " ORDER BY $_field LIMIT $limit, " . $total_per_page;

			if($rset = $db->ExecSQL($sql)) {
				return $db->GetObjectList($rset);
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}

		}

		function GetTotal() {
			global $db;

			$sql = "SELECT COUNT(agfe_id) FROM agenda_feedback WHERE agfe_excluido=0";

			if($rset = $db->ExecSQL($sql)) {
				$Obj = $db->GetObject($rset);
				return $Obj->TOTAL;
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}

		}


}


class AgendaFeedback extends PAgendaFeedback {

		function Save() {
			//$_POST['status'] = 'Em andamento';
			return parent::Save();
		}

		function Update() {
			return parent::Update();
		}
}
?>