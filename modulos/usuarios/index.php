<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Usuarios', 'grid');

mensagem();

$UsuariosLista = $Usuario->Listing();

?>

<body>
    <input type="hidden" id="modulo" name="modulo" value="usuario">
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Usuários  </legend>

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
                </div>
            </div>
        </div>

        <br><br>

        <div class="alert alert-info text-center"> Use os Filtros: Nome</div>

        <br><br>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Tipo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($UsuariosLista as $usuario) {
                    ?>
                <tr>
                    <td>
                    <center>
                        <input type="checkbox" id="<?php echo $usuario->usua_id ?>" value="<?php echo $usuario->usua_id ?>">
                    </center>
                    </td>                            
                    <td>
                        <?php echo $usuario->usua_nome ?>
                    </td>
                    <td>
                        <?php echo $usuario->usua_email ?>
                    </td>
                    <td>
                        <?php echo $usuario->usua_celular ?>
                    </td>
                    <td>
                        <?php echo $usuario->usua_tipo ?>
                    </td>
                    <td>
                        <?php echo $usuario->usua_status ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>

    </fieldset>

</body>

<?php
get_foot();
