<?php

class FuncoesPadroes extends Geleia {

    public function Save($modulo) {
        $_POST[senha] = sha1(trim($_POST[senha]));

        return parent::Save($modulo);
    }

    public function Update($modulo) {
        return parent::Update($modulo);
    }

}
