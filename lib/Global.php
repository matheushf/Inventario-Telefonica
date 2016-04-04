<?php

$doc_root = $_SERVER['DOCUMENT_ROOT'] . '/';

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . $doc_root . "/lib/" . PATH_SEPARATOR . $doc_root . "/lib/external/");

// Requires relacionadas a Lib
require_once 'external/GeleiaFramework/UserControl.class.php';
require_once 'external/GeleiaFramework/Form.class.php';
require_once 'external/GeleiaFramework/FormMobile.class.php';
require_once 'external/Zend/Mail/Transport/Smtp.php';
require_once 'Geleia.class.php';
require_once 'GeleiaMobile.class.php';
require_once 'Usuario.class.php';
require_once 'Deposito.class.php';
require_once 'Etiquetas.class.php';
require_once 'Inventario.class.php';
require_once 'Materiais.class.php';
require_once 'FuncoesPadroes.php';
require_once 'MetodosUtil.php';
//if (!class_exists("Zend_Validate")) { require '/Zend/Validate.php'; }
//if (!class_exists("Zend_Mail")) { require '/Zend/Mail.php'; }

// Instanciar Classes
$Usuario        = new Usuario('usuario');
$Deposito       = new Deposito('deposito');
$Etiquetas      = new Etiquetas('etiquetas');
$Inventario     = new Inventario('inventario');
$Materiais      = new Materiais('materiais');
$Global         = new Geleia();
$FuncoesPadroes = new FuncoesPadroes();


// Operações Usadas em GRID

// Ordenação
if ($_GET['ordem'] == 'ASC') {
    $ordem = 'DESC';
} else {
    $ordem = 'ASC';
}

if ($_GET['ordem'] != '') {
    $OrderBy = 'ORDER BY ' . $_GET['by'] . ' ' . $_GET['ordem'];
} else {
    $OrderBy = null;
}

// Busca
if ($_GET['busca']) {
    $Search = $_GET['busca'];
} else {
    $Search = null;
}

// Verificar se está logado
if (!EstaLogado() && !preg_match('/mleitura/', $_SERVER['SCRIPT_FILENAME']) && !preg_match('/acoes/', $_SERVER['SCRIPT_FILENAME'])) {
    header ('Location: /index.php');
}

// Paginação
if ($_GET['page'] && $_GET['page'] != 1) {
    $Pagina = $_GET['page'];
    $limit = 100;
    $ofset = ($limit * $Pagina) - $limit;
    $Paginacao = 'LIMIT ' . $limit . ' OFFSET ' . $ofset;
} else {
    $Pagina = 1;
    $Paginacao = ' LIMIT 100 ';
}