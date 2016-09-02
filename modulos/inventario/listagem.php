<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';
get_head(' Listagem ');
$InventarioLista = $Inventario->ListarInventario($OrderBy, $Search, '', $sql = 'listagem');
?>

<body>
    <input type="hidden" id="modulo" name="modulo" value="inventario">
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Listagem  </legend>

        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-info" id="exportar-csv"> Exportar CSV    </button>
            </div>

            <div class="col-sm-6">
                <div class="form-inline pull-right">
                    <form class="form-group">
                        <input type="text" size="20" class="form-control" id="busca" name="busca" value="<?= $_GET['busca'] ?>">
                        <button class="btn btn-primary" id="procurar" type="submit">Procurar</button>
                    </form>
                </div>
            </div>
        </div>

        <br><br>

        <div class="alert alert-info text-center"> Use os Filtros: Data - Centro - Material - EPS</div>

        <br>
        <?= count($InventarioLista) . ' resultados encontrados.'; ?>
        <br> <br> <br>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered ">
                <thead>
                    <tr>
<!--                <th style="width: 50px">
                <center>
                    <input type="checkbox" id="check_all" value="">
                </center>
                </th>-->
                        <th>Cód Material</th>
                        <th>
                            <a href="<?= GetQuery('?ordem=' . $ordem . '&by=depo_centro') ?>">
                                Centro
                            </a>
                        </th>
                        <th>
                            <a href="<?= GetQuery('?ordem=' . $ordem . '&by=mate_nome') ?>">Descrição Material</a>
                        </th>
                        <th>Unidade de Medida</th>
                        <th> Contagem 1</th>
                        <th> Contagem 2 </th>
                        <th> Contagem 3 </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($InventarioLista as $inve) {
                        ?>
                        <tr>
                            <td><?= $inve->mate_codigo ?></td>

                            <td><?= $inve->depo_centro ?></td>

                            <td><?= $inve->mate_nome ?></td>

                            <td><?= $inve->mate_unidade_medida ?></td>

                            <td><?= $Etiquetas->ObterLeitura($inve->depo_centro, 1, $inve->etiq_cod_final); ?> </td>

                            <td><?= $Etiquetas->ObterLeitura($inve->depo_centro, 2, $inve->etiq_cod_final); ?> </td>

                            <td><?= $Etiquetas->ObterLeitura($inve->depo_centro, 3, $inve->etiq_cod_final); ?> </td>

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
        