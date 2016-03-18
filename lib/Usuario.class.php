<?php
abstract class PUsuario extends Geleia {

		function PUsuario($Table = "") {
			parent::Geleia($Table);
			$this->LoadSQL4Datasource();
			$this->LoadLiteralDatasource();
			$this->DynamicVars['$1'] = $this->GetUserIdLogged();
			$this->DynamicVars['$2'] = "'" . date('Y-m-d H:i:s') . "'";
		}

		function LoadSQL4Datasource() {
			$this->SQList['select.usuario']['sql'] = "SELECT * FROM usuario WHERE usua_excluido=0 ORDER BY usua_nome";
			$this->SQList['select.usuario']['key'] = 'usua_id';
			$this->SQList['select.usuario']['value'] = 'usua_nome';

			$this->SQList['select.supervisor']['sql'] = "SELECT * FROM usuario WHERE usua_excluido=0 AND (usua_tipo = 'Lider' OR usua_tipo = 'Admin') ORDER BY usua_nome";
			$this->SQList['select.supervisor']['key'] = 'usua_id';
			$this->SQList['select.supervisor']['value'] = 'usua_nome';
		}

		function Delete($Id) {
			$this->SQL_Delete = "UPDATE usuario SET usua_excluido=1 WHERE usua_id=" . (int) $Id;
			return parent::Delete();
		}

		function LoadLiteralDatasource() {
			$this->LiteralList['status'] = 'Ativo#Inativo';
			$this->LiteralList['tipo'] = 'Admin#Lider#Tecnico';
		}

		function GetById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM usuario WHERE usua_id=" . (int) $Id . " AND usua_excluido=0";
			return parent::GetById($IsArray);
		}

		function GetAll() {
			global $db;
			return $db->GetObjectList("SELECT * FROM usuario WHERE usua_excluido=0 ORDER BY usua_nome");
		}

		function Listing($_field = "usua_nome ASC", $limit = 0, $total_per_page = 50, $search = '') {
			global $db;

			$sql = "SELECT * FROM usuario WHERE usua_excluido=0 ";

			if($search != "") {
				$search = str_replace("%", "", $search);
				$search = str_replace("?", "", $search);
				if( strlen($search) > 3) {
					$str_search = " '%$search%' ";
				} else if ( strlen($search) <= 3 ) {
					$str_search = " '$search%' ";
				}

				$sql .= " AND (  ( usua_nome LIKE ". $str_search . ") OR ( usua_email LIKE ". $str_search . ") ) ";
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

			$sql = "SELECT COUNT(usua_id) as TOTAL FROM usuario WHERE usua_excluido=0";

			if($rset = $db->ExecSQL($sql)) {
				$Obj = $db->GetObject($rset);
				return $Obj->TOTAL;
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}

		}

		function GetByEmail($Email) {
			global $db;

			$Sql = "SELECT * FROM `usuario` WHERE usua_excluido=0 AND usua_email='" . mysql_escape_string($Email) . "'";

			return $db->GetObject($Sql);

		}

		function UpdatePassword($Id, $NewPassword) {
			global $db;

			$sql = "UPDATE usuario SET usua_senha='". sha1(trim($NewPassword))."' WHERE usua_id IN (" . (int) $Id . ")";
			$rset = $db->ExecSQL($sql);

			return true;
		}


}


class Usuario extends PUsuario {
	function Login($Email, $Password) {

			$ObjUser = $this->GetByEmail($Email);

			if($ObjUser->usua_email == $Email && $ObjUser->usua_senha == sha1($Password) && $ObjUser->usua_status == 'Ativo') {
				$this->PopulateSessionAfterLogon($ObjUser);
				return true;
			}

			return false;

		}

		function Save() {
			$_POST[senha] = sha1(trim($_POST[senha]));

			return parent::Save();
		}

		function Update() {

			if($_POST[current_password] == $_POST[senha])  { //did not change
				$_POST[senha] = $_POST[current_password];
			} else {
				$_POST[senha] = sha1(trim($_POST[senha]));
			}
			return parent::Update();
		}

		function isAdmin() {
			if(strtolower($_SESSION['usua_tipo']) == 'admin') {
				return true;
			}
			return false;
		}

		function ChangePassword($CurrentPassword, $NewPassword) {
			$ObjUser = $this->GetByEmail($this->GetUserEmailLogged());

			if($ObjUser->usua_senha == sha1($CurrentPassword)) {
				if($this->UpdatePassword($this->GetUserIdLogged(), $NewPassword)) {
					//send email

					//$this->Message_PasswordChanged($this->GetUserEmailLogged(), $NewPassword);
					return true;
				} else {
					error_log("Falha ao alterar senha. " . $this->GetUserEmailLogged());
					return false;
				}
			} else {
				return false;
			}
		}

		function PopulateSessionAfterLogon($ObjUser) {
			$_SESSION['usua_id'] = $ObjUser->usua_id;
			$_SESSION['usua_nome'] = $ObjUser->usua_nome;
			$_SESSION['usua_email'] = $ObjUser->usua_email;
			$_SESSION['usua_tipo'] = $ObjUser->usua_tipo;
		}

		function Message_PasswordChanged($To, $Message) {
			$this->GetEmailConfig("Agenda Corporativa");
					$this->mail_config->addTo($To);
					//$this->mail_config->addBcc('rotiv.jr@gmail.com');

					$this->mail_config->setSubject("Sua senha foi alterada");
					$this->mail_config->addHeader('X-MailGenerator', 'Agenda Corporativa');



					$this->mail_config->setBodyHtml("Ol�! Sua nova senha � " . $Message  . '<br><br><b>Agenda Corporativa</b>' );
					$this->mail_config->send();
					$this->mail_config->clearRecipients();
					$this->mail_config->clearSubject();
		}
}
?>