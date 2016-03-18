<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

error_reporting(E_ALL);

get_head('Etiquetas', 'grid');

echo mensagem();

$EtiquetasLista = $Etiquetas->ListarEtiquetas();
?>

<body>
    <input type="hidden" id="modulo" name="modulo" value="etiquetas">

    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Etiquetas  </legend>

        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-primary" id="btn-novo">Novo</button>
                <button class="btn btn-primary" id="btn-editar">Editar</button>
                <button class="btn btn-primary" id="btn-excluir">Excluir</button>
                <button class="btn btn-primary" id="gerar-qr" data-toggle="modal" data-target="#qr-modal">Gerar Check-in 2D</button>
            </div>
            <div class="col-sm-6 ">
                <div class="form-inline pull-right">
                    <input type="text" size="20" class="form-control" id="busca" name="busca">
                    <button class="btn btn-primary">Procurar</button>
                    <button class="btn btn-primary" id="importar-lista">Importar Lista</button>
                </div>
            </div>
        </div>

        <br><br>

        <div class="alert alert-info text-center"> Use os Filtros: EPS - Material - Centro</div>

        <br><br>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th style="width: 50px"></th>
                    <th>Cód Final Inventário</th>
                    <th>Cód Leitura 1       </th>
                    <th>Cód Leitura 2       </th>
                    <th>Cód Leitura 3       </th>
                    <th>Material            </th>
                    <th>Texto Breve Material</th>
                    <th>Unidade de Medida   </th>
                    <th>EPS                 </th>
                    <th>Centro              </th>
                    <th>Cidade              </th>
                    <th>Qtd Etiquetas       </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($EtiquetasLista as $etiquetas) {
                    ?>
                <tr>
                    <td>
                        <center>
                            <input type="checkbox" id="<?php echo $etiquetas->etiq_id ?>" value="<?php echo $etiquetas->etiq_id ?>">
                        </center>
                    </td>
                    <td>
                        <?php echo $etiquetas->etiq_cod_final ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->etiq_cod_leitura1 ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->etiq_cod_leitura2 ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->etiq_cod_leitura3 ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->mate_codigo ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->mate_nome ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->mate_unidade_medida ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->depo_empresa ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->depo_centro ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->depo_cidade ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->etiq_quantidade ?>
                    </td>                
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>

    </fieldset>


</body>

<script>
    $(document).ready(function () {
        //    $("#gerar-qr").on("click", function())
    })
</script>

<?php
get_foot();
?>

<!-- Modal -->
<div id="qr-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
                <?php
                QRcode::png('ttter', 'temp.png');
                ?>
                <img src="temp.png" width="80%" height="80%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>