<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Adicionar Depósitos');

?>

<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class="scheduler-border"> Adicionar Depósitos  </legend>
        <p> Preencha as informações corretamente: </p>
        <br>
        
        <form action="" method="">


            <!-- Campos do formulário -->
            <?php
            echo $Deposito->Create('depo_empresa', 'Nome da Empresa');
            echo $Deposito->Create('depo_centro', 'Email');
            echo $Deposito->Create('depo_regiao', 'Região');
            echo $Deposito->Create('depo_tipo_logradouro', 'Tipo Logradouro');
            echo $Deposito->Create('depo_logradouro', 'Logradouro');
            echo $Deposito->Create('depo_numero', 'Numero');
            echo $Deposito->Create('depo_bairro', 'Bairro');
            echo $Deposito->Create('depo_complemento', 'Complemento');
            echo $Deposito->Create('depo_cidade', 'Cidade');
            echo $Deposito->Create('depo_cep', 'CEP');
            echo $Deposito->Create('depo_status', 'Status');
            echo $Deposito->Create('depo_livre1', 'Livre 1');
            echo $Deposito->Create('depo_livre1', 'Livre 2');
            echo $Deposito->Create('depo_livre1', 'Livre 3');
            echo $Deposito->Create('depo_observacao', 'Observação');
            
            ?>


            <center style="margin-top: 50px">
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