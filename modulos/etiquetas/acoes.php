<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

//$acao = $_GET['acao'] ? $_GET['acao'] : $_POST['acao'];

if(isset($_GET['acao'])) {
    $acao = $_GET['acao'];    
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "gerar_etiqueta": {
            $CodigoMaterial = $_POST['cod_mate'];
            $NomeMaterial = $_POST['nome_mate'];
            $UnidadeMedida = $_POST['unidade_medida'];
            $Centro = $_POST['centro'];
            $QtdEtiquetas = $_POST['qtde_etq'];
            
            $res = $Etiquetas->CriarImagemEtiqueta($CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida);
            
            if ($res) {
                $Etiquetas->GerarPDFEtiquetas($QtdEtiquetas, $CodigoMaterial);
            }
            
//            var_dump($res);
//            die();
            
            break;
        }
}