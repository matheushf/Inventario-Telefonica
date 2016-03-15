<?php  
abstract class PAgendaAnexo extends Geleia {
		
		function PAgendaAnexo($Table = "") {
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
			$this->SQL_Delete = "UPDATE agenda_anexo SET agan_excluido=1 WHERE agan_id=" . (int) $Id;
			return parent::Delete();
		}

		function LoadLiteralDatasource() {
			$this->LiteralList['status'] = 'Ativo#Inativo';
		}

		function GetById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM agenda_anexo WHERE agan_id=" . (int) $Id . " AND agan_excluido=0";			
			return parent::GetById($IsArray);
		}
		
		function GetByAgenda($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM agenda_anexo WHERE agan_agen_id=" . (int) $Id . " AND agan_excluido=0";			
			return parent::GetById($IsArray);
		}
		
		function GetAll() {
			global $db;
			return $db->GetObjectList("SELECT * FROM agenda_anexo WHERE agan_excluido=0 ORDER BY agan_id");
		}
		
		function Listing($_field = "agan_id ASC", $limit = 0, $total_per_page = 50, $search = '') {
			global $db;
			
			$sql = "SELECT * FROM agenda_anexo WHERE agan_excluido=0 ";
			
			if($search != "") {
				$search = str_replace("%", "", $search);
				$search = str_replace("?", "", $search);
				if( strlen($search) > 3) {
					$str_search = " '%$search%' ";
				} else if ( strlen($search) <= 3 ) {
					$str_search = " '$search%' ";
				}

				$sql .= " AND ( (agan_id_id LIKE ". $str_search . ") ) ";
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
			
			$sql = "SELECT COUNT(agan_id) FROM agenda_anexo WHERE agan_excluido=0";
			
			if($rset = $db->ExecSQL($sql)) {
				$Obj = $db->GetObject($rset);
				return $Obj->TOTAL;
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}			
			
		}
		
		function ExcluirAnexo($NomeCampoAnexo, $Id) {
			global $db;
			$sql = "UPDATE agenda_anexo SET agan_$NomeCampoAnexo='' WHERE agan_id=" . (int) $Id;
			return $db->ExecSQL($sql);
		}
		
}


class AgendaAnexo extends PAgendaAnexo {
		function Save() {
			//$_POST['status'] = 'Em andamento';
			return parent::Save();
		}
		
		function Update() {
			return parent::Update();
		}
		
		
}
?>