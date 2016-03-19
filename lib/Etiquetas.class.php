<?php

/**
 * Description of Etiquetas
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
//include "external/phpqrcode/qrlib.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';
//
//define('FPDF_FONTPATH', DOCUMENT_ROOT . "/lib/external/fpdf/font/");
require_once DOCUMENT_ROOT . "/lib/external/fpdf/fpdf.php";
require_once DOCUMENT_ROOT . "/lib/external/fpdi/fpdi.php";

//require_once 'external/fpdi/fpdi.php';
//require_once 'external/fpdi/fpdf.php';



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

    function ListarEtiquetas() {
        global $db;

        $sql = 'SELECT * FROM etiquetas
                INNER JOIN materiais ON mate_id = etiq_mate_material AND mate_excluido = 0
                INNER JOIN deposito ON depo_id = etiq_depo_centro AND depo_excluido = 0
                WHERE etiq_excluido = 0
                ORDER BY etiq_id ASC';

        $etiq = $db->GetObjectList($sql);

        return $etiq;
    }

    function GetById($Id, $IsArray = false) {
        global $db;

        $this->SQL_GetById = "SELECT * FROM etiquetas WHERE etiq_id=" . (int) $Id . " AND etiq_excluido=0";
        return parent::GetById($IsArray);
    }

}

class Etiquetas extends PEtiquetas {

    function GerarQRCode() {
        $Nome = '';
        $Link = '';
    }

        function CriarImagemEtiqueta($MaterialCodigo, $MaterialNome, $DepositoCentro, $UnidadeMedida) {
//        header("Content-Type: image/png");

        $imagecontainer = imagecreatetruecolor(600, 550);
        imagesavealpha($imagecontainer, true);
        $alphacolor = imagecolorallocatealpha($imagecontainer, 0, 0, 0, 127);
        imagefill($imagecontainer, 0, 0, $alphacolor);

        $background = imagecreatefrompng('TemplateEtiqueta.png');
        imagecopyresampled($imagecontainer, $background, 0, 0, 0, 0, 500, 555, 605, 550);

// Our QR-Code
// http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=olaaa

        $qrimage = imagecreatefrompng('qrcode.png');
        imagecopyresampled($imagecontainer, $qrimage, 20, 210, 0, 0, 140, 200, 180, 190);
        imagecopyresampled($imagecontainer, $qrimage, 185, 210, 0, 0, 140, 200, 180, 190);
        imagecopyresampled($imagecontainer, $qrimage, 345, 210, 0, 0, 140, 200, 180, 190);

        $textcolor = imagecolorallocate($imagecontainer, 0, 0, 0);
        $font = './VeraBd.ttf';

        imagettftext($imagecontainer, 25, 0, 85, 50, $textcolor, $font, 'CENTRO: ' . $DepositoCentro);
        imagettftext($imagecontainer, 25, 0, 25, 90, $textcolor, $font, 'MATERIAL: ' . $MaterialCodigo);
        imagettftext($imagecontainer, 10, 0, 100, 120, $textcolor, $font, $MaterialNome);
        imagettftext($imagecontainer, 10, 0, 80, 140, $textcolor, $font, 'UNIDADE DE MEDIDA: ' . $UnidadeMedida);
        imagettftext($imagecontainer, 10, 0, 410, 535, $textcolor, $font, $MaterialCodigo);

//        $nome = $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/modulos/etiquetas/Temp/';
        $nome = 'Temp/' . $MaterialCodigo . '.png';
        
        return imagepng($imagecontainer, $nome);
            
    }

    function GerarPDFEtiquetas($Quantidade, $MaterialCodigo) {
        $MLeft = 10.1;
        $MTop = 15.2;

        $CellWidth = 63.5;
        $CellHeight = 46.6;

        $EspacoMeio = 2.6;
        $EspacoBaixo = 4;

        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->SetMargins($MLeft, $MTop);
        $pdf->AddPage();

        $nome = 'Temp/' . $MaterialCodigo . '.png';
        
        $Topo = $MTop;
        for ($i = 0; $i <= $Quantidade; $i++) {
            $pdf->Image($nome, $MLeft, $Topo, $CellWidth, $CellHeight);
            $pdf->Image($nome, $MLeft + $CellWidth, $Topo, $CellWidth, $CellHeight);
            $pdf->Image($nome, ($CellWidth * 2) + $MLeft, $Topo, $CellWidth, $CellHeight);

            $Topo = ($CellHeight + $Topo) + $EspacoBaixo;
        }
        
        $nome = 'Temp/' . $MaterialCodigo . '.pdf';

        $pdf->Output('F', $nome);
    }

}
