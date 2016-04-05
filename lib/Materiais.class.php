<?php

/**
 * Description of Materiais
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
class PMateriais extends Geleia {

    function ListarMateriais($OrderBy = null, $Search = null, $Paginacao = null) {
        global $db;

        if ($Paginacao == null) {
            $Paginacao = ' LIMIT 50';
        }

        if ($OrderBy == null) {
            $OrderBy = 'ORDER BY mate_nome ASC ';
        }

        if ($Search != null) {
            $Search = " WHERE ("
                    . "mate_codigo LIKE '%" . $Search . "%'"
                    . "OR mate_nome LIKE '%" . $Search . "%'"
                    . ") ";
        }

        $sql = 'SELECT * FROM materiais ' . $Search . $OrderBy . $Paginacao;

//        echo $sql;

        $mate = $db->GetObjectList($sql);

        return $mate;
    }

    function GetById($Id, $IsArray = false) {
        global $db;

        $this->SQL_GetById = "SELECT * FROM materiais WHERE mate_id=" . (int) $Id;
        return parent::GetById($IsArray);
    }

    function DeletarPorId($Id) {
        global $db;
        
        $EtiquetaId = $db->GetObject('SELECT etiq_id FROM etiquetas WHERE etiq_mate_material = ' . $Id);
        $EtiquetaId = $EtiquetaId->etiq_id;
        $db->ExecSQL('DELETE FROM leitura WHERE leit_etiq_id = ' . $EtiquetaId);
        $db->ExecSQL('DELETE FROM etiquetas WHERE etiq_id = ' . $EtiquetaId);
        
        if ($db->ExecSQL('DELETE FROM materiais WHERE mate_id = ' . $Id)) {
            return true;
        } else {
            return false;
        }
    }

    function ObterIdPorCodigo($Codigo) {
        global $db;

        $sql = "SELECT * FROM materiais WHERE mate_codigo = '" . $Codigo . "'";

        $Id = $db->GetObject($sql);
        $Id = $Id->mate_id;

        return $Id;
    }

}

class Materiais extends PMateriais {

    function ImportarMateriais($ArquivoNome) {
        $Campos = ['mate_id', 'mate_codigo', 'mate_nome', 'mate_unidade_medida', 'mate_valor_unitario', 'mate_livre1', 'mate_livre2', 'mate_livre3'];
        $Tabela = "materiais";
//        $ArquivoNome = "material.csv";
        if (ImportarCSV($Campos, $Tabela, $ArquivoNome)) {
            return true;
        } else {
            return false;
        }
    }

}
