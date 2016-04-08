<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

$bloquear = false;

if (isset($_GET['id'])) {
    $EtiqId = $_GET['id'];
    $EtiquetaInfo = $Etiquetas->GetById($EtiqId);
    $QuantidadeLeitura = $Etiquetas->QuantidadeLeitura($EtiqId);
    $NumeroEtiqueta = $Etiquetas->VerificarNumeroEtiqueta($EtiqId);

    if ($QuantidadeLeitura >= ($EtiquetaInfo->etiq_quantidade * 3) && $EtiquetaInfo->etiq_quantidade !== 1) {
        $bloquear = true;
        $mensagem = "A quantidade de leituras para essa etiqueta esgotou.";
    } else if ($NumeroEtiqueta >= $EtiquetaInfo->etiq_quantidade) {
        $NovaLocalizacao = false;
    } else {
        $NovaLocalizacao = true;
    }
} elseif (isset($_GET['ident'])) {
    $Identificacao = $_GET['ident'];
    $LeituraInfo = $Etiquetas->ConsultarPorIdentificacao($Identificacao);
    $EtiquetaInfo = $Etiquetas->GetById($LeituraInfo->leit_etiq_id);
    $NLeitura = $Etiquetas->VerificarNumeroLeitura($Identificacao);
    $NLeituraDepo = $Deposito->VerificarLeituraDeposito($EtiquetaInfo->etiq_depo_centro);

    if ($NLeitura > 3) {
        $bloquear = true;
        $mensagem = 'A leitura atingiu seu limite.';
    } elseif ($NLeituraDepo < $NLeitura) {
        $bloquear = true;
        $mensagem = 'A leitura ainda não foi liberada pelo depósito';
    }
}

if ($NLeitura == null) {
    $NLeitura = 1;
}


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
        <input type="hidden" id="id" value="<?php echo ($id = $LeituraInfo->leit_etiq_id) ? $id : $_GET['id']; ?>">
        <div id="page-wrapper">
            <div class="container-fluid">

                <?php
                if ($bloquear) {
                    echo "    
                    <center>
                        <h3> " . $mensagem . " </h3>
                    </center>
                    ";
                } else if ($localizacao && !isset($_GET['nova'])) {
                    include './leitura/novalocalizacao.php';
                } else {
                    include './leitura/salvarleitura.php';
                }
                ?>
            </div>
        </div>
    </body>