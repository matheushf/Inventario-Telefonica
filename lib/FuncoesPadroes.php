<?php

class FuncoesPadroes extends Geleia {

    public function Save($modulo) {
        $_POST[senha] = sha1(trim($_POST[senha]));

        return parent::Save($modulo);
    }

    public function Update($modulo) {
        return parent::Update($modulo);
    }

    function Delete($Id, $Modulo) {
        $this->SQL_Delete = "UPDATE " . $Modulo . " SET " . substr($Modulo, 0, 4) . "_excluido = 1 WHERE " . substr($Modulo, 0, 4) . "_id = " . (int) $Id;

        return parent::Delete();
    }

}
