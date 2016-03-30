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
            $_SESSION['imagens'] = NULL;
            unset($_SESSION['imagens']);

            $folder = md5(time());
            if (mkdir('Temp/' . $folder)) {
                echo $folder;
            } else {
                echo 'erro';
            }
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
            }

            break;
        }

    case "gerar_pdf_etiqueta": {
            $Folder = $_POST['folder'];
            $nome = $Etiquetas->GerarPDFEtiquetas($Folder);

            $_SESSION['imagens'] = NULL;
            unset($_SESSION['imagens']);

            rrmdir('Temp/' . $Folder);

            echo $nome;

            break;
        }

    case "deletar_pdf": {
            $Arquivo = $_POST['arquivo'];

            unlink($Arquivo);
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
            $cpf = $_POST['cpf'];

            $res = $Etiquetas->SalvarLeitura($QuantidadeAferida, $IdMaterial, $LocMaterial, $Livre1, $Livre2, $EtiquetaId, $MateId, $Cod_leitura, $cpf);

            if ($res) {
                setcookie('cpf', $cpf, time() + (1000 * 30), '/');

                $_SESSION['Mensagem']['tipo'] = "sucesso";
                $_SESSION['Mensagem']['texto'] = "Leitura salva com sucesso.";

                header('Location: /modulos/etiquetas/');
            } else {
                $_SESSION['Mensagem']['tipo'] = "erro";
                $_SESSION['Mensagem']['texto'] = "Ocorreu algum erro, tente novamente.";
            }

            break;
        }

    case "importar": {
            $nome = md5($_FILES['arquivo_csv']['name'] . time()) . '.csv';
            $destino = $_SERVER['DOCUMENT_ROOT'] . '/Temp/' . $_FILES['arquivo_csv']['name'];

            move_uploaded_file($_FILES["arquivo_csv"]["tmp_name"], $destino);

            if ($Etiquetas->ImportarEtiquetas($destino)) {
                $_SESSION['Mensagem']['tipo'] = "sucesso";
                $_SESSION['Mensagem']['texto'] = "Etiquetas importado com sucesso.";

                header('Location: /modulos/etiquetas/');
            } else {
                echo 'erro';
            }
        }
}