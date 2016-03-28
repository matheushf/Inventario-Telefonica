<?php
session_start();

set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );
set_include_path($_SERVER['DOCUMENT_ROOT'] . '/lib/' . ';' .  $_SERVER['DOCUMENT_ROOT'] . '/lib/external/GeleiaFramework');
// Variaveis globais de sistema
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

// Requires relacionados a Configurações e Funcões
require_once 'Funcoes.php';
require_once 'Global.php';

require_once 'lib/action.php';

error_reporting(E_ALL, ~E_DEPRECATED, ~E_STRICT);
ini_set("display_errors", 1);