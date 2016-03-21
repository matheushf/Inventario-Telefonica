<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Inventário', 'grid');

$InventarioLista = $Inventario->ListarInventario();
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
                    <button class="btn btn-primary" id="importar-lista">Importar Listar</button>
                </div>
            </div>
        </div>

        <br><br>

        <div class="alert alert-info text-center"> Use os Filtros: Data - Centro - Material - EPS</div>

        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered ">
                <thead>
                    <tr>
                        <th> </th>
                        <th>Data</th>
                        <th>Cód Inventário</th>
                        <th>Cód Material</th>
                        <th>Centro</th>
                        <th>Descrição Material</th>
                        <th>Unidade de Medida</th>
                        <th>Qtd LVUT</th>
                        <th>Qtd Exec</th>
                        <th>Qtd Amed</th>
                        <th>Total SAP</th>
                        <th>R$ Unitário</th>
                        <th>R$ Total</th>
                        <th>Leitura 1</th>
                        <th>Leitura 2</th>
                        <th>Leitura 3</th>
                        <th>Leitura Final</th>
                        <th>Qtd Exec(EPS)</th>
                        <th>Qtd AMED(EPS)</th>
                        <th>Qtd CPCON</th>
                        <th>EXEC+AMED+CONT FÍS</th>
                        <th>Dif. Final Qtd</th>
                        <th>Dif. Negativa</th>
                        <th>Dif. Positiva</th>
                        <th>Acurac. Física</th>
                        <th>Acurac. Fin.</th>
                        <th>Localização Interna</th>
                        <th>Material</th>
                        <th>Livre 1</th>
                        <th>Livre 2</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($InventarioLista as $inve) {
                        ?>
                    <tr>
                        <td>
                            <center>
                                <input type="checkbox" id="<?php echo $inve->etiq_id ?>" value="<?php echo $inve->etiq_id ?>">
                            </center>
                        </td>
                        <td><?php ?></td>

                        <td><?php ?></td>

                        <td><?php echo $inve->mate_codigo ?></td>

                        <td><?php echo $inve->depo_centro ?></td>

                        <td><?php echo $inve->mate_nome ?></td>

                        <td><?php echo $inve->mate_nome ?></td>

                        <td><?php echo $inve->mate_unidade_medida ?></td>

                        <td><?php ?></td>

                        <td><?php ?></td>

                        <td><?php ?></td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                        <td> </td>

                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
<?php
get_foot('grid');
