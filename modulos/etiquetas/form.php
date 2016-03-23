<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Etiquetas', 'form');

if ($_GET['id']) {
    $ArrayEtiquetas = $Etiquetas->GetById($_GET['id'], true);
    $Etiquetas->PopulateFormFromDB($ArrayEtiquetas);
}

?>
<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Etiquetas  </legend>
        <p> Preencha as informações corretamente: </p>
        <br>

        <form action="" method="post" id="form_etiquetas" enctype="multipart/form-data" data-operacao="<?php echo $_GET['operacao']; ?>">

            <!-- Campos do formulário -->
            <?php if($_GET['id']) { ?>
            <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
            <?php
            }
//            echo $Etiquetas->Create('etiq_id', 'etiq_id');
            echo $Etiquetas->Create('etiq_depo_centro', 'Centro');
            echo $Etiquetas->Create('etiq_mate_material', 'Material');
            echo $Etiquetas->Create('etiq_quantidade', 'Quantidade');
            echo $Etiquetas->Create('etiq_observacao', 'Observação');
            echo $Etiquetas->Create('etiq_cod_final', 'cod_final_id');
            
            ?>


            <center style="margin-top: 50px">
                <button class="btn btn-danger" id="cancelar"> Cancelar </button>
                <button class="btn btn-primary" id="btn-salvar" type="submit"> Salvar </button> 
            </center>

        </form>
    </fieldset>


<?php
// put your code here
?>
</body>

<?php
get_foot();
