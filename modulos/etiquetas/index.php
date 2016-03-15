<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Etiquetas', 'grid');
?>

<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Etiquetas  </legend>

        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-primary">Novo</button>
                <button class="btn btn-primary">Editar</button>
                <button class="btn btn-primary">Excluir</button>
                <button class="btn btn-primary">Gerar Check-in 2D</button>
            </div>
            <div class="col-sm-6 ">
                <div class="form-inline pull-right">
                    <input type="text" size="20" class="form-control" id="busca" name="busca">
                    <button class="btn btn-primary">Procurar</button>
                    <button class="btn btn-primary">Importar Lista</button>
                </div>
            </div>
        </div>

        <br><br>
        
        <div class="alert alert-info text-center"> Use os Filtros: EPS - Material - Centro</div>

        <br><br>
        
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- Linhas tabela -->
                </tr>
            </tbody>
        </table>





    </fieldset>


    <?php
    // put your code here
    ?>
</body>

<?php
get_foot();
