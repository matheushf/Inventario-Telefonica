<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

//$acao = $_GET['acao'] ? $_GET['acao'] : $_POST['acao'];

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "gerar_etiqueta": {
            $IdEtiqueta = $_POST['id'];
            $CodigoMaterial = $_POST['cod_mate'];
            $NomeMaterial = $_POST['nome_mate'];
            $UnidadeMedida = $_POST['unidade_medida'];
            $Centro = $_POST['centro'];
            $QtdEtiquetas = $_POST['qtde_etq'];

            $res = $Etiquetas->CriarImagemEtiqueta($IdEtiqueta, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida);

            if ($res) {
                $Etiquetas->GerarPDFEtiquetas($QtdEtiquetas, $CodigoMaterial);
            }

//            var_dump($res);
//            die();

            break;
        }

    case "salvar_leitura": {
            $QuantidadeAferida = $_POST['quant_aferida'];
            $IdMaterial = $_POST['id_mate'];
            $LocMaterial = $_POST['loc_mate'];
            $Livre1 = $_POST['livre1'];
            $Livre2 = $_POST['livre2'];
            $EtiquetaId = $_POST['etiq_id'];
            $MateId = $_POST['mate_id'];
            $Cod_leitura = $_POST['etiq_cod_final'];

//        var_dump($_POST);
//        die();

            $Etiquetas->SalvarLeitura($QuantidadeAferida, $IdMaterial, $LocMaterial, $Livre1, $Livre2, $EtiquetaId, $MateId, $Cod_leitura);
        }

    case "importar": {
            $nome = md5($_FILES['arquivo_csv']['name'] . time()) . '.csv';
            $destino = DOCUMENT_ROOT . 'Temp/' . $_FILES['arquivo_csv']['name'];

            var_dump(move_uploaded_file($_FILES["arquivo_csv"]["tmp_name"], $destino));

            if ($Etiquetas->ImportarEtiquetas($destino)) {
                $_SESSION['Mensagem']['tipo'] = "sucesso";
                $_SESSION['Mensagem']['texto'] = "Etiquetas importado com sucesso.";

                header('Location: /vivo-inventario/modulos/etiquetas/');
            } else {
                echo 'erro';
            }
        }
}