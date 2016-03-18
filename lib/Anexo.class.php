<?php  
abstract class PAnexo extends Geleia {
		
		function PAnexo($Table = "") {
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
			$this->SQL_Delete = "UPDATE anexo SET anex_excluido=1 WHERE anex_id=" . (int) $Id;
			return parent::Delete();
		}

		function LoadLiteralDatasource() {
			$this->LiteralList['status'] = 'Ativo#Inativo';
		}

		function GetById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM anexo WHERE anex_id=" . (int) $Id . " AND anex_excluido=0";			
			return parent::GetById($IsArray);
		}
		
		function GetAll() {
			global $db;
			return $db->GetObjectList("SELECT * FROM anexo WHERE anex_excluido=0 ORDER BY anex_data_cadastro DESC");
		}
		
		function GetAllByCustomer($Id) {
			global $db;
			return $db->GetObjectList("SELECT * FROM anexo LEFT JOIN usuario ON (usua_id = anex_usua_id) WHERE anex_excluido=0 and anex_clie_id=". (int) $Id ." ORDER BY anex_data_cadastro DESC");
		}
		
		function Listing($_field = "anex_data_cadastro DESC ASC", $limit = 0, $total_per_page = 50, $search = '') {
			global $db;
			
			$sql = "SELECT * FROM anexo WHERE anex_excluido=0 ";
			
			if($search != "") {
				$search = str_replace("%", "", $search);
				$search = str_replace("?", "", $search);
				if( strlen($search) > 3) {
					$str_search = " '%$search%' ";
				} else if ( strlen($search) <= 3 ) {
					$str_search = " '$search%' ";
				}

				$sql .= " AND ( (anex_data_cadastro DESC LIKE ". $str_search . ") ) ";
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
			
			$sql = "SELECT COUNT(anex_id) FROM anexo WHERE anex_excluido=0";
			
			if($rset = $db->ExecSQL($sql)) {
				$Obj = $db->GetObject($rset);
				return $Obj->TOTAL;
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}			
			
		}
		
		
}


class Anexo extends PAnexo {
		function Save() {
			//$_POST['status'] = 'Em andamento';
			return parent::Save();
		}
		
		function Update() {
			return parent::Update();
		}
}
?>