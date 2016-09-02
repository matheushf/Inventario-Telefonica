<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

//$acao = $_GET['acao'] ? $_GET['acao'] : $_POST['acao'];

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = $_POST['acao'];
}

switch ($acao) {

    case "gerar_qr": {
        $IdEtiqueta = $_POST['id'];
        $CodigoMaterial = $_POST['cod_mate'];
        $NomeMaterial = $_POST['nome_mate'];
        $UnidadeMedida = $_POST['unidade_medida'];
        $Centro = $_POST['centro'];
        $QtdEtiquetas = $_POST['qtde_etq'];
        $Folder = $_POST['folder'];

        $Etiquetas->GerarQrCode($IdEtiqueta, $QtdEtiquetas, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida, $Folder);


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
        $Identificacao = $_POST['identificacao'];
        $nome = $_POST['nome'];
        $centro = $_POST['centro'];

        // Salvar cookie do nome
        setcookie('nome', $nome, time() + (10 * 365 * 24 * 60 * 60), "/");

        // Identificar se ja tem a quantidade de leituras da etiqueta cadastradas
        $leitura = $Etiquetas->VerificarNumeroLeitura($centro);
        $quant_leitura = $Etiquetas->QuantidadeLeituraAtual($EtiquetaId, $leitura);
        $quant_etiqueta = $Etiquetas->GetById($EtiquetaId)->etiq_quantidade;

        if ($quant_etiqueta == $quant_leitura) {
            $_SESSION['Mensagem']['tipo'] = "error";
            $_SESSION['Mensagem']['texto'] = "A leitura desta etiqueta atingiu o limite.";

            header('Location: /modulos/etiquetas/');

            return false;
        }

        $res = $Etiquetas->SalvarLeitura($QuantidadeAferida, $IdMaterial, $LocMaterial, $Livre1, $Livre2, $EtiquetaId, $MateId, $Cod_leitura, $Identificacao, $nome, $centro);

        if ($res === true) {
            $_SESSION['Mensagem']['tipo'] = "sucesso";
            $_SESSION['Mensagem']['texto'] = "Leitura salva com sucesso.";

            header('Location: /modulos/etiquetas/');
        } else {
            $_SESSION['Mensagem']['tipo'] = "error";
            $_SESSION['Mensagem']['texto'] = $res;
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
        break;
    }

    case "consultar_localizacao": {
        $localizacao = $_POST['local'];
        $EtiquetaId = $_POST['etiqId'];

        $Identificacao = $Etiquetas->ConsultarPorLocalizacao($localizacao, $EtiquetaId);
        echo $Identificacao->leit_identificacao_material;

        break;
    }
}