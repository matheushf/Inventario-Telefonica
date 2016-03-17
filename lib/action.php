<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

switch ($_GET['acao']) {
    case 'inserir': {
        
        if($FuncoesPadroes->Save($_GET['modulo'])) {
            $_SESSION['Mensagem']['tipo'] = "sucesso";
            $_SESSION['Mensagem']['texto'] = ucfirst($_GET['modulo']) . " inserido com sucesso.";
            header('Location: index.php');
            
        } else {
            $_SESSION['Mensagem']['tipo'] = "error";
            $_SESSION['Mensagem']['texto'] = "Ocorreu um erro ao realizar sua solicitação.";
            
        }
        
        break;
    }
        
    case 'atualizar': {
        $FuncoesPadroes->Update($_GET['modulo']);
        
        break;
    }
        
}
