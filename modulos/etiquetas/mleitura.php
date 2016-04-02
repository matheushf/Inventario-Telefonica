<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

$bloquear = false;

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (isset($_GET['ident'])) {
    $Identificacao  = $_GET['ident'];
    $LeituraInfo    = $Etiquetas->ConsultarPorIdentificacao($Identificacao);
    $EtiquetaInfo   = $Etiquetas->GetById($LeituraInfo->leit_etiq_id);
    $NLeitura       = $Etiquetas->VerificarNumeroLeitura($Identificacao);
    $NLeituraDepo   = $Deposito->VerificarLeituraDeposito($EtiquetaInfo->etiq_depo_centro);
    
    if ($NLeitura == 4) {
        $bloquear = true;
        $mensagem = 'A leitura atingiu seu limite.';
    } elseif ($NLeituraDepo < $NLeitura) {
        $bloquear = true;
        $mensagem = 'A leitura ainda não foi liberada pelo depósito';
    }
} 
elseif ($_GET['id']) {
    $EtiqId = $_GET['id'];
    $EtiquetaInfo   = $Etiquetas->GetById($EtiqId);
    $QuantidadeLeitura = $Etiquetas->QuantidadeLeitura($EtiqId);
    $QuantidadeEtiqueta = $EtiquetaInfo->etiq_quantidade * 3;
    
    if ($QuantidadeLeitura >= $QuantidadeEtiqueta) {
        $bloquear = true;
        $mensagem = "A quantidade de leituras para essa etiqueta esgotou.";
    }
    
}

if (isset($_GET['nova'])) {
    $NLeitura = 1;
}

$localizacao = $Etiquetas->ListarLocalizacao($_GET['id']);

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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <style>

        </style>

    </head>

    <body style="background-color: #f3f3f4">
        <input type="hidden" id="id" value="<?php echo ($id = $LeituraInfo->leit_etiq_id) ? $id : $_GET['id']; ?>">
        <div id="page-wrapper">
            <div class="container-fluid">

                <?php if ($bloquear) { ?>

                    <center>
                        <h3><?= $mensagem ?> </h3>
                    </center>

                <?php } else if ($localizacao && !isset($_GET['nova'])) { ?>

                    <input type="hidden" id="ident" value="<?= $_GET['ident'] ?>">
                    <div class="row">
                        <div class="col-lg-4"> </div>
                        <center>
                            <div class="col-lg-4" style="margin-top: 200px">
                                <p>Selecione a localização: </p>
                                <br>
                                <?= $Etiquetas->SelectLocalizacao($localizacao) ?>
                                <br> <br>
                                <a type="submit" id="acessar" class="btn btn-info">Acessar</a>
                                <br>ou<br>
                                <a type="submit" id="nova" class="btn btn-primary">Nova Localização</a>
                            </div>
                        </center>
                    </div>                

                <?php } else { ?>
                    <center>
                        <h2>Contagem <?= $NLeitura ?> </h2>
                    </center>

                    <h3><b>Centro:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->depo_centro ?></span> </h3>
                    <h3><b>Material:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->mate_codigo ?> </h3>
                    <h3><b>Descrição:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->mate_nome ?> </h3>

                    <br><br>
                    <form action="acoes.php?acao=salvar_leitura" method="POST" role="form">
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
                <input type="text" class="form-control"  name="loc_mate" id="loc_mate" required="true" value="<?php if(isset($_GET['localizacao'])) { echo $_GET['localizacao']; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="livre1">Livre 1: </label>
                            <input type="text" class="form-control"  name="livre1" id="quant_aferida" >
                        </div>
                        <div class="form-group">
                            <label for="livre2">Livre 2: </label>
                            <input type="text" class="form-control"  name="livre2" id="livre2" >
                        </div>
                        
                        <?php if ($_GET['nova']) { ?>
                        <input type="hidden" name="nova" value="true">
                        <?php } ?>
                        <input type="hidden" name="identificacao" value="<?= $_GET['ident'] ?>">
                        <input type="hidden" name="etiq_id" value="<?php echo ($id = $LeituraInfo->leit_etiq_id) ? $id : $_GET['id']; ?>" id="etiq_id">
                        <input type="hidden" name="mate_id" value="<?= $EtiquetaInfo->mate_id ?>">
                        <input type="hidden" name="etiq_cod_final" value="<?= $EtiquetaInfo->etiq_cod_final ?>">
                        <!--<input type="hidden" name="num_leitura" value=""-->

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
            id = $("#id").val();

            $("a").attr("style", "width: 150px");            

            $("#acessar").on("click", function (event) {
                $(this).after('<br><p id="loader"><i class="fa fa-refresh fa-spin"></i> Processando...</p>');
                $.ajax({
                    type: 'POST',
                    url: 'acoes.php',
                    data: {
                        acao: 'consultar_localizacao',
                        local: $("select").val()
                    },
                    success: function (data) {
                        console.log(data);

                        if (data == 'erro') {
                            alert("Ocorreu um erro, tente novamente.");
                        } else {
                            window.location.assign('?ident=' + data + '&localizacao=' + $("#localizacao").val());
                        }
                        $("#loader").remove();
                    }
                })

            })
//            alert(id);
            $("#nova").on("click", function() {
                window.location.assign('?id=' + id + '&nova=1');
            })

            $("#confirmar").on("click", function (event) {
                if ($("#quant_aferida").val() != $("#conf_quant").val()) {
                    alert("A quantidade não confere.");
                    event.preventDefault();
                    return;
                }
            })
        })
    </script>
