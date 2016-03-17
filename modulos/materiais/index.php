<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Materiais', 'grid');

$MateriaisLista = $Materiais->ListarMateriais();
?>

<body>
    <input type="hidden" id="modulo" name="modulo" value="materiais">
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Titulo  </legend>

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

        <div class="alert alert-info text-center"> Use os Filtros: Material - Texto Breve em Material </div>

        <br><br>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th style="width: 50px"></th>
                    <th>Material                </th>
                    <th>Texto Breve Material    </th>
                    <th>Unidade de Medida       </th>
                    <th>Valor Unitário          </th>
                    <th>Livre 1                 </th>
                    <th>Livre 2                 </th>
                    <th>Livre 3                 </th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($MateriaisLista as $mate) {
                    ?>
                    <tr>
                <td>
                <center>
                    <input type="checkbox" id="<?php echo $mate->mate_id ?>" value="<?php echo $mate->mate_id ?>">
                </center>
                </td>                            
                <td>
                    <?php echo $mate->mate_codigo ?>
                </td>
                <td>
                    <?php echo $mate->mate_nome ?>
                </td>
                <td>
                    <?php echo $mate->mate_unidade_medida ?>
                </td>
                <td>
                    <?php echo $mate->mate_valor_unitario ?>
                </td>
                <td>
                    <?php echo $mate->mate_livre1 ?>
                </td>
                <td>
                    <?php echo $mate->mate_livre2 ?>
                </td>
                <td>
                    <?php echo $mate->mate_livre3 ?>
                </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </fieldset>

    <?php
    get_foot();
    