<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/Materiais.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/Deposito.class.php';

class FuncoesPadroes extends Geleia {

    public function Save($modulo) {

        switch ($modulo) {

            case 'usuario': {
                    $_POST['senha'] = sha1(trim($_POST['senha']));

                    break;
                }

            case 'etiquetas': {
                    $Materiais = new Materiais();
                    $Deposito = new Deposito();

                    $MaterialCodigo = $Materiais->GetById($_POST['mate_material']);
                    $MaterialCodigo = $MaterialCodigo->mate_codigo;

                    $DepositoCentro = $Deposito->GetById($_POST['depo_centro']);
                    $DepositoCentro = $DepositoCentro->depo_centro;

                    $_POST['cod_final'] = $DepositoCentro . '-' . $MaterialCodigo;
                    $_POST['leitura'] = 1;

                    break;
                }
                
            case 'deposito': {
                $_POST['leitura'] = 1;
            }
        }

        return parent::Save($modulo);
    }

    public function Update($modulo) {

        return parent::Update($modulo);
    }

    function Delete($Id, $Modulo) {
//        $this->SQL_Delete = "UPDATE " . $Modulo . " SET " . substr($Modulo, 0, 4) . "_excluido = 1 WHERE " . substr($Modulo, 0, 4) . "_id = " . (int) $Id;
        
        $this->SQL_Delete = "DELETE FROM " . $Modulo . " WHERE " . substr($Modulo, 0, 4) . "_id = " . (int) $Id;

        return parent::Delete();
    }

}
