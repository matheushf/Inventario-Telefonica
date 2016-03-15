<?php
abstract class PAgenda extends Geleia {

		function PAgenda($Table = "") {
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
			$this->SQList['select.cliente']['sql'] = "SELECT * FROM cliente WHERE clie_excluido=0 ORDER BY clie_razao_social ASC";
			$this->SQList['select.cliente']['key'] = 'clie_id';
			$this->SQList['select.cliente']['value'] = 'clie_razao_social';

			$this->SQList['select.usuario']['sql'] = "SELECT * FROM usuario WHERE usua_excluido=0 ORDER BY usua_nome";
			$this->SQList['select.usuario']['key'] = 'usua_id';
			$this->SQList['select.usuario']['value'] = 'usua_nome';

		}

		function Delete($Id) {
			$this->SQL_Delete = "UPDATE agenda SET agen_excluido=1 WHERE agen_id=" . (int) $Id;
			return parent::Delete();
		}

		function LoadLiteralDatasource() {
			$this->LiteralList['status'] = 'Aberto#Concluido#Atrasado#Cancelado';
$this->LiteralList['assunto'] = '
Trocar dispositivos
#Instalar dispositivos
#Configurar dispositivos
#Realizar transfer�ncia de agenda
#Orientar usu�rios sobre as funcionalidades e manuseio dos dispositivos
#Ministrar treinamentos para os usu�rios referente a ferramenta Vivo Gest�o
#Ministrar treinamentos para os usu�rios referente a ferramenta Vivo Online
#Suportar o cliente/usu�rio nas duvidas sobre faturamento
#Elaborar o invent�rio do parque, usu�rios e devices
#Controlar o parque do cliente (equipamentos novos, backups, assist�ncia t�cnica, empr�stimo, etc)
#Abrir e acompanhar chamados junto a Consultoria referente a inoper�ncia de dados, voz, sms e total
#Suportar o cliente/usu�rio em transfer�ncia de titularidade
#Suportar o cliente/usu�rio em transfer�ncia de linha
#Suportar o cliente/usu�rio nas portabilidades
#Suportar o cliente/usu�rio em Roaming';
			$this->LiteralList['assunto'] = 'Agenda �� orienta��o e organiza��o de agenda#Aparelho -� Defeito#Aparelho � Configura��o e orienta��o de funcionamento#Atividades Administrativas � aux�lio#Chamado Abertura de Chamados via consultoria#Consultoria de Relacionamento � interface com a consultoria#Fatura � orienta��o#Habilita��o � Configura��o de smart, PDA, etc#Inoper�ncia � Dados �#Inoper�ncia � SMS#Inoper�ncia � Voz #Inoper�ncia Total #Invent�rio de Coleta � CDMA/GSM, placa, modem, etc#Modem � orienta��o, instala��o� e configura��o#Parque � controle#Planilha - organiza��o#Servi�os � transfer�ncia de Linha#Troca � aux�lio no processo#Vivo Gest�o -� treinamento e orienta��es#Vivo On Line - treinamento e orienta��es';

			$this->LiteralList['atendimento'] = 'Fixo#Volante';




			$this->LiteralList['solicitacao'] = "1 - Urgente#2 - Normal#3 - Agendado#4 - Planejado";
			$this->LiteralList['estado'] = "AC#AL#AP#AM#BA#CE#DF#ES#GO#MA#MT#MS#MG#PA#PB#PR#PE#PI#RJ#RN#RS#RO#RR#SC#SP#SE#TO";
			$this->LiteralList['horarios'] = "Hor�rio 1 - 08 �s 10hs#Hor�rio 2 - 10 �s 12hs#Hor�rio 3 - 14 �s 16hs#Hor�rio 4 - 16 �s 18hs";
			$this->LiteralList['servico_solicitado'] = "Devices#Portabilidade#Treinamentos#Roaming#Invent�rio#Suporte#Faturamento";
			$this->LiteralList['descricao_servico'] = "Trocar dispositivos#Instalar dispositivos#Configurar dispositivos#Realizar transfer�ncia de agenda#Suportar o cliente/usu�rio nas portabilidades#Orientar usu�rios sobre as funcionalidades e manuseio dos dispositivos#Ministrar treinamentos para os usu�rios referente a ferramenta Vivo Gest�o#Ministrar treinamentos para os usu�rios referente a ferramenta Vivo Online#Suportar o cliente/usu�rio em Roaming#Elaborar o invent�rio do parque, usu�rios e devices#Controlar o parque do cliente (equipamentos novos, backups, assist�ncia t�cnica, empr�stimo, etc)#Abrir e acompanhar chamados junto a Consultoria referente a inoper�ncia de dados, voz, sms e total#Suportar o cliente/usu�rio em transfer�ncia de titularidade#Suportar o cliente/usu�rio em transfer�ncia de linha#Suportar o cliente/usu�rio nas duvidas sobre faturamento";
		    $this->LiteralList['tipo_atendimento'] = "Atendimento Remoto#Atendimento Presencial";

		    if($_SESSION['usua_tipo'] == 'Admin') {
		    	$this->LiteralList['tipoabertura'] = 'Atendimento em 4 horas#Atendimento NBD (Dia seguinte)#Atendimento Planejado';
		    } else {
		    	$this->LiteralList['tipoabertura'] = 'Atendimento Planejado';
		    }

		    $this->LiteralList['hora.inicio'] = 'Aberto#Concluido#Atrasado#Cancelado';
		    $this->LiteralList['hora.fim'] = 'Aberto#Concluido#Atrasado#Cancelado';

		}

		function GetSubjectArray() {
			return split("#\n", $this->LiteralList['assunto']);
		}

		function GetById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT agenda.*, clie_cnpj, clie_tipo, clie_razao_social, clie_gerente_conta FROM agenda LEFT JOIN cliente ON (clie_id = agen_clie_id) LEFT JOIN usuario ON (usua_id = agen_responsavel) WHERE agen_id=" . (int) $Id . " AND agen_excluido=0";
			return parent::GetById($IsArray);
		}

		function GetMineById($Id, $IsArray = false) {
			$this->SQL_GetById = "SELECT * FROM agenda LEFT JOIN cliente ON (clie_id = agen_clie_id)
			LEFT JOIN usuario ON (usua_id = agen_responsavel) ";

			$this->SQL_GetById .=" WHERE agen_id=" . (int) $Id . " AND agen_excluido=0 ";

			$this->SQL_GetById .= " AND agen_responsavel = " . $this->GetUserIdLogged();

			return parent::GetById($IsArray);
		}

		function GetAllTitles() {
			global $db;
			return $db->GetObjectList("SELECT DISTINCT(agen_servico) as agen_servico FROM `agenda`
 WHERE agen_excluido=0
ORDER BY agen_servico  ASC");
		}

		function GetAllSolicitacao() {
		    global $db;
		    return $db->GetObjectList("SELECT DISTINCT(agen_solicitacao) as agen_solicitacao FROM `agenda`
 WHERE agen_excluido=0
ORDER BY agen_solicitacao  ASC");
		}

		function GetAllCustomerWithAgenda() {
			global $db;
			return $db->GetObjectList("SELECT DISTINCT(agen_clie_id), clie_id, clie_razao_social, clie_cnpj FROM `agenda`
			LEFT JOIN cliente ON (clie_id = agen_clie_id)
			 WHERE agen_excluido=0
			ORDER BY clie_razao_social ASC");
		}

		function GetAll() {
			global $db;
			return $db->GetObjectList("SELECT * FROM agenda WHERE agen_excluido=0 ORDER BY agen_id");
		}

		function GetByDateAndUserId($Date = "", $UserId = "") {
			global $db;

			$sql = "SELECT * FROM agenda
			LEFT JOIN cliente ON (clie_id = agen_clie_id)
			LEFT JOIN usuario ON (usua_id = agen_responsavel)
			WHERE agen_excluido=0 ";

			if($UserId != "") {
				$sql .= " AND agen_responsavel= " . (int) $UserId;
			} else {
				$sql .= " AND agen_responsavel = " . $this->GetUserIdLogged();
			}

			if($Date != "") {
				$sql .= " AND ( (DATE_FORMAT(agen_data_inicio, '%Y-%m-%d') = '".$Date."') OR (DATE_FORMAT(agen_data_termino, '%Y-%m-%d') = '".$Date."') ) ";
			}

		  	$sql .= "ORDER BY agen_id DESC";

			return $db->GetObjectList($sql);
		}

		function ListingByDateAndUserId($Date = "", $UserId = "", $_field = "agen_data_cadastro DESC", $limit = 0, $total_per_page = 100, $search = '') {
		    global $db;

		    $sql = "SELECT *, (SELECT COUNT( * )
FROM agenda_anexo
WHERE agan_agen_id = agen_id AND (agan_anexo_1<>'' OR agan_anexo_2 <> '' OR agan_anexo_3 <> '' OR  agan_anexo_4 <> '') ) as agen_anexo  FROM agenda
			LEFT JOIN cliente ON (clie_id = agen_clie_id)
			LEFT JOIN usuario ON (usua_id = agen_responsavel)
			WHERE agen_excluido=0 ";

		    if($UserId != "") {
		        $sql .= " AND agen_responsavel= " . (int) $UserId;
		    } else {
		        $sql .= " AND agen_responsavel = " . $this->GetUserIdLogged();
		    }

		    if($Date != "") {
		        $sql .= " AND (DATE_FORMAT(agen_data_inicio, '%Y-%m') = '".$Date."')";
		    }

		   $sql .= " ORDER BY $_field LIMIT $limit, " . $total_per_page;

		    return $db->GetObjectList($sql);
		}

		function Listing($_field = "agen_data_inicio DESC", $limit = 0, $total_per_page = 50, $search = '') {
			global $db;

			$sql = "SELECT agenda.*,
			CASE WHEN (SELECT COUNT( agan_agen_id )
			FROM agenda_anexo
			WHERE agan_agen_id = agen_id AND (agan_anexo_1<>'' OR agan_anexo_2 <> '' OR agan_anexo_3 <> '' OR  agan_anexo_4 <> '') ) > 0 THEN 'Sim' ELSE 'N�o' END as agen_anexo,

			clie_razao_social, clie_tipo, clie_cnpj, usua_nome, usua_email FROM agenda LEFT JOIN cliente ON (clie_id = agen_clie_id)
			LEFT JOIN usuario ON (usua_id = agen_responsavel)
			WHERE agen_excluido=0 ";

			if($_GET['filter_responsavel'] != "") {
				$sql .= " AND agen_responsavel IN (" . ($_GET['filter_responsavel']). ") ";
			}

			if($_GET['filter_cliente'] != "") {
				$sql .= " AND agen_clie_id IN (" . ($_GET['filter_cliente']). ") ";
			}

			if($_GET['filter_titulo'] != "") {
				$sql .= " AND agen_titulo IN ('" . ($_GET['filter_titulo']). "') ";
			}

			if($_GET['filter_tipo'] != "") {
				$sql .= " AND clie_tipo IN ('" . ($_GET['filter_tipo']). "') ";
			}

			if($_GET['filter_servico'] != "") {
			    $sql .= " AND agen_servico IN ('" . ($_GET['filter_servico']). "') ";
			}

			if($_GET['filter_solicitacao'] != "") {
			    $sql .= " AND agen_solicitacao IN ('" . ($_GET['filter_solicitacao']). "') ";
			}

			if($_GET[filter_data_inicio] != "" && $_GET[filter_data_termino] != "") {
				$sql .= " AND (DATE_FORMAT(agen_data_inicio,\"%Y-%m-%d\")  BETWEEN '".$_GET[filter_data_inicio]."' AND '".$_GET[filter_data_termino]."') ";
			}

			if($search != "") {
				$search = str_replace("%", "", $search);
				$search = str_replace("?", "", $search);
				if( strlen($search) > 3) {
					$str_search = " '%$search%' ";
				} else if ( strlen($search) <= 3 ) {
					$str_search = " '$search%' ";
				}

				$sql .= " AND ( (agen_titulo LIKE ". $str_search . ") OR (clie_razao_social LIKE ". $str_search . ") ) ";
			}

			$_SESSION['agenda.listing.sql'] = $sql;

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

			$sql = "SELECT COUNT(agen_id) FROM agenda WHERE agen_excluido=0";

			if($rset = $db->ExecSQL($sql)) {
				$Obj = $db->GetObject($rset);
				return $Obj->TOTAL;
			} else {
				error_log(__CLASS__."." . __METHOD__);
				return false;
			}

		}


		//obter horarios dos dias
		//obter feriados
		//criar compromisso por dia seguidos
		//definir intervalo de compromisso
		//definir intervalo da hora. Padrao 30 mi

		function ObterHorariosPorDiaDaSemana() {
			global $db;
			$sql  = "SELECT *  FROM  horario WHERE hora_excluido=0";
			return $db->GetObjectList($sql);
		}

		function ObterFeriados() {
			global $db;
			$sql  = "SELECT *  FROM  feriado WHERE feri_excluido=0";
			return $db->GetObjectList($sql);
		}

		function DefinirAgendaPai($NovoId, $PaiId) {
			global $db;

			$sql = "UPDATE agenda SET agen_agen_id=".(int) $PaiId." WHERE agen_id=" . (int) $NovoId;
			return $db->ExecSQL($sql);

		}

		function GetTotalByDateAndUserId($YearAndMonth, $UserId = "") {
			global $db;

			$sql = "SELECT count(*) as total, date_format(agen_data_inicio, '%Y-%m-%d') as data FROM agenda
			WHERE agen_excluido=0
			AND date_format(agen_data_inicio, '%Y-%m') = '".$YearAndMonth."' ";

			if($UserId != "") {
				$sql .= " AND agen_responsavel = " . (int) $UserId;
			} else {
				$sql .= " AND agen_responsavel = " . $this->GetUserIdLogged();
			}

			$sql .= " GROUP BY data";
			return $db->GetObjectList($sql);
		}

		function StatsTotalbySubject($UserId) {
			global $db;

			$sql = "SELECT agen_titulo as nome, count(agen_id) as total FROM `agenda` WHERE agen_excluido=0 ";

			if($UserId != "") {
				$sql .= " AND agen_responsavel = " . (int) $UserId;
			}
			if($_GET[filter_data_inicio] != "" && $_GET[filter_data_termino] != "") {
				$sql .= " AND (DATE_FORMAT(agen_data_inicio,\"%Y-%m-%d\")  BETWEEN '". Useful::DateFormatBD($_GET[filter_data_inicio])."' AND '". Useful::DateFormatBD($_GET[filter_data_termino])."') ";
			}

			$sql .= " GROUP BY agen_titulo ORDER BY total DESC";

			$_SESSION['ranking.atendimento.listing.sql'] = $sql;

			return $db->GetObjectList($sql);
		}

		function StatsTotalByOwner($Subject = '') {
			global $db;

			$sql = "SELECT  usua_nome as nome, count(agen_responsavel) as total FROM `agenda`
LEFT JOIN usuario ON (usua_id = agen_responsavel)
WHERE agen_excluido=0 ";

			if($Subject != "") {
				$sql .= " AND agen_titulo = '" . $Subject . "' ";
			}
			if($_GET[filter_data_inicio] != "" && $_GET[filter_data_termino] != "") {
				$sql .= " AND (DATE_FORMAT(agen_data_inicio,\"%Y-%m-%d\")  BETWEEN '". Useful::DateFormatBD($_GET[filter_data_inicio])."' AND '". Useful::DateFormatBD($_GET[filter_data_termino])."') ";
			}

			if($_GET['filter_cliente'] != "") {
				$sql .= " AND agen_clie_id IN (" . ($_GET['filter_cliente']). ") ";
			}

			$sql .=" GROUP BY agen_responsavel ORDER BY total DESC";

			$_SESSION['ranking.tecnico.listing.sql'] = $sql;

			return $db->GetObjectList($sql);
		}

		function StatsTotalByMonth($Year, $Month) {
			global $db;

			$sql = "SELECT date_format(agen_data_inicio, '%d') as data, count(*) as total FROM agenda
WHERE date_format(agen_data_inicio, '%Y-%m') = '".$Year."-". Useful::padLeft($Month, '0', 2)."' GROUP BY data";
			return $db->GetObjectList($sql);
		}

		function SetStatus($Id, $Status){
		    global $db;

		    if($Status == 'Solucionado' || $Status == 'N�o Solucionado') {
		    	$sql = "UPDATE agenda SET agen_data_termino=now(), agen_status2='" . $Status . "' WHERE agen_id=" . $Id;
		    } else {
		    	$sql = "UPDATE agenda SET agen_status2='" . $Status . "' WHERE agen_id=" . $Id;
		    }
		    return $db->ExecSQL($sql);
		}

        function VerificaDiaHorario($Data, $Horario, $IdResponsavel, $IdChamado){
		    global $db;

		    $sql = "SELECT COUNT(agen_id) as total FROM agenda WHERE agen_responsavel = " . $IdResponsavel . " AND agen_horario = '" . $Horario . "' AND DATE_FORMAT(agen_data_inicio, '%Y-%m-%d') = '" . $Data . "' AND agen_id <> " . $IdChamado;
		    return $db->GetObject($sql);
		}

		function NotificarAtualizacaoStatus($Id) {

		    global $db;

		    $sql = "SELECT t.usua_email AS tecnico_email, s.usua_email AS supervisor_email, a.agen_status2
                    FROM agenda AS a
                    LEFT JOIN usuario AS t ON(t.usua_id = a.agen_responsavel)
                    LEFT JOIN usuario AS s ON(s.usua_id = t.usua_supervisor)
                    WHERE agen_id = " . $Id;

		    $Obj = $db->GetObject($sql);
		    $EmailTecnico = $Obj->tecnico_email;
		    $EmailSupervisor = $Obj->supervisor_email;
		    $Status = $Obj->agen_status2;

		    $this->GetEmailConfig();

	        $this->mail_config->addTo($EmailTecnico);
	        if($EmailSupervisor != ""){ $this->mail_config->addTo($EmailSupervisor); }
	        $this->mail_config->addBcc('rotiv.jr@gmail.com');
	        $this->mail_config->setSubject("Atualiza��o Status - Chamado n�: " . $Id);

	        $Template = $this->GetTemplateContent('atualizacao-status.html');
	        $Message = str_replace('#NUMERO_CHAMADO#', $Id, $Template);
	        $Message = str_replace('#NOVO_STATUS#',  $Status, $Message);
	        $Message = str_replace('#LINK#', "/admin/abertura/form.php?method=edit&id=" . $Id, $Message);

	        $this->mail_config->setBodyHtml($Message);
	        $this->mail_config->send();
	        $this->mail_config->clearRecipients();
	        $this->mail_config->clearSubject();
		}
}


class Agenda extends PAgenda {

	function RetornarHorariosEmLote($DataInicial, $DataFinal) {
		//nao permitir no mesmo horario
		$Intervalo = 1800; //intervalo de 30 minutos cada compromisso
		$DataInicial = strtotime ( $DataInicial );
		$DataFinal = strtotime ( $DataFinal );

		if($DataInicial > $DataFinal) {
			return array();
		}

		$Diff = $DataFinal - $DataInicial;
		$TotalDeCompromissos = floor ( $Diff / $Intervalo );
		$ObedecerHorarios = true;
		$ObedecerDiasUteis = true;
		$IgnorarFeriados = false;

		$TabelaDeHorarios = $this->ObterHorariosPorDiaDaSemana ();
		$TabelaDeHorariosPorDiaDaSemana = array ();
		$TabelasDiasComHorarios = array ();
		$TabelaDeFeriadosTemp = $this->ObterFeriados ();
		$TabelaDeFeriados = array ();

		foreach ( $TabelaDeFeriadosTemp as $A ) {
			$TabelaDeFeriados [$A->feri_dia] = $A;
		}
		$DiasDeFeriado = array_keys ( $TabelaDeFeriados );

		//Agrupar hor�rios por dia
		foreach ( $TabelaDeHorarios as $Dia ) {
			$TabelaDeHorariosPorDiaDaSemana [$Dia->hora_dia_semana] [] = $Dia;
		}

		$TabelasDiasComHorarios = array_keys ( $TabelaDeHorariosPorDiaDaSemana );

		$HorarioParaAgendaEmLote = array ();

		for($i = 0; $i <= $TotalDeCompromissos; $i ++) {
			$DiaDaSemana = date ( "N", $DataInicial );

			$DiaHorarioDisponivel = $TabelaDeHorariosPorDiaDaSemana [( int ) $DiaDaSemana];

			if (in_array ( $DiaDaSemana, $TabelasDiasComHorarios ) && ! in_array ( date ( "Y-m-d", $DataInicial ), $DiasDeFeriado )) {
				$HoraParaAgendar = Useful::HourToSec ( date ( "H:i:00", $DataInicial ) );

				if ($ObedecerHorarios) {
					if (($HoraParaAgendar >= Useful::HourToSec ( $DiaHorarioDisponivel [0]->hora_hora_inicio ) && $HoraParaAgendar <= Useful::HourToSec ( $DiaHorarioDisponivel [0]->hora_hora_final )) || ($HoraParaAgendar >= Useful::HourToSec ( $DiaHorarioDisponivel [1]->hora_hora_inicio ) && $HoraParaAgendar <= Useful::HourToSec ( $DiaHorarioDisponivel [1]->hora_hora_final ))) {
						$HorarioParaAgendaEmLote [] = date ( "Y-m-d H:i:00", $DataInicial );
					}
				} else {
					$HorarioParaAgendaEmLote [] [0] = date ( "Y-m-d H:i:00", $DataInicial );
				}
			}
			$DataInicial += $Intervalo;
		}

		//_debug($HorarioParaAgendaEmLote);
		$DataHoraParaAgendamento = array();
		for($i = 0; $i<sizeof($HorarioParaAgendaEmLote)-1; $i++) {

			if($i <= sizeof($HorarioParaAgendaEmLote)) {
				$DataHoraParaAgendamento[] = array($HorarioParaAgendaEmLote[$i], $HorarioParaAgendaEmLote[$i+1] );
				//echo $HorarioParaAgendaEmLote[$i] . ' -> ' . $HorarioParaAgendaEmLote[$i+1] . '<br>';
			}


		}

		return $DataHoraParaAgendamento;


	}

	function Save() {
		global $agenda_feedback, $cliente;
			//$_POST['status'] = 'Aberto';
			//gravar o vinculo com o pai

		//$agenda->RetornarHorariosEmLote('2012-08-27 13:00', '2012-08-28 18:00');
		$Erros = 0;

		if($_POST['data_inicio_hour'] == '') {
			$_POST['data_inicio_hour'] = date("H");
			$_POST['data_inicio_minute'] = '00';
		}

		if($_POST['data_termino_hour'] == '') {
			$_POST['data_termino_hour'] = date("H");
			$_POST['data_termino_minute'] = '30';
		}

		if($_POST['quantidade'] == "" || $_POST['quantidade'] == '0') {
			$_POST['quantidade'] = 1;
		}

		if($_POST['clie_id'] != "") {
			//_debug($_POST);

			if($_POST['tipo'] != "") {
				//echo 'mudar tipo do cliente';
				$cliente->UpdateTipo($_POST['clie_id'],$_POST['tipo']);
			}

			//die("die!");
		}

		//_debug($_POST);
		//die("die!");

		$CanISendNotificationToUser = false;

		if(!isset($_POST['responsavel'])) {
			$_POST['responsavel'] = $this->GetUserIdLogged();
		} else {
			$CanISendNotificationToUser = true;
		}


		//die($_POST['responsavel'] . ' -> ' . $this->GetUserIdLogged() . ' -> ' . $CanISendNotificationToUser );


		$DataInicial = Useful::DateFormatBD($_POST['data_inicio']) . " " . $_POST['data_inicio_hour'] . ":" . $_POST['data_inicio_minute'] . ":00" ;
		$DataTermino = Useful::DateFormatBD($_POST['data_termino']) . " " . $_POST['data_termino_hour'] . ":" . $_POST['data_termino_minute'] . ":00" ;


		if(parent::Save()) {

			if($CanISendNotificationToUser) {

				$_POST['mensagem'] = 'Este compromisso por cadastrado por ' . $this->GetUserNameLogged();
				$_POST['agen_id'] = $this->getId();
				$agenda_feedback->Save();

				//enviar email para o usuario sobre o compromisso cadastrado.
				//$this->SendNotificationToUser($this->getId());
			}

			return true;
		} else {
			return false;
		}

		/*$Horarios = $this->RetornarHorariosEmLote($DataInicial, $DataTermino);

		if(sizeof($Horarios) > 0) {
			//_debug($Horarios);
			$PrimeiraVez = 0 ;
			$AgendaPai = 0;

			foreach($Horarios as $Horario) {
				//adicionar
				//atualizar agen_id

				$NovoHorarioInicial = explode(' ', $Horario[0]);
				$NovoHorarioFinal = explode(' ', $Horario[1]);
				//2012-08-28 17:00:00

				$_POST[data_inicio] =  Useful::DateFormatDefault($NovoHorarioInicial[0]);
				$_POST[data_inicio_hour] = substr($NovoHorarioInicial[1], 0, 2);
				$_POST[data_inicio_minute] = substr($NovoHorarioInicial[1], 3, 2);
				$_POST[data_termino] = Useful::DateFormatDefault($NovoHorarioFinal[0]);
				$_POST[data_termino_hour] = substr($NovoHorarioFinal[1], 0, 2);
				$_POST[data_termino_minute] = substr($NovoHorarioFinal[1], 3, 2);

				//$_POST[agen_id] = '';
				//_debug($_POST);

				//validar agenda no mesmo horario
				//consultar por usuario_id

				if(parent::Save()) {
					if($PrimeiraVez == 0) {
					$AgendaPai = $this->getId();
					} else {
						//definir o pai
						$this->DefinirAgendaPai($this->getId(), $AgendaPai);
					}

					$PrimeiraVez++;
				} else {
					_debug($this);
					$Erros++;
				}
			}

			return true;

		} else {
			_debug($Horarios);
			echo 'ssssss';
			return false;
		}*/
	}

	function Update() {
		global $cliente;
		//atualizar pelo "agen_pai"

		if($_POST['clie_id'] != "") {
			//_debug($_POST);

			if($_POST['tipo'] != "") {
				//echo 'mudar tipo do cliente';
				$cliente->UpdateTipo($_POST['clie_id'],$_POST['tipo']);
			}

			//die("die!");
		}

		//atualizar somente titulo
		//$Obj = $this->GetById($_POST['id']);


		return parent::Update();
	}


	function Listing($_field = "agen_data_inicio DESC", $limit = 0, $total_per_page = 50, $search = '') {

		if($_GET[filter_data_inicio] != "" && $_GET[filter_data_termino] != "") {
					$_GET[filter_data_inicio] = Useful::DateFormatBD($_GET[filter_data_inicio]);
					$_GET[filter_data_termino] = Useful::DateFormatBD($_GET[filter_data_termino]);
				} else if($_GET[filter_data_inicio] != "" && $_GET[filter_data_termino] == "") {
					$_GET[filter_data_inicio] = Useful::DateFormatBD($_GET[filter_data_inicio]);
					$_GET[filter_data_termino] = $_GET[filter_data_inicio];
				}

		return parent::Listing($_field, $limit, $total_per_page, $search);
	}

	function SendNotificationToUser($AgendaId) {

		$Obj = $this->GetById($AgendaId);

		$this->GetEmailConfig("Agenda Corporativa");
		$this->mail_config->addTo($Obj->usua_email);
		$this->mail_config->addBcc('rotiv.jr@gmail.com');

		$this->mail_config->setSubject("Novo compromisso em " . date("d/m/Y H:i", strtotime($Obj->agen_data_inicio)));
		$this->mail_config->addHeader('X-MailGenerator', 'Agenda Corporativa');
		$Template = $this->GetTemplateContent('novo-compromisso.html');
		$Message = str_replace('#QUEM_CADASTROU#', $this->GetUserNameLogged(), $Template);
		$Message = str_replace('#CLIENTE#', $Obj->clie_razao_social, $Message);
		$Message = str_replace('#NOME#', $Obj->usua_nome, $Message);
		$Message = str_replace('#TITULO#', $Obj->agen_quantidade . ' - ' .  $Obj->agen_titulo, $Message);
		$Message = str_replace('#DATA_INICIO#', date("d/m/Y H:i", strtotime($Obj->agen_data_inicio)), $Message);
		$Message = str_replace('#DATA_TERMINO#', date("d/m/Y H:i", strtotime($Obj->agen_data_termino)), $Message);
		$Message = str_replace('#DESCRICAO#', $Obj->agen_descricao, $Message);
		$Message = str_replace('#CNPJ#', $Obj->clie_cnpj, $Message);

		$Link = "http://agendacorporativa.yoursoft.com.br/admin/";
		$Message = str_replace('#LINK#', $Link, $Message);

		$this->mail_config->setBodyHtml($Message);
		$this->mail_config->send();
		$this->mail_config->clearRecipients();
		$this->mail_config->clearSubject();
	}
}
?>
