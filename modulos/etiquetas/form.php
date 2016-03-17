<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Etiquetas', 'form');
?>
<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Etiquetas  </legend>
        <p> Preencha as informações corretamente: </p>
        <br>

        <form action="" method="post" id="form_etiquetas" enctype="multipart/form-data" data-operacao="<?php echo $_GET['operacao']; ?>">

            <!-- Campos do formulário -->
            <?php
            echo $Etiquetas->Create('etiq_id', 'etiq_id');
            echo $Etiquetas->Create('etiq_depo_centro', 'Centro');
            echo $Etiquetas->Create('etiq_mate_material', 'Material');
            echo $Etiquetas->Create('etiq_quantidade', 'Quantidade');
            echo $Etiquetas->Create('etiq_observacao', 'Observação');
            echo $Etiquetas->Create('mate_id', 'mate_id');
            ?>


            <center style="margin-top: 50px">
                <button class="btn btn-danger" id="cancelar"> Cancelar </button>
                <button class="btn btn-primary" id="btn-salvar" name="btn-salvar" type="submit"> Salvar </button> 
            </center>

        </form>
    </fieldset>


<?php
// put your code here
?>
</body>

<?php
get_foot();
