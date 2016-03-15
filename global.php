<?php

session_start();

$doc_root = $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/';

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . $doc_root . "/lib/" . PATH_SEPARATOR . $doc_root . "/lib/external/");

//$actions = $doc_root . '/mobile/action.php';



if (!class_exists("Zend_Validate")) {
    require '/Zend/Validate.php';
}

if (!class_exists("Zend_Mail")) {
    require '/Zend/Mail.php';
}

require_once $doc_root . 'lib/external/GeleiaFramework/UserControl.class.php';
require_once $doc_root . 'lib/external/GeleiaFramework/Form.class.php';
require_once $doc_root . 'lib/external/GeleiaFramework/FormMobile.class.php';
require_once $doc_root . 'lib/external/Zend/Mail/Transport/Smtp.php';
require_once $doc_root . '/lib/GeleiaMobile.class.php';
require_once $doc_root . '/lib/AgendaFeedback.class.php';
require_once $doc_root . '/lib/Usuario.class.php';
require_once $doc_root . '/lib/Cliente.class.php';
require_once $doc_root . '/lib/Agenda.class.php';
require_once $doc_root . '/lib/Checklist.class.php';
require_once $doc_root . '/lib/Protocolo.class.php';
require_once $doc_root . '/lib/AgendaAnexo.class.php';
require_once 'Funcoes.php';
require_once 'Config.php';


$agenda_anexo = new AgendaAnexo('agenda_anexo');
$protocolo = new Protocolo('protocolo');
$checklist = new Checklist('checklist');
$agenda = new Agenda('agenda');
$cliente = new Cliente('cliente');
$usuario = new Usuario('usuario');
$agenda_feedback = new AgendaFeedback('agenda_feedback');
$global = new Geleia();
$__dir_upload_agenda = str_replace('//', '/', $doc_root . 'upload/agenda/');



