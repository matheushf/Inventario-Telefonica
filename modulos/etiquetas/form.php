<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Etiquetas', 'form');
?>
<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Etiquetas  </legend>
        <p> Preencha as informações corretamente: </p>
        <br>

        <form action="" method="" id="form">

            <!-- Campos do formulário -->
            <?php
            echo $Etiquetas->Create('etiq_id', 'Id');
            echo $Etiquetas->Create('etiq_centro', 'Centro');
            echo $Etiquetas->Create('etiq_material', 'Material');
            echo $Etiquetas->Create('etiq_quantidade', 'Quantidade');
            echo $Etiquetas->Create('etiq_observacao', 'Observação');
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
