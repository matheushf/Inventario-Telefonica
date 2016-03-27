<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

//$acao = $_GET['acao'] ? $_GET['acao'] : $_POST['acao'];

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "diretorio_image": {
            $folder = md5(time());
            if (mkdir('Temp/' . $folder)) {
                echo $folder;
            } else {
                echo 'erro';
            }

//            $_SESSION['imagens'] = array();
        }

    case "gerar_imagem_etiqueta": {
            $IdEtiqueta = $_POST['id'];
            $CodigoMaterial = $_POST['cod_mate'];
            $NomeMaterial = $_POST['nome_mate'];
            $UnidadeMedida = $_POST['unidade_medida'];
            $Centro = $_POST['centro'];
            $QtdEtiquetas = $_POST['qtde_etq'];
            $Folder = $_POST['folder'];

            $res = $Etiquetas->CriarImagemEtiqueta($IdEtiqueta, $QtdEtiquetas, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida, $Folder);

            if ($res) {
                echo $IdEtiqueta;


//                return true;
//                $Etiquetasb->GerarPDFEtiquetas($QtdEtiquetas, $CodigoMaterial);
            }

            break;
        }

    case "gerar_pdf_etiqueta": {
            $Folder = $_POST['folder'];
            $Etiquetas->GerarPDFEtiquetas($Folder);

            
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

                header('Location: /modulos/etiquetas/');
            } else {
                echo 'erro';
            }
        }
}