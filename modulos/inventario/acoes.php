<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

//$acao = $_GET['acao'] ? $_GET['acao'] : $_POST['acao'];

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "exportar_csv": {
            $OrderBy        = $_POST['order_by'];
            $Search         = $_POST['search'];
            $Paginacao      = $_POST['paginacao'];
            
            $Inventario->ExportarCsv($OrderBy, $Search, $Paginacao);

            break;
        }
}