<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

//$acao = $_GET['acao'] ? $_GET['acao'] : $_POST['acao'];

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "alterar_leitura": {
        $DepoId     = $_POST['id'];
        $Leitura    = $_POST['leitura'];
        
        if($Deposito->AlterarLeitura($DepoId, $Leitura)) {
            echo 'OK';
        } else {
            'erro';
        }
        
        break;
    }
}