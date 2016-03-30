<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "importar": {
            error_reporting();
            $nome = md5($_FILES['arquivo_csv']['name'] . time()) . '.csv';
            $destino = $_SERVER['DOCUMENT_ROOT'] . 'Temp/' . $_FILES['arquivo_csv']['name'];

            move_uploaded_file($_FILES["arquivo_csv"]["tmp_name"], $destino);

            if ($Materiais->ImportarMateriais($destino)) {
                $_SESSION['Mensagem']['tipo'] = "sucesso";
                $_SESSION['Mensagem']['texto'] = "Materiais importados com sucesso.";

                header('Location: /modulos/materiais/');
            }
        }
}