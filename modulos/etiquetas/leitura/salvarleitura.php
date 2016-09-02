<?php
$nome = (isset($_COOKIE['nome'])) ? $_COOKIE['nome'] : null;

if ($EtiquetaInfo->etiq_id_bobina)
    $bobina_state = "readonly='readonly'";
else
    $bobina_state = "disabled='disabled'";

//if (preg_match('/bobina/is', $EtiquetaInfo->mate_nome))


?>

<center>
    <h2>Contagem <?= $NLeitura ?> </h2>
</center>

<h3><b>Centro:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->depo_centro ?></span></h3>
<h3><b>Material:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->mate_codigo ?></h3>
<h3><b>Descrição:</b> <span style="color: blueviolet"><?php echo $EtiquetaInfo->mate_nome ?></h3>

<br><br>
<form name="form_leitura" action="acoes.php?acao=salvar_leitura" method="POST" onsubmit="form_leitura.confirmar.disabled = true; return true;" role="form">
    <input type="hidden" name="centro" value="<?= $EtiquetaInfo->depo_centro ?>">
    <div class="form-group">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" class="form-control" value="<?= $nome ?>">
    </div>
    <div class="form-group">
        <label for="quant_aferida">Quantidade Aferida: </label>
        <input type="text" class="form-control" name="quant_aferida" id="quant_aferida" required="true">
    </div>
    <div class="form-group">
        <label for="conf_quant">Confirmar Quantidade: </label>
        <input type="text" class="form-control" name="conf_quant" id="conf_quant" required="true">
    </div>
    <div class="form-group">
        <label for="id_mate">Id Material: </label>
        <input type="text" class="form-control" name="id_mate" id="id_mate" required="true"
               value="<?= $EtiquetaInfo->etiq_id_bobina ?>" <?= $bobina_state ?> >
    </div>
    <div class="form-group">
        <label for="loc_mate">Loc. Material: </label>
        <input type="text" class="form-control" name="loc_mate" id="loc_mate" required="true" value="<?php
        if (isset($_GET['localizacao'])) {
            echo $_GET['localizacao'];
        }
        ?>">
    </div>
    <div class="form-group">
        <label for="livre1">Livre 1: </label>
        <input type="text" class="form-control" name="livre1" id="quant_aferida">
    </div>
    <div class="form-group">
        <label for="livre2">Livre 2: </label>
        <input type="text" class="form-control" name="livre2" id="livre2">
    </div>

    <?php if ($_GET['nova']) { ?>
        <input type="hidden" name="nova" value="true">
    <?php } ?>
    <input type="hidden" name="identificacao" value="<?= $_GET['ident'] ?>">
    <input type="hidden" name="etiq_id" value="<?php echo ($id = $LeituraInfo->leit_etiq_id) ? $id : $_GET['id']; ?>"
           id="etiq_id">
    <input type="hidden" name="mate_id" value="<?= $EtiquetaInfo->mate_id ?>">
    <input type="hidden" name="etiq_cod_final" value="<?= $EtiquetaInfo->etiq_cod_final ?>">
    <!--<input type="hidden" name="num_leitura" value=""-->

    <center>
        <input type="submit" class="btn btn-primary" id="confirmar" value="Confirmar Material" style="margin: 30px">
    </center>
</form>