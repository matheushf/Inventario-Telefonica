<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

// TODOS OS CODIGOS COMENTADOS SAO PARA LEMBRAR DO QUE SE TINHA ANTES
// APAGAR AO TERMINAR

$bloquear = false;

// Caso esteja sendo a Etiqueta no geral, puxar as informações

$EtiqId = $_GET['id'];
$EtiquetaInfo = $Etiquetas->GetById($EtiqId);
$NLeitura = $EtiquetaInfo->depo_leitura;
$QLAtual = $Etiquetas->QuantidadeLeituraAtual($EtiqId, $EtiquetaInfo->depo_leitura);

if ($QLAtual >= $EtiquetaInfo->etiq_quantidade) {
    $bloquear = true;
    $mensagem = "A quantidade de leituras para essa contagem esgotou, libere a seguinte no depósito.";
}

//if (!$NLeitura) $NLeitura = 1;

$localizacao = $Etiquetas->ListarLocalizacao($_GET['id']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Leitura </title>

    <link href="/assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="/assets/css/animate.css" rel="stylesheet">
    <!--<link href="/assets/css/style.css" rel="stylesheet">-->
    <link href="/assets/css/style-adicional.css" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="/assets/js/jquery-1.11.3.min.js"></script>
    <script src="/assets/js/bootstrap/js/bootstrap.min.js"></script>

    <script src="js/leitura.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


</head>

<body style="background-color: #f3f3f4">
<input type="hidden" id="id" value="<?= ($id = $LeituraInfo->leit_etiq_id) ? $id : $_GET['id']; ?>">
<div id="page-wrapper">
    <div class="container-fluid">

        <?php
        if ($bloquear) {
            echo "    
                    <center>
                        <h3> " . $mensagem . " </h3>
                    </center>
                    ";
        } else {
            include './leitura/salvarleitura.php';
        }
        ?>
    </div>
</div>
</body>