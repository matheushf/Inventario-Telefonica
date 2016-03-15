<?php

session_start();

$doc_root = $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/';

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . $doc_root . "/lib/" . PATH_SEPARATOR . $doc_root . "/lib/external/");

//$actions = $doc_root . '/mobile/action.php';

// Requires relacionadas a Lib
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
if (!class_exists("Zend_Validate")) { require '/Zend/Validate.php'; }
if (!class_exists("Zend_Mail")) { require '/Zend/Mail.php'; }




// Instanciar Classes
$Agenda_Anexo = new AgendaAnexo('agenda_anexo');
$Protocolo = new Protocolo('protocolo');
$Checklist = new Checklist('checklist');
$Agenda = new Agenda('agenda');
$Cliente = new Cliente('cliente');
$Usuario = new Usuario('usuario');
$Agenda_Feedback = new AgendaFeedback('agenda_feedback');
$Global = new Geleia();
$__dir_upload_agenda = str_replace('//', '/', $doc_root . 'upload/agenda/');



