<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Inventário', 'grid');

$InventarioLista = $Inventario->ListarInventario($OrderBy, $Search, $Paginacao);
//_debug($InventarioLista);
//die();


//$arquivo = fopen('lista.csv', 'w');
//
//foreach ($InventarioLista as $linhas) {
//    $linhas = (array) $linhas;
//
//    var_dump($linhas);
//    echo '<br><br>';
//
//    fputcsv($arquivo, $linhas);
//}
//
//fclose($arquivo);
//
//die();
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
                    <form class="form-group">
                        <input type="text" size="20" class="form-control" id="busca" name="busca" value="<?= $_GET['busca'] ?>">
                        <button class="btn btn-primary" id="procurar" type="submit">Procurar</button>
                    </form>
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
                        <th style="width: 50px">
                <center>
                    <input type="checkbox" id="check_all" value="">
                </center>
                </th>
                <th>Data</th>
                <th>Cód Inventário</th>
                <th>Cód Material</th>
                <th>Centro</th>
                <th>
                    <a href="?ordem=<?= $ordem ?>&by=mate_nome">Descrição Material</a>
                </th>
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
                <th>Qtd EMPZ</th>
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
                    <td style="white-space: nowrap"> <?= $inve->leit_data ?></td>

                    <td><?= $inve->etiq_cod_final ?></td>

                    <td><?= $inve->mate_codigo ?></td>

                    <td><?= $inve->depo_centro ?></td>

                    <td><?= $inve->mate_nome ?></td>

                    <td><?= $inve->mate_unidade_medida ?></td>

                    <td><?php //qtd lvut    ?></td>

                    <td><?php // qtd amed    ?></td>

                    <td><?php // total sap    ?></td>

                    <td><?php ?></td>

                    <td><?php echo $inve->mate_valor_unitario ?> </td>

                    <td> </td>

                    <td><?= $Etiquetas->ObterLeitura($inve->etiq_id, $inve->mate_id, 1); ?> </td>

                    <td><?= $Etiquetas->ObterLeitura($inve->etiq_id, $inve->mate_id, 2); ?> </td>

                    <td><?= $Etiquetas->ObterLeitura($inve->etiq_id, $inve->mate_id, 3); ?> </td>

                    <td><?php $Etiquetas->ObterLeitura($inve->etiq_id, $inve->mate_id, 3);    ?> </td>

                    <td> <?php //Qtd Exec(EPS)   ?> </td>

                    <td> <?php //Qtd AMED(EPS)   ?> </td>

                    <td> <?php //Qtd EMPZ   ?> </td>

                    <td><?php //EXEC+AMED+CONT FÍS    ?> </td>

                    <td> <?php //Dif. Final Qtd   ?> </td>

                    <td> <?php //Dif. Negativa   ?> </td>

                    <td> <?php //Dif. Positiva   ?> </td>

                    <td> <?php //Acurac. Física   ?> </td>

                    <td> <?php //Acurac. Fin.   ?> </td>

                    <td> <?= $Etiquetas->ObterLocalizacao($inve->etiq_id, $inve->mate_id); ?> </td>

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

        <script>
            $(document).ready(function () {
                $("#exportar-csv").on("click", function () {
                    $.ajax({
                        type: 'POST',
                        url: 'acoes.php',
                        data: {
                            acao: 'exportar_csv',
                            order_by: '<?= $OrderBy ?>',
                            search: '<?= $Search ?>',
                            paginacao: '<?= $Paginacao ?>'
                        },
                        success: function (data) {
                            console.log(data);
                        }
                    })
                })
            })
        </script>

        <?php
        get_foot('grid');
        