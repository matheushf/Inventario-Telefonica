<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

$EtiquetaId = $_GET['id'];

$EtiquetaInfo = $Etiquetas->getById($EtiquetaId);

$NLeituraEtiq = $Etiquetas->VerificarLeituraAberta($EtiquetaInfo->etiq_id);

$NLeituraDepo = $Deposito->VerificarLeituraDeposito($EtiquetaInfo->etiq_depo_centro);

if ($NLeituraEtiq == 4) {
    $bloquear = true;
    $mensagem = 'A leitura atingiu seu limite.';
} elseif ($NLeituraDepo < $NLeituraEtiq) {
    $bloquear = true;
    $mensagem = 'A leitura ainda não foi liberada pelo depósito';
}

mensagem();
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
        <script src="/assets/js/jquery.maskedinput.min.js"></script>


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


        <script type="text/javascript">
            jQuery(function ($) {
                $("#cpf").mask("999.999.999-99");
            });
        </script>
    </head>

    <body style="background-color: #f3f3f4">
        <div id="page-wrapper">
            <div class="container-fluid">

                <?php if ($bloquear) { ?>

                    <center>
                        <h3><?= $mensagem ?> </h3>
                    </center>

                    <?php
                } else {
                    ?>    
                    <center>
                        <h2>Leitura <?= $NLeituraEtiq ?> </h2>
                    </center>

                    <h3><b>Centro:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->depo_centro ?></span> </h3>
                    <h3><b>Material:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->mate_codigo ?> </h3>
                    <h3><b>Descrição:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->mate_nome ?> </h3>

                    <br><br>
                    <form action="acoes.php?acao=salvar_leitura" method="POST" role="form">
                        <div class="form-group">
                            <label for="quant_aferida">CPF: </label>
                            <input type="text" class="form-control"  name="cpf" id="cpf" required="true" value="<?php if (isset($_COOKIE['cpf'])) { echo $_COOKIE['cpf']; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="quant_aferida">Quantidade Aferida: </label>
                            <input type="text" class="form-control"  name="quant_aferida" id="quant_aferida" required="true">
                        </div>
                        <div class="form-group">
                            <label for="conf_quant">Confirmar Quantidade: </label>
                            <input type="text" class="form-control"  name="conf_quant" id="conf_quant" required="true">
                        </div>
                        <div class="form-group">
                            <label for="id_mate">Id Material: </label>
                            <input type="text" class="form-control"  name="id_mate" id="id_mate" required="true">
                        </div>
                        <div class="form-group">
                            <label for="loc_mate">Loc. Material: </label>
                            <input type="text" class="form-control"  name="loc_mate" id="loc_mate" required="true">
                        </div>
                        <div class="form-group">
                            <label for="livre1">Livre 1: </label>
                            <input type="text" class="form-control"  name="livre1" id="quant_aferida" >
                        </div>
                        <div class="form-group">
                            <label for="livre2">Livre 2: </label>
                            <input type="text" class="form-control"  name="livre2" id="livre2" >
                        </div>

                        <input type="hidden" name="etiq_id" value="<?= $EtiquetaInfo->etiq_id ?>">
                        <input type="hidden" name="mate_id" value="<?= $EtiquetaInfo->mate_id ?>">
                        <input type="hidden" name="etiq_cod_final" value="<?= $EtiquetaInfo->etiq_cod_final ?>">

                        <center>
                            <input type="submit" class="btn btn-primary" id="confirmar" value="Confirmar Material" style="margin: 30px">
                        </center>
                    </form>
                <?php } ?>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            $("#confirmar").on("click", function (event) {
                if ($("#quant_aferida").val() != $("#conf_quant").val()) {
                    alert("A quantidade não confere.");
                    event.preventDefault();
                    return;
                }
            })
        })
    </script>