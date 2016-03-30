<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

//$acao = $_GET['acao'] ? $_GET['acao'] : $_POST['acao'];

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "alterar_leitura": {
            $DepoId  = $_POST['id'];
            $Leitura = $_POST['leitura'];

            if ($Deposito->AlterarLeitura($DepoId, $Leitura)) {
                echo 'OK';
            } else {
                'erro';
            }

            break;
        }

    case "importar": {
            $nome = md5($_FILES['arquivo_csv']['name'] . time()) . '.csv';
            $destino = $_SERVER['DOCUMENT_ROOT'] . 'Temp/' . $_FILES['arquivo_csv']['name'];

            move_uploaded_file($_FILES["arquivo_csv"]["tmp_name"], $destino);

            if ($Deposito->ImportarDepositos($destino)) {
                $_SESSION['Mensagem']['tipo'] = "sucesso";
                $_SESSION['Mensagem']['texto'] = "Deposito importado com sucesso.";

                header('Location: /modulos/depositos/');
            } else {
                echo 'erro';
            }
        }
}