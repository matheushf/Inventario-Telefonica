<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Etiquetas', 'grid');

echo mensagem();

//$_SESSION['imagens'] = null;

$EtiquetasLista = $Etiquetas->ListarEtiquetas($OrderBy, $Search, $Paginacao);
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
                    <form class="form-group">
                        <input type="text" size="20" class="form-control" id="busca" name="busca" value="<?= $_GET['busca'] ?>">
                        <button class="btn btn-primary" id="procurar" type="submit">Procurar</button>
                    </form>
                    <a class="btn btn-primary" href="importar.php">Importar Lista</a>
                </div>
            </div>
        </div>

        <br><br>

        <div class="alert alert-info text-center"> Use os Filtros: EPS - Material - Centro</div>

        <br><br>
        <div  class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr style="white-space: nowrap">
                        <th style="width: 50px"></th>
                        <th>Cód Final Inventário</th>
                        <th>Cód Leitura 1       </th>
                        <th>Cód Leitura 2       </th>
                        <th>Cód Leitura 3       </th>
                        <th><a href="?ordem=<?= $ordem ?>&by=mate_codigo">Material </a></th>
                        <th >Texto Breve Material</th>
                        <th>Unidade de Medida   </th>
                        <th><a href="?ordem=<?= $ordem ?>&by=depo_empresa">EPS</a></th>
                        <th><a href="?ordem=<?= $ordem ?>&by=depo_centro">Centro  </a></th>
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
        </div>
        <?php
        var_dump($_SESSION['imagens']);
        ?>
        <script>
            $(document).ready(function () {
                $("#gerar-qr").on("click", function () {

                    $.ajax({
                        type: 'POST',
                        url: 'acoes.php',
                        async: false,
                        data: {
                            acao: 'diretorio_image'
                        },
                        success: function (data) {
                            if (data == 'erro') {
                                alert("Ocorreu um erro, tente novamente.");
                            } else {
                                nome_pasta = data;
                            }
                        }
                    })

                    $("input:checked").each(function () {

                        var CodigoMaterial = $(this).parentsUntil("tr").nextAll().find("input:hidden.mate_codigo").val();
                        var NomeMaterial = $(this).parentsUntil("tr").nextAll().find("input:hidden.mate_nome").val();
                        var UnidadeMedida = $(this).parentsUntil("tr").nextAll().find("input:hidden.unidade_medida").val();
                        var Centro = $(this).parentsUntil("tr").nextAll().find("input:hidden.depo_centro").val();
                        var QtdEtiquetas = $(this).parentsUntil("tr").nextAll().find("input:hidden.qtde_etiqueta").val();
                        var Id = $(this).val();

                        $.ajax({
                            type: 'POST',
                            url: 'acoes.php',
                            data: {
                                acao: 'gerar_imagem_etiqueta',
                                id: Id,
                                cod_mate: CodigoMaterial,
                                nome_mate: NomeMaterial,
                                unidade_medida: UnidadeMedida,
                                centro: Centro,
                                qtde_etq: QtdEtiquetas,
                                folder: nome_pasta
                            },
                            success: function (data) {
//                                alert(data);
//                                window.location.href = 'Temp/' + CodigoMaterial + '.pdf';
                            }
                        })
                    })

                    // Gerar PDF
                    $.ajax({
                        type: 'POST',
                        url: 'acoes.php',
                        async: false,
                        data: {
                            acao: 'gerar_pdf_etiqueta',
                            folder: nome_pasta
                        },
                        success: function (data) {
                            
                        }
                    })
                })
            })
        </script>

        <?php
        get_foot('grid');
        