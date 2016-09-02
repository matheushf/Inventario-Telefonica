<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Quadro', 'grid');
$Etiquetas = $Etiquetas->TerceiraLeitura($Search);

?>

    <body>
    <input type="hidden" id="modulo" name="modulo" value="inventario">
<fieldset class="scheduler-border" style="margin-top: 20px">
    <legend class=""> Terceira Leitura</legend>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-inline pull-right">
                <form class="form-group">
                    <input type="text" size="20" class="form-control" id="busca" name="busca"
                           value="<?= $_GET['busca'] ?>">
                    <button class="btn btn-primary" id="procurar" type="submit">Procurar</button>
                </form>
            </div>
        </div>
    </div>

    <br><br>

    <!--    <div class="alert alert-info text-center"> Use os Filtros: Centro</div>-->

    <br> <br> <br>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered ">
            <thead>
            <tr>
                <th> Cód Final Inventário</th>
                <th> Centro</th>
                <th> Contagem 1</th>
                <th> Contagem 2</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($Etiquetas as $etiqueta) { ?>
                <tr>
                    <td><?= $etiqueta->codigo ?></td>
                    <td><?= $etiqueta->leit_centro ?></td>
                    <td><?= $etiqueta->total1 ?></td>
                    <td><?= $etiqueta->total2 ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="" download id="download"><span style="display: none">download</span></a>
    <input type="hidden" value="<?= $OrderBy ?>" id="order">
    <input type="hidden" value="<?= $Search ?>" id="search">
    <input type="hidden" value="true" id="listagem">

    <script type="text/javascript" src="js/inventario.js"></script>

<?php
get_foot();