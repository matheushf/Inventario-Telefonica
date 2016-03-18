<?php

function get_head($Titulo, $FormGrid = null, $path = null) {

    if (!isset($path))
        $path = 'head.php';

    include (DOCUMENT_ROOT . '/' . $path);
}

function get_foot($path = null) {

    if (!isset($path))
        $path = 'foot.php';

    require_once (DOCUMENT_ROOT . '/' . $path);
}

function _debug($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function _GetVarsByCSV($Var) {
    $Value = "";
    foreach (($Var ? $Var : Array()) as $s) {
        $Value .= "'" . $s . "',";
    }
    return substr($Value, 0, strlen($Value) - 1);
}

// Exibe mensagens definidas pela sessão
function mensagem() {

    if (isset($_SESSION['Mensagem']['tipo'])) {
        switch ($_SESSION['Mensagem']['tipo']) {

            case "error": {
                    echo '<div class="alert alert-danger">' . $_SESSION['Mensagem']['texto'] . ' </div>';

                    break;
                }

            case "sucesso": {
                    echo '<div class="alert alert-success">' . $_SESSION['Mensagem']['texto'] . '</div>';

                    break;
                }
        }
        unset($_SESSION['Mensagem']);
    }
}
