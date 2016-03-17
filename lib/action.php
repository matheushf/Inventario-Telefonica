<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

switch ($_GET['acao']) {
    case 'inserir': {
        $FuncoesPadroes->Save($_GET['modulo']);
        
        break;
    }
        
    case 'atualizar': {
        $FuncoesPadroes->Update($_GET['modulo']);
        
        break;
    }
        
}
