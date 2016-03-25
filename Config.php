<?php
session_start();

// Variaveis globais de sistema
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
define('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);

// Requires relacionados a Configurações e Funcões
require_once 'Funcoes.php';
require_once 'Global.php';

require_once 'lib/action.php';

error_reporting(E_ALL, ~E_DEPRECATED, ~E_STRICT);
ini_set("display_errors", 1);