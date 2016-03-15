<?php  
abstract class PCliente extends Geleia {
		
		function PCliente($Table = "") {
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
		    
		    $this->SQList['select.usuario']['sql'] = "SELECT * FROM usuario WHERE usua_excluido=0 ORDER BY usua_nome";
		    $this->SQList['select.usuario']['key'] = 'usua_id';
		    $this->SQList['select.usuario']['value'] = 'usua_nome';
		}
		
		function Delete($Id) {
			$this->SQL_Delete = "UPDATE cliente SET clie_excluido=1 WHERE clie_id=" . (int) $Id;
			return parent::Delete();
		}

		function LoadLiteralDatasource() {
			$this->LiteralList['status'] = 'Ativo#Inativo';
			$this->LiteralList['tipo'] = 'VPE#VPG';
			$this->LiteralList['abc'] = 'Wagner#Marcos#Kairo#Ayslan#Victor Paulo';
			$this->LiteralList['estado'] = "AC#AL#AP#AM#BA#CE#DF#ES#GO#MA#MT#MS#MG#PA#PB#PR#PE#PI#RJ#RN#RS#RO#RR#SC#SP#SE#TO";
		}
		
		function GetTipoArray() {
			return split("#", $this->LiteralList['tipo']);
		}
		
		function GetById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM cliente WHERE clie_id=" . (int) $Id . " AND clie_excluido=0";			
			return parent::GetById($IsArray);
		}
		
		
		
		function GetAll() {
			global $db;
			return $db->GetObjectList("SELECT * FROM cliente WHERE clie_excluido=0 ORDER BY clie_razao_social");
		}
		
		function Listing($_field = "clie_razao_social ASC", $limit = 0, $total_per_page = 50, $search = '') {
			global $db;
			
			$sql = "SELECT * FROM cliente
			LEFT JOIN (
			SELECT COUNT(agen_clie_id) as total, agen_clie_id FROM `agenda` WHERE agen_excluido=0
			GROUP BY agen_clie_id
			) AS AgendaStats ON (AgendaStats.agen_clie_id = clie_id) WHERE clie_excluido=0 ";
			
			if($search != "") {
				$search = str_replace("%", "", $search);
				$search = str_replace("?", "", $search);
				if( strlen($search) > 3) {
					$str_search = " '%$search%' ";
				} else if ( strlen($search) <= 3 ) {
					$str_search = " '$search%' ";
				}

				$sql .= " AND ( (clie_razao_social LIKE ". $str_search . ") OR (clie_cnpj LIKE ". $str_search . ") OR (clie_gerente_conta LIKE ". $str_search . ") ) ";
			}
			
		
		   $sql .= " ORDER BY $_field LIMIT $limit, " . $total_per_page;
			
			if($rset = $db->ExecSQL($sql)) {
				return $db->GetObjectList($rset);
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}			
			
		}
		
		function UpdateTipo($Id, $Tipo) {
			global $db;
			
			$sql = "UPDATE cliente SET clie_tipo='".$Tipo."' WHERE clie_id IN (".$Id.")";
			
			if($db->ExecSQL($sql)) {
				return true;
			}
			return false;
		}
		
		function GetTotal() {
			global $db;
			
			$sql = "SELECT COUNT(clie_id) FROM cliente WHERE clie_excluido=0";
			
			if($rset = $db->ExecSQL($sql)) {
				$Obj = $db->GetObject($rset);
				return $Obj->TOTAL;
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}			
			
		}
		
		function GetTecnicoResponsavel($Id){
		    global $db;
		    
		    $sql = "SELECT clie_responsavel FROM cliente WHERE clie_id=" . $Id;
		    
		    if($rset = $db->ExecSQL($sql)) {
		        $Obj = $db->GetObject($rset);
		        return $Obj->clie_responsavel;
		    } else {
		        error_log(__CLASS__."." . __METHOD__);
		        return false;
		    }
		}
}


class Cliente extends PCliente {
		function Save() {
			//$_POST['status'] = 'Em andamento';
			return parent::Save();
		}
		
		function Update() {
			return parent::Update();
		}
}
?>