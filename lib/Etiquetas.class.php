<?php

/**
 * Description of Etiquetas
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
require_once DOCUMENT_ROOT . "/lib/external/fpdf/fpdf.php";
require_once DOCUMENT_ROOT . "/lib/external/fpdi/fpdi.php";
require_once DOCUMENT_ROOT . "/lib/DB.class.php";

//include DOCUMENT_ROOT . "/Config.php";
$db = new DB();

class PEtiquetas extends Geleia {

    function PEtiquetas($Table = "") {

        parent::Geleia($Table);
        $this->LoadSQL4Datasource();
//        $this->LoadLiteralDatasource();
//        $this->DynamicVars['$1'] = $this->GetUserIdLogged();
//        $this->DynamicVars['$2'] = "'" . date('Y-m-d H:i:s') . "'";
    }

    function LoadSQL4Datasource() {

        $this->SQList['select.centro']['sql'] = "SELECT * FROM deposito WHERE depo_excluido = 0";
        $this->SQList['select.centro']['value'] = "depo_centro";
        $this->SQList['select.centro']['key'] = "depo_id";

        $this->SQList['select.material']['sql'] = "SELECT * FROM materiais WHERE mate_excluido = 0";
        $this->SQList['select.material']['value'] = "mate_nome";
        $this->SQList['select.material']['key'] = "mate_id";
    }

    function ListarEtiquetas($OrderBy = 'ORDER BY etiq_id ASC', $Search = null, $Paginacao = 'LIMIT 50') {
        global $db;

        if ($Search != null) {
            $Search = "AND ("
                    . "depo_empresa LIKE '%" . $Search . "%'"
                    . "OR mate_codigo LIKE '%" . $Search . "%'"
                    . "OR mate_nome LIKE '%" . $Search . "%'"
                    . "OR depo_centro LIKE '%" . $Search . "%'"
                    . ") ";
        }

        $sql = 'SELECT * FROM etiquetas
                INNER JOIN materiais ON mate_id = etiq_mate_material AND mate_excluido = 0
                INNER JOIN deposito ON depo_id = etiq_depo_centro AND depo_excluido = 0
                WHERE etiq_excluido = 0 ' . $Search . $OrderBy . $Paginacao;

        $etiq = $db->GetObjectList($sql);

        return $etiq;
    }

    function GetById($Id, $IsArray = false) {
        global $db;

        $this->SQL_GetById = "SELECT * FROM etiquetas 
                INNER JOIN materiais ON mate_id = etiq_mate_material AND mate_excluido = 0
                INNER JOIN deposito ON depo_id = etiq_depo_centro AND depo_excluido = 0
                WHERE etiq_id=" . (int) $Id . "
                AND etiq_excluido=0";
        return parent::GetById($IsArray);
    }

    function VerificarLeituraAberta($etiq_id) {
        global $db;

        for ($i = 1; $i <= 3; $i++) {
            $sql = 'SELECT etiq_cod_leitura' . $i . ' FROM etiquetas WHERE etiq_cod_leitura' . $i . ' IS NULL AND etiq_id = ' . $etiq_id;
            if ($db->GetObject($sql)) {
                return $i;
            }
        }
        return 1;
    }

    function SalvarLeitura($QuantidadeAferida, $IdMaterial, $LocMaterial, $Livre1, $Livre2, $EtiquetaId, $MateId, $Cod_leitura) {
        global $db;

        $leitura = $this->VerificarLeituraAberta($EtiquetaId);
        $Cod_leitura = $leitura . '-' . $Cod_leitura;

        $sql = "INSERT INTO leitura (leit_quantidade_aferida, leit_id_material, leit_loc_material, leit_etiq_id, leit_mate_id, leit_livre1, leit_livre2, leit_cod_leitura, leit_nu_leitura) VALUES ('$QuantidadeAferida', '$IdMaterial', '$LocMaterial', '$EtiquetaId', '$MateId', '$Livre1', '$Livre2', '$Cod_leitura', '$leitura')";

        if ($db->ExecSQL($sql)) {
            $sql = "UPDATE etiquetas SET etiq_cod_leitura" . $leitura . " = '" . $Cod_leitura . "' WHERE etiq_id = " . $EtiquetaId;

            $db->ExecSQL($sql);
        }
    }

    function ObterLeitura($EtiqId, $MateId, $Leitura) {
        global $db;

        $sql = "SELECT * FROM leitura WHERE leit_etiq_id = " . $EtiqId . " AND leit_mate_id = " . $MateId . " AND leit_nu_leitura = " . $Leitura;
//        echo $sql;
        return $db->GetObject($sql);
    }

    function ObterLocalizacao($EtiqId, $MateId) {
        global $db;

        for ($i = 3; $i >= 1; $i--) {
            $sql = "SELECT leit_loc_material FROM leitura WHERE leit_etiq_id = " . $EtiqId . " AND leit_mate_id = " . $MateId . " AND leit_nu_leitura = " . $i;

            if (!$obj = $db->GetObject($sql)) {
                
            } else {
                return $obj->leit_loc_material;
            }
        }
    }

}

class Etiquetas extends PEtiquetas {

    function GerarQRCode() {
        $Nome = '';
        $Link = '';
    }

    function CriarImagemEtiqueta($IdEtiqueta, $MaterialCodigo, $MaterialNome, $DepositoCentro, $UnidadeMedida) {
//        header("Content-Type: image/png");

        $imagecontainer = imagecreatetruecolor(600, 550);
        imagesavealpha($imagecontainer, true);
        $alphacolor = imagecolorallocatealpha($imagecontainer, 0, 0, 0, 127);
        imagefill($imagecontainer, 0, 0, $alphacolor);

        $background = imagecreatefrompng('TemplateEtiqueta.png');
        imagecopyresampled($imagecontainer, $background, 0, 0, 0, 0, 500, 555, 605, 550);

// Our QR-Code
// http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=olaaa
//        $qrimage = imagecreatefrompng('qrcode.png');

        $Link = "http://192.168.100.5/vivo-inventario/modulos/etiquetas/mleitura.php?id=" . $IdEtiqueta;
//        $qrimage = imagecreatefrompng('http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=' . $Link);
        $qrimage = imagecreatefrompng('qrcode.png');

        imagecopyresampled($imagecontainer, $qrimage, 20, 210, 0, 0, 140, 200, 180, 190);
        imagecopyresampled($imagecontainer, $qrimage, 185, 210, 0, 0, 140, 200, 180, 190);
        imagecopyresampled($imagecontainer, $qrimage, 345, 210, 0, 0, 140, 200, 180, 190);

        $textcolor = imagecolorallocate($imagecontainer, 0, 0, 0);
        $font = DOCUMENT_ROOT . '/assets/fonts/OpenSans-Bold.ttf';



        imagettftext($imagecontainer, 27, 0, 25, 50, $textcolor, $font, 'CENTRO: ' . strtoupper($DepositoCentro));
        if (strlen($MaterialCodigo) > 12) {
//            $p1 = substr(strtoupper($MaterialCodigo), 0, 12);
//            $p2 = substr(strtoupper($MaterialCodigo), 12, strlen($MaterialCodigo));
            imagettftext($imagecontainer, 20, 0, 25, 90, $textcolor, $font, 'MATERIAL: ');
            imagettftext($imagecontainer, 15, 0, 170, 90, $textcolor, $font, $MaterialCodigo);
        } else {
            imagettftext($imagecontainer, 27, 0, 25, 90, $textcolor, $font, 'MATERIAL: ' . strtoupper($MaterialCodigo));
        }

        if (strlen($MaterialNome) > 40) {
            $MaterialNome = substr($MaterialNome, 0, 45);
            imagettftext($imagecontainer, 12, 0, 25, 125, $textcolor, $font, strtoupper($MaterialNome) . '..');
        } else {
            imagettftext($imagecontainer, 15, 0, 25, 125, $textcolor, $font, strtoupper($MaterialNome));
        }

        imagettftext($imagecontainer, 15, 0, 25, 150, $textcolor, $font, 'UNIDADE DE MEDIDA: ' . strtoupper($UnidadeMedida));

        if (strlen($MaterialCodigo) > 12) {
            imagettftext($imagecontainer, 10, 0, 340, 535, $textcolor, $font, strtoupper($MaterialCodigo));
        } else {
            imagettftext($imagecontainer, 10, 0, 380, 535, $textcolor, $font, strtoupper($MaterialCodigo));
        }

        $nome = 'Temp/' . $MaterialCodigo . '.png';

        return imagepng($imagecontainer, $nome);
    }

    function GerarPDFEtiquetas($Quantidade, $MaterialCodigo) {
        $MLeft = 10.1;
        $MTop = 12.2;

        $CellWidth = 63.5;
        $CellHeight = 45.6;

        $EspacoMeio = 2.6;
        $EspacoBaixo = 1.5;

        $pdf = new FPDF('P', 'cm', 'A4');

        $pdf->SetMargins($MLeft, $MTop);
        $pdf->AddPage('P', 'A4');

        $nome = 'Temp/' . $MaterialCodigo . '.png';

        $Topo = $MTop;
        $Esquerdo = $MLeft;
        $j = 1;
        $k = 1;
        for ($i = 1; $i <= $Quantidade; $i++) {

            $pdf->Image($nome, $Esquerdo, $Topo, $CellWidth, $CellHeight);

            $Esquerdo = $MLeft + $CellWidth;
            if ($j == 2) {
                $Esquerdo = ($CellWidth * 2) + $MLeft;
            }
            if ($j == 3) {
                $Topo = ($CellHeight + $Topo) + $EspacoBaixo;
                $Esquerdo = $MLeft;
                $j = 0;
            }
            if ($k >= 18) {
                $pdf->AddPage('P', 'A4');
                $Topo = $MTop;
                $Esquerdo = $MLeft;
                $k = 0;
            }
            $k++;
            $j++;
        }

        $nome = 'Temp/' . $MaterialCodigo . '.pdf';

        $pdf->Output('F', $nome);
    }

    function ImportarEtiquetas($ArquivoNome) {
        global $db, $Materiais, $Deposito;

//        $handle = fopen(DOCUMENT_ROOT . '/csv/' . $ArquivoNome, "r");
        $handle = fopen($ArquivoNome, "r");
        if ($handle !== FALSE) {
            $data = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);

                $Mate_id = $Materiais->ObterIdPorCodigo($data[0]);
                $Depo_id = $Deposito->ObterIdPorCentro($data[1]);

                $Cod_final = $data[1] . '-' . $data[0];

                $sql = "INSERT INTO etiquetas (etiq_depo_centro, etiq_mate_material, etiq_quantidade, etiq_cod_final) VALUES "
                        . "('" . $Depo_id . "', '" . $Mate_id . "', '" . $data[2] . "', '" . $Cod_final . "')";

                $db->ExecSQL($sql);
            }
            fclose($handle);

            unlink($ArquivoNome);

            return true;
        } else {
            return false;
        }
    }

}
