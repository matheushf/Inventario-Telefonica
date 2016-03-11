<?php
	session_start();

	$doc_root = ($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] != "" ? ($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] . "/") : $_SERVER['DOCUMENT_ROOT'] . "/");

	ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . $doc_root . "/lib/" . PATH_SEPARATOR . $doc_root . "/lib/external/");

	$actions =  $doc_root . '/mobile/action.php';

	require $doc_root . 'lib/external/GeleiaFramework/UserControl.class.php';
	require $doc_root . 'lib/external/GeleiaFramework/Form.class.php';
	require $doc_root . 'lib/external/GeleiaFramework/FormMobile.class.php';

	if(!class_exists("Zend_Validate")) {
		require '/Zend/Validate.php';
	}

	if(!class_exists("Zend_Mail")) {
		require '/Zend/Mail.php';
	}


	require_once 'Zend/Mail/Transport/Smtp.php';

	//add libs here
	require_once $doc_root .  '/lib/GeleiaMobile.class.php';
	$global = new Geleia();

	require_once $doc_root .  '/lib/AgendaFeedback.class.php';
 	$agenda_feedback = new AgendaFeedback('agenda_feedback');

 	require_once $doc_root . '/lib/Usuario.class.php';
	$usuario = new Usuario('usuario');

	require_once $doc_root .  '/lib/Cliente.class.php';
	 $cliente = new Cliente('cliente');

	 require_once $doc_root .  '/lib/Agenda.class.php';
 	 $agenda = new Agenda('agenda');

 	 require_once $doc_root .  '/lib/Checklist.class.php';
 	$checklist = new Checklist('checklist');

 	require_once $doc_root .  '/lib/Protocolo.class.php';
 	$protocolo = new Protocolo('protocolo');

 	require_once $doc_root .  '/lib/AgendaAnexo.class.php';
 	$agenda_anexo = new AgendaAnexo('agenda_anexo');

	function _debug($array) {
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}

	function _MarkOrderedByColumn($column) {
		global $order_by;

		if( strtolower($order_by) == $column) {
			return ' class="ordered-by" ';
		}
	}

	function _GetVarsByCSV($Var) {
		$Value = "";
		foreach ( ($Var ? $Var : Array() ) as $s) {
			$Value .= "'" . $s . "',";
		}
		return substr($Value, 0, strlen($Value) - 1);
	}

	define("__DAY", 86400);
	define("__DIR_FILES", 'C:\\Users\\Vitor\\Dropbox\\php\\projects\\crm\\files\\');
	//define("__DIR_FILES", '/srv/www/demanda.yoursoft.com.br/public_html/files/');

	$__dir_upload_agenda = str_replace('//', '/',  $doc_root . 'upload/agenda/');

	define("__URL_FILES", '/files/');

	$__DiaDaSemana['Wednesday'] = 'Quarta-feira';
	$__DiaDaSemana['Monday'] = 'Segunda-feira';
	$__DiaDaSemana['Tuesday'] = 'Ter�a-feira';
	$__DiaDaSemana['Sunday'] = 'Domingo';
	$__DiaDaSemana['Saturday'] = 'S�bado';
	$__DiaDaSemana['Friday'] = 'Sexta-feira';
	$__DiaDaSemana['Thursday'] = 'Quinta-feira';

	$__DiaDaSemanaSigla['Wednesday'] = 'Qua';
	$__DiaDaSemanaSigla['Monday'] = 'Seg';
	$__DiaDaSemanaSigla['Tuesday'] = 'Ter';
	$__DiaDaSemanaSigla['Sunday'] = 'Dom';
	$__DiaDaSemanaSigla['Saturday'] = 'S�b';
	$__DiaDaSemanaSigla['Friday'] = 'Sex';
	$__DiaDaSemanaSigla['Thursday'] = 'Qui';

	$__DiaDaSemanaSiglaLetra['Wednesday'] = 'Q';
	$__DiaDaSemanaSiglaLetra['Monday'] = 'S';
	$__DiaDaSemanaSiglaLetra['Tuesday'] = 'T';
	$__DiaDaSemanaSiglaLetra['Sunday'] = 'S';
	$__DiaDaSemanaSiglaLetra['Saturday'] = 'S';
	$__DiaDaSemanaSiglaLetra['Friday'] = 'S';
	$__DiaDaSemanaSiglaLetra['Thursday'] = 'Q';


	$__Mes['January'] = 'Janeiro';
	$__Mes['February'] = 'Fevereiro';
	$__Mes['March'] = 'Mar�o';
	$__Mes['April'] = 'Abril';
	$__Mes['May'] = 'Maio';
	$__Mes['June'] = 'Junho';
	$__Mes['July'] = 'Julho';
	$__Mes['August'] = 'Agosto';
	$__Mes['September'] = 'Setembro';
	$__Mes['October'] = 'Outubro';
	$__Mes['November'] = 'Novembro';
	$__Mes['December'] = 'Dezembro';



?>
