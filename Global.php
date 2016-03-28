<?php

$doc_root = $_SERVER['DOCUMENT_ROOT'] . '/';

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . $doc_root . "/lib/" . PATH_SEPARATOR . $doc_root . "/lib/external/");

// Requires relacionadas a Lib
require_once 'lib/external/GeleiaFramework/UserControl.class.php';
require_once 'lib/external/GeleiaFramework/Form.class.php';
require_once 'lib/external/GeleiaFramework/FormMobile.class.php';
require_once 'lib/external/Zend/Mail/Transport/Smtp.php';
require_once 'lib/Geleia.class.php';
require_once 'lib/GeleiaMobile.class.php';
require_once 'lib/Usuario.class.php';
require_once 'lib/Deposito.class.php';
require_once 'lib/Etiquetas.class.php';
require_once 'lib/Inventario.class.php';
require_once 'lib/Materiais.class.php';
require_once 'lib/FuncoesPadroes.php';
require_once 'lib/MetodosUtil.php';
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
if (!EstaLogado()) {
    header ('Location: /index.php');
}

// Paginação
if ($_GET['page']) {
    $Pagina = $_GET['page'];
    $limit = 50;
    $ofset = ($limit * $Pagina) - $limit;
    $Paginacao = 'LIMIT ' . $limit . ' OFFSET ' . $ofset;     
} else {
    $Pagina = 1;
    $Paginacao = null;
}