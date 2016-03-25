<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

get_head('Importar');

mensagem();
?>

<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Importar  </legend>

        <label for="modulo"><h3>Escolha um módulo: </h3></label>
        <select class="form-control" name="modulo" id="modulo">
            <option value="materiais">Materiais</option>
            <option value="deposito">Deposito</option>
            <option value="etiquetas">Etiquetas</option>
        </select>
        <small>Módulo para o qual você irá importar o arquivo.</small>

        <legend style="margin-top: 50px">Informações para importar </legend>
        <br>

        <h3>Passo 1: </h3>
        <p>Baixe o modelo para importação do módulo: </p>
        <p id=""><a id="modelo_csv" href="#">Link</a></p>

        <br>
        <p><b>Importante:</b></p>
        <ul>
            <li>Todas as colunas presentes no modelo são obrigatórias. </li>
            <li>A quantidade de colunas deve ser exata ao modelo.</li>
            <li>Os dados devem estar exatamente iguais aos dados do modelo. </li>
        </ul>

        <br> <br>
        <h3>Passo 2: </h3>

        <input type="file" name="arquivo_csv" id="arquivo_csv">

        <input type="submit" class="btn btn-primary" value="Importar" style="margin-top: 50px">
        
    </fieldset>
</body>

<script>
$(document).ready(function () {
    $("select").change(function() {
        var modulo = $("#modulo").val();
        var link = "/vivo-inventario/csv/modelo_" + modulo + ".csv";
        var valor = "modelo_" + modulo + ".csv";
        
        $("#modelo_csv").attr("href", link);
        $("#modelo_csv").html(valor);
    })
    
    // Inicio do Upload
    
    // Setar Variaveis
    var arquivos;
    
    $("#arquivo_csv").on("change", prepararUpload);
    
    function prepararUpload(event) {
        arquivos = event.target.files;
    }
    
    // Tratar do formulário
    $("form").on("submit", uploadArquivo);
    
    function uploadArquivo(event) {
        event.stopPropagation();
        event.preventDefault();
        
        // Criar um formulário de data e adicionar os valores
        var data = new FormData();
        
        $.each(arquivos, function(key, value) {
            data.append(key, value);
        })
        
        $.ajax({
            url: '/vivo-inventario/lib/action.php'
        })
    }
    
})
</script>