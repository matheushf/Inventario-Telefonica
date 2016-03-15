<?php

session_start();

$doc_root = $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/';

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . $doc_root . "/lib/" . PATH_SEPARATOR . $doc_root . "/lib/external/");

//$actions = $doc_root . '/mobile/action.php';

// Requires relacionadas a Lib
require_once DOCUMENT_ROOT . '/lib/external/GeleiaFramework/UserControl.class.php';
require_once DOCUMENT_ROOT . '/lib/external/GeleiaFramework/Form.class.php';
require_once DOCUMENT_ROOT . '/lib/external/GeleiaFramework/FormMobile.class.php';
require_once DOCUMENT_ROOT . '/lib/external/Zend/Mail/Transport/Smtp.php';
require_once DOCUMENT_ROOT . '/lib/Geleia.class.php';
require_once DOCUMENT_ROOT . '/lib/GeleiaMobile.class.php';
require_once DOCUMENT_ROOT . '/lib/Usuario.class.php';
require_once DOCUMENT_ROOT . '/lib/Deposito.class.php';
require_once DOCUMENT_ROOT . '/lib/Etiquetas.class.php';
require_once DOCUMENT_ROOT . '/lib/Inventario.class.php';
require_once DOCUMENT_ROOT . '/lib/Materiais.class.php';
if (!class_exists("Zend_Validate")) { require '/Zend/Validate.php'; }
if (!class_exists("Zend_Mail")) { require '/Zend/Mail.php'; }


// Instanciar Classes
//$Usuario        = new Usuario('usuario')
$Usuario        = new Usuario('usuario');
$Deposito       = new Deposito('deposito');
$Etiquetas      = new Etiquetas('etiquetas');
$Inventario     = new Inventario();
$Materiais      = new Materiais('materiais');
$Global         = new Geleia();

//$__dir_upload_agenda = str_replace('//', '/', $doc_root . 'upload/agenda/');



