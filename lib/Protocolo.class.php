<?php  
abstract class PProtocolo extends Geleia {
		
		function PProtocolo($Table = "") {
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
			$this->SQL_Delete = "UPDATE protocolo SET proto_excluido=1 WHERE proto_id=" . (int) $Id;
			return parent::Delete();
		}

		function LoadLiteralDatasource() {
			$this->LiteralList['status'] = 'Ativo#Inativo';
			$this->LiteralList['prioridade'] = 'Baixa#Normal#Urgente';
		}

		function GetById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM protocolo WHERE proto_id=" . (int) $Id . " AND proto_excluido=0";			
			return parent::GetById($IsArray);
		}
		
		function GetAll() {
			global $db;
			return $db->GetObjectList("SELECT * FROM protocolo WHERE proto_excluido=0 ORDER BY proto_id");
		}
		
		function Listing($_field = "proto_id DESC", $limit = 0, $total_per_page = 50, $search = '') {
			global $db;
			
			$sql = "SELECT protocolo.*, usua_nome, usua_email FROM protocolo
			LEFT JOIN usuario ON (usua_id = proto_de)
			WHERE proto_excluido=0 ";
			
			if($search != "") {
				$search = str_replace("%", "", $search);
				$search = str_replace("?", "", $search);
				if( strlen($search) > 3) {
					$str_search = " '%$search%' ";
				} else if ( strlen($search) <= 3 ) {
					$str_search = " '$search%' ";
				}

				$sql .= " AND ( (proto_id LIKE ". $str_search . ") ) ";
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
			
			$sql = "SELECT COUNT(proto_id) FROM protocolo WHERE proto_excluido=0";
			
			if($rset = $db->ExecSQL($sql)) {
				$Obj = $db->GetObject($rset);
				return $Obj->TOTAL;
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}			
			
		}
		
		
}


class Protocolo extends PProtocolo {
		function Save() {
			
			
			//add
			//send email
			//config sender
			//change status
			//_debug($_POST);
			
			if(parent::Save()) {
				$this->GetEmailConfig("Agenda Corporativa - Técnico Residente");
				$this->mail_config->addTo($_POST['para']);
				$this->mail_config->setSubject($_POST['assunto']);
				$this->mail_config->addHeader('X-MailGenerator', 'Agenda Corporativa');	
				$this->mail_config->setBodyHtml('<em>' . $_POST['mensagem'] . "</em><br><br>Prioridade: <strong>" . $_POST['prioridade'] . '</strong><br><br>Abraços,<br>' . $this->GetUserNameLogged());	
				$this->mail_config->setReplyTo($this->GetUserEmailLogged(), $this->GetUserNameLogged());
				try {
					$this->mail_config->send();
					$this->mail_config->clearRecipients();
					$this->mail_config->clearSubject();
					return true;
				} catch (Exception $ex) {
					return false;
				}
				//setar como enviado
				
			} else {
				return false;
			}
			
			
			
		}
		
		function Update() {
			return parent::Update();
		}
}
?>