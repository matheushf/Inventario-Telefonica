<?php

// Caso o material escolhido seja bobina:
// Criar um campo a mais para salvar os ID's de cada bobina
// Gravar tudo em apenas UM campo na tabela etiquetas, separado por #
// Ao for fazer a leitura, pesquisar a etiqueta para saber os ID's
// Trazer o id por ordem de leitura, caso seja a primeira, traz o primeiro ID, caso seja a segunda, traz o segundo, etc
// Colocar o ID em um campo ReadOnly no form de leitura

require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';
get_head('Etiquetas', 'form');

if ($_GET['id']) {
    $ArrayEtiquetas = $Etiquetas->GetById($_GET['id'], true);
    $Etiquetas->PopulateFormFromDB($ArrayEtiquetas);
}
?>
    <body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Etiquetas</legend>
        <p> Preencha as informações corretamente: </p>
        <br>

        <form action="" method="post" id="form_etiquetas" enctype="multipart/form-data"
              data-operacao="<?php echo $_GET['operacao']; ?>">

            <!-- Campos do formulário -->
            <?php if ($_GET['id']) { ?>
                <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
                <?php
            }
            //            echo $Etiquetas->Create('etiq_id', 'etiq_id');
            echo $Etiquetas->Create('etiq_depo_centro', 'Centro');
            echo $Etiquetas->Create('etiq_mate_material', 'Material');
            echo $Etiquetas->Create('etiq_quantidade', 'Quantidade');
//            echo "<div id='bobina'>";
            echo $Etiquetas->Create('etiq_id_bobina', 'ID Bobinas');
//            echo "<input type='hidden' value='{$ArrayEtiquetas[etiq_id_bobina]}' id='bobina_valor'>";
//            echo "</div>";
            echo $Etiquetas->Create('etiq_observacao', 'Observação');
            echo $Etiquetas->Create('etiq_cod_final', 'cod_final_id');
            echo $Etiquetas->Create('etiq_leitura', 'etiq_leitura');
            ?>


            <center style="margin-top: 50px">
                <button class="btn btn-primary" id="btn-salvar" type="submit"> Salvar</button>
                <a class="btn btn-danger" id="cancelar" href="index.php">Cancelar </a>

            </center>

        </form>
    </fieldset>


    <?php
    // put your code here
    ?>
    </body>

    <script type="text/javascript" src="js/form.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/selectize/microplugin.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/selectize/selectize.portugues.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/plugins/selectize/selectize.default.css"/>
    <script>
        $(document).ready(function () {
            $('#depo_centro').removeClass('form-control');
            $('#mate_material').removeClass('form-control');

            $('#depo_centro').selectize({maxItems: 1});
            $('#mate_material').selectize({maxItems: 1});

        });
    </script>

<?php
get_foot();
