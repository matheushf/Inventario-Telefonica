<?php

/*
 * ## Criar campo mate_id_material no banco de dados
 * ## Será informado sempre que cadastrar um material novo, ou importando
 * Para todos os materias terá o valor padrão "0", exceto para bobinas, que poderá cadastrar um valor específico
 * O valor do id cadastrado de todos os materias deverá aparecer na leitura da etiqueta (precisando apenas fazer a busca daquele
 * material e retornar qual o seu id (eu acho)
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Materiais', 'form');

if (isset($_GET['id'])) {
    $ArrayMateriais = $Materiais->GetById($_GET['id'], true);
    $Materiais->PopulateFormFromDB($ArrayMateriais);
}

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
