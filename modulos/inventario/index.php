<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Inventário', 'grid');
?>

<body>
    <input type="hidden" id="modulo" name="modulo" value="inventario">
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Inventário  </legend>

        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-primary" id="exportar-csv"> Exportar CSV    </button>
            </div>
            <div class="col-sm-6 ">
                <div class="form-inline pull-right">
                    <input type="text" size="20" class="form-control" id="busca" name="busca">
                    <button class="btn btn-primary">Procurar</button>
                </div>
            </div>
        </div>

        <br><br>

        <div class="alert alert-info text-center"> Use os Filtros: Data - Centro - Material - EPS</div>

        <br><br>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Thead</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tbody</td>
                </tr>
            </tbody>
        </table>





    </fieldset>


    <?php
    // put your code here
    ?>
</body>

<?php
get_foot();
