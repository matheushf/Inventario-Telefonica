<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Depósitos', 'grid');

echo mensagem();

$Depositos = $Deposito->ListarDeposito();
?>

<body>
    <input type="hidden" id="modulo" name="modulo" value="deposito">
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Depósitos  </legend>

        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-primary" id="btn-novo">Novo          </button>
                <button class="btn btn-primary" id="btn-editar">Editar      </button>
                <button class="btn btn-primary" id="btn-excluir">Excluir    </button>
            </div>
            <div class="col-sm-6 ">
                <div class="form-inline pull-right">
                    <input type="text" size="20" class="form-control" id="busca" name="busca">
                    <button class="btn btn-primary">Procurar</button>
                    <button class="btn btn-primary" id="importar-lista">Importar Listar</button>
                </div>
            </div>
        </div>

        <br><br>

        <div class="alert alert-info text-center"> Use os Filtros: EPS - Centro - Cidade</div>

        <br><br>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th style="width: 50px"></th>
                    <th>EPS     </th>
                    <th>Centro  </th>
                    <th>Cidade  </th>
                    <th>Status  </th>
                    <th>Livre 1 </th>
                    <th>Livre 2 </th>
                    <th>Livre 3 </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Depositos as $dep) {
                    ?>
                    <tr>
                <td>
                <center>
                    <input type="checkbox" id="<?php echo $dep->depo_id ?>" value="<?php echo $dep->depo_id ?>">
                </center>
                </td>                        
                <td>
                    <?php echo $dep->depo_empresa ?>
                </td>
                <td>
                    <?php echo $dep->depo_centro ?>
                </td>
                <td>
                    <?php echo $dep->depo_cidade ?>
                </td>
                <td>
                    <?php echo $dep->depo_status ?>
                </td>
                <td>
                    <?php echo $dep->depo_livre1 ?>
                </td>
                <td>
                    <?php echo $dep->depo_livre2 ?>
                </td>
                <td>
                    <?php echo $dep->depo_livre3 ?>
                </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </fieldset>


    <?php
    // put your code here
    ?>
</body>

<?php
get_foot();
