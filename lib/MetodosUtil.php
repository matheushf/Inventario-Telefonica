<?php

/**
 * $CamposTabela = ['EPS', 'Centro', 'Cidade', 'Status', 'Livre 1', 'Livre 2', 'Livre 3'];
 * $DepositosCampos = ['depo_empresa', 'depo_centro', 'depo_cidade', 'depo_status', 'depo_livre1', 'depo_livre2', 'depo_livre3', ];
 * echo MontarTabela($CamposTabela, $Depositos, $DepositosCampos);
 * 
 * @param type $CamposTabela
 * @param type $Objeto
 * @param type $ObjetoCampos
 * @return string
 */
function MontarTabela($CamposTabela, $Objeto, $ObjetoCampos) {

    $html = " 
        <table class='table table-striped table-hover table-bordered'>
            <thead>
                <tr>
            ";

    foreach ($CamposTabela as $thNome) {
        $html .= "
                    <th> $thNome </th>
                ";
    }

    $html .= "
        </tr>
            </thead>
            
            <tbody>
            ";


    foreach ($Objeto as $Obj) {

        $html .= "
                <tr>
                ";
        foreach ($ObjetoCampos as $campos) {

            $valor = (string) $Obj->{$campos};

            $html .= "
                
                    <td> $valor </td>
                
                ";
        }
        $html .= "
                </tr>
                ";
    }

    $html .= "
            </tbody>
        </table>
        ";

    return $html;
}

function ImportarCSV($Posicoes, $ArquivoNome) {

//    $file = fopen(DOCUMENT_ROOT . '/csv/etiquetas.csv', 'r');
//    $arquivo = fgetcsv($file, ',');
//    $arquivo = file_get_contents(DOCUMENT_ROOT . '/csv/etiquetas.csv');
//    $arquivo = explode(',,', $arquivo);
//    foreach ($arquivo as $arq) {
//        echo $arq . '<br>';
//        $arq = explode(',', $arq);
//        echo $arq[9] . '<br>';
//        _debug($arq);
//    }
//    _debug($arquivo);

    $row = 1;
    $handle = fopen(DOCUMENT_ROOT . '/csv/etiquetas.csv', "r");
    if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);

            $row++;
            for ($c = 0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
            }
        }
        fclose($handle);
    }
}
