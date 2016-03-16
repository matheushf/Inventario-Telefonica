<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('', 'form');

?>
<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Titulo  </legend>
        <p> Preencha as informações corretamente: </p>
        <br>
        
        <form action="" method="post" id="form_ " enctype="multipart/form-data" data-operacao="<?php echo $_GET['operacao']; ?>">


            <!-- Campos do formulário -->
            <?php
            ?>


            <center style="margin-top: 50px">
                <button class="btn btn-danger" id="cancelar"> Cancelar </button>
                <button class="btn btn-primary" id="btn-salvar" name="btn-salvar"> Salvar </button> 
            </center>

        </form>
    </fieldset>


    <?php
// put your code here
    ?>
</body>

<?php

get_foot();