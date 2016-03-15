<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Adicionar Depósitos');

?>

<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Adicionar Depósitos  </legend>
        <small> Preencha as informações corretamente: </small>

        <form action="" method="">


            <!-- Campos do formulário -->
            <?php
            echo $Cliente->Create('clie_tipo', 'Tipo de Cliente');
            ?>


            <center>
                <button class="btn btn-danger"> Cancelar </button>
                <button class="btn btn-primary"> Salvar </button> 
            </center>

        </form>
    </fieldset>


    <?php
// put your code here
    ?>
</body>

<?php

get_foot();