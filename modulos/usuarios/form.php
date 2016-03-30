<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Adicionar Usuário', 'form');

if (isset($_GET['id'])) {
    $ArrayUsuario = $Usuario->GetById($_GET['id'], true);
    $Usuario->PopulateFormFromDB($ArrayUsuario);
}
?>
<script src="/assets/js/jquery.maskedinput.min.js"></script>
<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Adicionar Usuário  </legend>
        <p> Preencha as informações corretamente: </p>
        <br>

        <form action="" method="post" id="form_usuario" enctype="multipart/form-data" data-operacao="<?php echo $_GET['operacao']; ?>">


            <!-- Campos do formulário -->
            <?php
            echo $Usuario->create('usua_id', 'id');
            echo $Usuario->create('usua_nome', 'Nome');
            if ($_GET['operacao'] == 'atualizar') {
                echo $Usuario->create('usua_senha', 'Senha antiga');
                ?>

                <label for="confirmar_senha"> Confirmar senha </label>
                <input type="password" class="form-control" id="confirmar_senha" required="true">
                <br>
                <?php
            } else {
                echo $Usuario->create('usua_senha', 'Senha');
            }
            echo $Usuario->create('usua_email', 'Email');
            echo $Usuario->create('usua_celular', 'Celular');
            echo $Usuario->create('usua_tipo', 'Tipo');
            echo $Usuario->create('usua_status', 'Status');
            ?>


            <center style="margin-top: 50px">
                <button class="btn btn-danger" id="cancelar"> Cancelar </button>
                <button class="btn btn-primary" id="btn-salvar" > Salvar </button> 
            </center>

        </form>
    </fieldset>


    <?php
// put your code here
    ?>
</body>

<script>

    jQuery(function ($) {
        $("#celular").mask("(99) 9999-9999");
    });

    $(document).ready(function () {
        pass = $("#senha");
        pass.val(null);

        $("#btn-salvar").on("click", function (event) {

            if (pass.val() != $("#confirmar_senha").val()) {
                alert("As senhas não conferem.");
                event.preventDefault();
                return;
            }
        })
    })

</script>
<?php
get_foot();
