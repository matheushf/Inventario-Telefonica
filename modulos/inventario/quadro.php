<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Quadro', 'grid');
$InventarioLista = $Inventario->ListarInventario($OrderBy, $Search, '', $sql = 'quadro');

?>

    <body>
    <input type="hidden" id="modulo" name="modulo" value="inventario">
<fieldset class="scheduler-border" style="margin-top: 20px">
    <legend class=""> Quadro</legend>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-inline pull-right">
                <form class="form-group">
                    <input type="text" size="20" class="form-control" id="busca" name="busca" value="<?= $_GET['busca'] ?>">
                    <button class="btn btn-primary" id="procurar" type="submit">Procurar</button>
                </form>
            </div>
        </div>
    </div>

    <br><br>

    <div class="alert alert-info text-center"> Use os Filtros: Centro</div>

    <br> <br> <br>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered ">
            <thead>
            <tr>
                <th>
                    <a href="<?= GetQuery('?ordem=' . $ordem . '&by=depo_centro') ?>">
                        Centro
                    </a>
                </th>
                <th> Materiais </th>
                <th> Contagem 1 </th>
                <th> Contagem 2 </th>
                <th> Geral </th>

            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($InventarioLista as $inve) {

                ?>
                <tr>
                    <td><?= $inve->depo_centro ?></td>

                    <td><?= $Materiais->QuantidadePorCentro($inve->depo_centro) ?> </td>

                    <td><?= $Etiquetas->PorcentagemLeit($inve->depo_centro, 1); ?>% </td>

                    <td><?= $Etiquetas->PorcentagemLeit($inve->depo_centro, 2); ?>% </td>

                    <td><?= $Etiquetas->PorcentagemGeral($inve->depo_centro); ?> </td>


                </tr>
                <?php
            }
            ?>
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
        