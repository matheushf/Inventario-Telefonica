<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Materiais', 'form');
?>
<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Materiais  </legend>
        <p> Preencha as informações corretamente: </p>
        <br>

        <form action="" method="post" id="form_materiais" enctype="multipart/form-data" data-operacao="<?php echo $_GET['operacao']; ?>">

            <!-- Campos do formulário -->
            <?php
            echo $Materiais->Create('mate_id', 'Id');
            echo $Materiais->Create('mate_codigo', 'Código');
            echo $Materiais->Create('mate_nome', 'Texto Breve do Material');
            echo $Materiais->Create('mate_unidade_medida', 'Unidade de Medida');
            echo $Materiais->Create('mate_valor_unitario', 'Valor Unitário');
            echo $Materiais->Create('mate_livre1', 'Livre 1');
            echo $Materiais->Create('mate_livre2', 'Livre 2');
            echo $Materiais->Create('mate_livre3', 'Livre 3');
            echo $Materiais->Create('mate_observacao', 'Observação');
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
