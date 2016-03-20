<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

//error_reporting(E_ALL);

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
                <button class="btn btn-primary" id="gerar-qr">Gerar Check-in 2D</button>
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
                        <input type="hidden" value="<?php echo $etiquetas->mate_codigo ?>" class="mate_codigo">
                    </td>
                    <td>
                        <?php echo $etiquetas->mate_nome ?>
                        <input type="hidden" value="<?php echo $etiquetas->mate_nome ?>" class="mate_nome">
                    </td>
                    <td>
                        <?php echo $etiquetas->mate_unidade_medida ?>
                        <input type="hidden" value="<?php echo $etiquetas->mate_unidade_medida ?>" class="unidade_medida">
                    </td>
                    <td>
                        <?php echo $etiquetas->depo_empresa ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->depo_centro ?>
                        <input type="hidden" value="<?php echo $etiquetas->depo_centro ?>" class="depo_centro">
                    </td>
                    <td>
                        <?php echo $etiquetas->depo_cidade ?>
                    </td>
                    <td>
                        <?php echo $etiquetas->etiq_quantidade ?>
                        <input type="hidden" value="<?php echo $etiquetas->etiq_quantidade ?>" class="qtde_etiqueta">
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
            $("#gerar-qr").on("click", function() {
                var acao = "gerar_etiqueta";
                
                var CodigoMaterial = $("input:checked").parentsUntil("tr").nextAll().find("input:hidden.mate_codigo").val();
                var NomeMaterial   = $("input:checked").parentsUntil("tr").nextAll().find("input:hidden.mate_nome").val();
                var UnidadeMedida  = $("input:checked").parentsUntil("tr").nextAll().find("input:hidden.unidade_medida").val();
                var Centro         = $("input:checked").parentsUntil("tr").nextAll().find("input:hidden.depo_centro").val();
                var QtdEtiquetas   = $("input:checked").parentsUntil("tr").nextAll().find("input:hidden.qtde_etiqueta").val();
                var Id             = $("input:checked").val();
                
                $.ajax({
                    type: 'POST',
                    url: 'acoes.php',
                    data: {
                        acao            : acao,
                        id              : Id,
                        cod_mate        : CodigoMaterial,
                        nome_mate       : NomeMaterial,
                        unidade_medida  : UnidadeMedida,
                        centro          : Centro,
                        qtde_etq        : QtdEtiquetas
                    },
                    success: function(data) {
//                        alert(data);
                        window.location.href = 'Temp/' + CodigoMaterial + '.pdf';
                    }
                })
            })
    })
</script>

<?php
get_foot();
