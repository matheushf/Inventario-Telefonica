<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Adicionar Depósitos', 'form');

if ($_GET['id']) {
    $ArrayDeposito = $Deposito->GetById($_GET['id'], true);
    $Deposito->PopulateFormFromDB($ArrayDeposito);
}

?>
<body>
        
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Adicionar Depósitos  </legend>
        <p> Preencha as informações corretamente: </p>
        <br>
        
        <form action="" method="post" id="form_deposito" enctype="multipart/form-data" data-operacao="<?php echo $_GET['operacao']; ?>">

            <!-- Campos do formulário -->
            <?php
            
            echo $Deposito->Create('depo_id', 'Id');
            echo $Deposito->Create('depo_empresa', 'Nome da Empresa');
            echo $Deposito->Create('depo_centro', 'Centro');
            echo $Deposito->Create('depo_regiao', 'Região');
            echo $Deposito->Create('depo_tipo_logradouro', 'Tipo Logradouro');
            echo $Deposito->Create('depo_logradouro', 'Logradouro');
            echo $Deposito->Create('depo_numero', 'Numero');
            echo $Deposito->Create('depo_bairro', 'Bairro');
            echo $Deposito->Create('depo_complemento', 'Complemento');
            echo $Deposito->Create('depo_cidade', 'Cidade');
            echo $Deposito->Create('depo_cep', 'CEP');
            echo $Deposito->Create('depo_status', 'Status');
            echo $Deposito->Create('depo_livre1', 'Segmento');
            echo $Deposito->Create('depo_livre2', 'Livre 2');
            echo $Deposito->Create('depo_livre3', 'Livre 3');
            echo $Deposito->Create('depo_observacao', 'Observação');
            echo $Deposito->Create('depo_leitura', 'leitura');
            
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