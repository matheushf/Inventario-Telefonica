<?php

/**
 * Description of Etiquetas
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
require_once DOCUMENT_ROOT . "/lib/external/fpdf/fpdf.php";
require_once DOCUMENT_ROOT . "/lib/external/fpdi/fpdi.php";




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
                    . "depo_empresa LIKE '%"    . $Search . "%'"
                    . "OR mate_codigo LIKE '%"  . $Search . "%'"
                    . "OR mate_nome LIKE '%"    . $Search . "%'"
                    . "OR depo_centro LIKE '%"  . $Search . "%'"
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
        $qrimage = imagecreatefrompng('http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=' . $Link);
        
        imagecopyresampled($imagecontainer, $qrimage, 20, 210, 0, 0, 140, 200, 180, 190);
        imagecopyresampled($imagecontainer, $qrimage, 185, 210, 0, 0, 140, 200, 180, 190);
        imagecopyresampled($imagecontainer, $qrimage, 345, 210, 0, 0, 140, 200, 180, 190);

        $textcolor = imagecolorallocate($imagecontainer, 0, 0, 0);
        $font = DOCUMENT_ROOT . '/assets/fonts/OpenSans-Bold.ttf';

        imagettftext($imagecontainer, 27, 0, 85, 50, $textcolor, $font, 'CENTRO: ' . strtoupper($DepositoCentro));
        imagettftext($imagecontainer, 27, 0, 25, 90, $textcolor, $font, 'MATERIAL: ' . strtoupper($MaterialCodigo));
        imagettftext($imagecontainer, 15, 0, 45, 125, $textcolor, $font, strtoupper($MaterialNome));
        imagettftext($imagecontainer, 15, 0, 45, 150, $textcolor, $font, 'UNIDADE DE MEDIDA: ' . strtoupper($UnidadeMedida));
        imagettftext($imagecontainer, 10, 0, 405, 535, $textcolor, $font, strtoupper($MaterialCodigo));

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
        $Esquerdo = $MLeft;
        $j = 1;
        for ($i = 1; $i <= $Quantidade; $i++) {
            
            $pdf->Image($nome, $Esquerdo, $Topo, $CellWidth, $CellHeight);
//            $pdf->Image($nome, $Esquerdo, $Topo, $CellWidth, $CellHeight);
//            $pdf->Image($nome, ($CellWidth * 2) + $MLeft, $Topo, $CellWidth, $CellHeight);

            $Esquerdo = $MLeft + $CellWidth;
            if ($j == 2) {
                $Esquerdo = ($CellWidth * 2) + $MLeft;
            }
            if ($j == 3) {
                $Topo = ($CellHeight + $Topo) + $EspacoBaixo;
                $Esquerdo = $MLeft;
                $j = 0;
            }
            $j++;
            
        }
        
        $nome = 'Temp/' . $MaterialCodigo . '.pdf';

        $pdf->Output('F', $nome);
    }

}
