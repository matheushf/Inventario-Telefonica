<?php

DeletarArquivos($_SERVER['DOCUMENT_ROOT'] . '/modulos/etiquetas/Temp/*');
DeletarArquivos($_SERVER['DOCUMENT_ROOT'] . '/Temp/*');

function DeletarArquivos($diretorio) {
    $tempo = 3600; // 1 hora
    $current_time = time();

    foreach (glob($diretorio) as $arquivo) {
        $tempo_arquivo = filemtime($arquivo);
        $diferenca = $current_time - $tempo_arquivo;

        if ($diferenca >= $tempo) {
            if (is_dir($arquivo))
                rrmdir($arquivo);
            else
                unlink($arquivo);
        }
    }
}