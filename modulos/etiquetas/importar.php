<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

get_head('Importar');

mensagem();
?>

<body>
    <fieldset class="scheduler-border" style="margin-top: 20px">
        <legend class=""> Importar Etiquetas</legend>


        <h3>Informações para importar </h3>
        <br>

        <h3>Passo 1: </h3>
        <p>Baixe o modelo para importação do módulo: </p>
        <p ><a href="/templates/csv/modelo_etiquetas.csv">Modelo Etiquetas</a></p>

        <br>
        <p><b>Importante:</b></p>
        <ul>
            <li>Todas as colunas presentes no modelo são obrigatórias. </li>
            <li>A quantidade de colunas deve ser exata ao modelo.</li>
            <li>Os dados devem estar exatamente iguais aos dados do modelo. </li>
        </ul>

        <br> <br>
        <h3>Passo 2: </h3>

        <form action="acoes.php?acao=importar" method="POST" enctype="multipart/form-data">
            <input type="file" name="arquivo_csv" id="arquivo_csv">

            <input type="submit" class="btn btn-primary" value="Importar" style="margin-top: 50px">
        </form>

    </fieldset>
</body>

<?php

get_foot();