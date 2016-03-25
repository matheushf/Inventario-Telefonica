<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "importar": {
            error_reporting();
            $nome = md5($_FILES['arquivo_csv']['name'] . time()) . '.csv';
            $destino = DOCUMENT_ROOT . 'Temp/' . $_FILES['arquivo_csv']['name'];

            var_dump(move_uploaded_file($_FILES["arquivo_csv"]["tmp_name"], $destino));

            if ($Materiais->ImportarMateriais($destino)) {
                $_SESSION['Mensagem']['tipo'] = "sucesso";
                $_SESSION['Mensagem']['texto'] = "Materiais importados com sucesso.";

                header('Location: /vivo-inventario/modulos/materiais/');
            }
        }
}