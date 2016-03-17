<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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