<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Inventário Online', 'none');
$InventarioLista = $Inventario->ListarInventario($OrderBy, $Search, '', $sql = 'online');
?>

<body>
    <input type="hidden" id="modulo" name="modulo" value="inventario">
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Inventário Online  </legend>

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
                        <th>
                            <a href="<?= GetQuery('?ordem=' . $ordem . '&by=leit_data') ?>">Data</a>
                        </th>
                        <th>Cód Inventário</th>
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
                        <th>Localização Interna</th>
                        <th>Id Material</th>
                        <th>Livre 1</th>
                        <th>Livre 2</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($InventarioLista as $inve) {
                        ?>
                        <tr>
                            <?php
                            $Data = $inve->leit_data;
                            $Data = explode(' ', $Data);
                            $Data = Useful::DateFormatDefault($Data[0]);
                            ?>
                            <td style="white-space: nowrap"> <?= $Data ?></td>

                            <td><?= $inve->leit_identificacao_material ?></td>

                            <td><?= $inve->mate_codigo ?></td>

                            <td><?= $inve->depo_centro ?></td>

                            <td><?= $inve->mate_nome ?></td>

                            <td><?= $inve->mate_unidade_medida ?></td>

                            <td><?= $Etiquetas->ObterLeitura($inve->leit_identificacao_material, 1); ?> </td>

                            <td><?= $Etiquetas->ObterLeitura($inve->leit_identificacao_material, 2); ?> </td>

                            <td><?= $Etiquetas->ObterLeitura($inve->leit_identificacao_material, 3); ?> </td>

                            <td><?= $inve->leit_loc_material ?> </td>

                            <td> <?= $inve->leit_id_material ?> </td>

                            <td> <?= $inve->leit_livre1 ?></td>

                            <td> <?= $inve->leit_livre2 ?></td>

                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <?php
        get_foot();