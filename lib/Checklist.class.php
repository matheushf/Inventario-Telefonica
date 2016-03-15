<?php  
abstract class PChecklist extends Geleia {
		
		function PChecklist($Table = "") {
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
			$this->SQL_Delete = "UPDATE checklist SET chec_excluido=1 WHERE chec_id=" . (int) $Id;
			return parent::Delete();
		}

		function LoadLiteralDatasource() {
			$this->LiteralList['status'] = 'Solucionado#Solucionado Parcialmente#Não Solucionado';
			$this->LiteralList['checklist'] = 'Sim#Não';
		}

		function GetById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM checklist WHERE chec_id=" . (int) $Id . " AND chec_excluido=0";			
			return parent::GetById($IsArray);
		}
		
		function GetByAgendaId($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM checklist WHERE chec_agen_id=" . (int) $Id . " AND chec_excluido=0";			
			return parent::GetById($IsArray);
		}
		
		function GetAll() {
			global $db;
			return $db->GetObjectList("SELECT * FROM checklist WHERE chec_excluido=0 ORDER BY chec_id");
		}
		
		function Listing($_field = "chec_id ASC", $limit = 0, $total_per_page = 50, $search = '') {
			global $db;
			
			$sql = "SELECT * FROM checklist WHERE chec_excluido=0 ";
			
			if($search != "") {
				$search = str_replace("%", "", $search);
				$search = str_replace("?", "", $search);
				if( strlen($search) > 3) {
					$str_search = " '%$search%' ";
				} else if ( strlen($search) <= 3 ) {
					$str_search = " '$search%' ";
				}

				$sql .= " AND ( (chec_id LIKE ". $str_search . ") ) ";
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
			
			$sql = "SELECT COUNT(chec_id) FROM checklist WHERE chec_excluido=0";
			
			if($rset = $db->ExecSQL($sql)) {
				$Obj = $db->GetObject($rset);
				return $Obj->TOTAL;
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}			
			
		}
		
		
}


class Checklist extends PChecklist {
		function Save() {
			//$_POST['status'] = 'Em andamento';
			return parent::Save();
		}
		
		function Update() {
			return parent::Update();
		}
}
?>