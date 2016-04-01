<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Inventário', 'grid');

$InventarioLista = $Inventario->ListarInventario($OrderBy, $Search, $Paginacao);
//_debug($InventarioLista);
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
                            <a href="<?= GetQuery('?ordem='. $ordem . '&by=leit_data') ?>">Data</a>
                        </th>
                        <th> N. Leitura </th>
                        <th>Cód Inventário</th>
                        <th>Cód Material</th>
                        <th>Centro</th>
                        <th>
                            <a href="<?= GetQuery('?ordem='. $ordem . '&by=mate_nome') ?>">Descrição Material</a>
                        </th>
                        <th>Unidade de Medida</th>
                        <th>R$ Unitário</th>
                        <th>R$ Total</th>
                        <th>Leitura </th>
                        <th>Qtd EMPZ</th>
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
    <!--                    <td>
                        <center>-->
                            <!--<input type="checkbox" id="<?php //$inve->etiq_id   ?>"   value="<?php //echo $inve->etiq_id   ?>">-->
                            <!--                        </center>
                                                </td>-->
                            <?php
                            $Data = $inve->leit_data;
                            $Data = explode(' ', $Data);
                            $Data = Useful::DateFormatDefault($Data[0]);
                            ?>
                            <td style="white-space: nowrap"> <?= $Data ?></td>

                            <td><?= $inve->leit_nu_leitura ?> </td>

                            <td><?= $inve->etiq_cod_final ?></td>

                            <td><?= $inve->mate_codigo ?></td>

                            <td><?= $inve->depo_centro ?></td>

                            <td><?= $inve->mate_nome ?></td>

                            <td><?= $inve->mate_unidade_medida ?></td>

                            <td style="white-space: nowrap"> <?= sprintf('R$ %01.2f', $inve->mate_valor_unitario) ?> </td>

                            <td> </td>

                            <td><?= $inve->leit_quantidade_aferida ?> </td>

                            <td><?php // qtd empz   ?> </td>

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
            <a href="" download id="download"><span style="display: none">download</span></a>
        </div>

        <script>
            $(document).ready(function () {
                $("#exportar-csv").on("click", function () {
                    $(this).after('<br><p id="loader"><i class="fa fa-refresh fa-spin"></i> Exportando CSV...</p>');
                    
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
                            if (data != 'erro') {
                                var mensagem = '<div class="alert alert-success"> Registros exportados com sucesso. </div>';
                                $("#mensagens").html(mensagem);
                                $("#download").attr("href", data);
                                $("#download span").trigger('click');
                                console.log(data);
                                $("#loader").remove();
                            } else {
                                var mensagem = '<div class="alert alert-danger"> Ocorreu um erro ao exportar. </div>';
                                $("#mensagens").html(mensagem);
                            }
                        }
                    })
                })
            })
        </script>

        <?php
        get_foot('grid');
        