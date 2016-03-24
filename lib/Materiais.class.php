<?php

/**
 * Description of Materiais
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */

require_once DOCUMENT_ROOT . "/Global.php";

class PMateriais extends Geleia {

    function ListarMateriais($OrderBy = 'ORDER BY mate_id ASC', $Search = null, $Paginacao = 'LIMIT 50') {
        global $db;

        if ($Search != null) {
            $Search = " AND ("
                    . "mate_codigo LIKE '%" . $Search . "%'"
                    . "OR mate_nome LIKE '%" . $Search . "%'"
                    . ") ";
        }

        $sql = 'SELECT * FROM materiais WHERE mate_excluido = 0 ' . $Search . $OrderBy . $Paginacao;

        $mate = $db->GetObjectList($sql);

        return $mate;
    }

    function GetById($Id, $IsArray = false) {
        global $db;

        $this->SQL_GetById = "SELECT * FROM materiais WHERE mate_id=" . (int) $Id . " AND mate_excluido=0";
        return parent::GetById($IsArray);
    }
    
    function ObterIdPorCodigo($Codigo) {
        global $db;
        
        $sql = "SELECT * FROM materiais WHERE mate_codigo = " . $Codigo;
        
        $Id = $db->GetObject($sql);
        $Id = $Id->mate_id;
        
        return $Id;
    }

}

class Materiais extends PMateriais {

    function ImportarMateriais() {
        $Campos = ['mate_id', 'mate_codigo', 'mate_nome', 'mate_unidade_medida', 'mate_valor_unitario', 'mate_livre1', 'mate_livre2', 'mate_livre3'];
        $Tabela = "materiais";
        $ArquivoNome = "material.csv";
        ImportarCSV($Campos, $Tabela, $ArquivoNome);
    }

}
