<?php

// Variaveis globais de sistema
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/');
define('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);
define('SCRIPT_URL', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']);


// Requires relacionados a Configurações e Funcões
require_once 'Funcoes.php';
require_once 'Config.php';
require_once 'Global.php';