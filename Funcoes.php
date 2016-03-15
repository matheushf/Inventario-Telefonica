<?php

function get_head($Titulo, $path = null) {
    
    if (!isset($path) ) $path = 'head.php';
    
    require_once (DOCUMENT_ROOT . '/' . $Caminho);
}

function get_foot($Titulo, $path = null) {
    
    if (!isset($path) ) $path = 'foot.php';
    
    require_once (DOCUMENT_ROOT . '/' . $Caminho);
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