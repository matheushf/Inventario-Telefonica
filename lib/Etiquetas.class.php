<?php

/**
 * Description of Etiquetas
 *
 * @author Matheus Victor <hffmatheus@gmail.com>
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/external/fpdf/fpdf.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/external/fpdi/fpdi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/DB.class.php";

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

        $this->SQList['select.centro']['sql'] = "SELECT * FROM deposito ORDER BY depo_centro ASC";
        $this->SQList['select.centro']['value'] = "depo_centro";
        $this->SQList['select.centro']['key'] = "depo_id";

        $this->SQList['select.material']['sql'] = "SELECT * FROM materiais ORDER BY mate_nome ASC";
        $this->SQList['select.material']['value'] = "mate_nome";
        $this->SQList['select.material']['key'] = "mate_id";
    }

    function ListarEtiquetas($OrderBy = null, $Search = null, $Paginacao = null) {
        global $db;

        if ($OrderBy == null) {
            $OrderBy = ' ORDER BY etiq_id ASC ';
        }
        
        if ($Paginacao == null) {
            $Paginacao = ' LIMIT 50 ';
        }        

        if ($Search != null) {
            $Search = " WHERE ("
                    . "depo_empresa LIKE '%" . $Search . "%'"
                    . "OR mate_codigo LIKE '%" . $Search . "%'"
                    . "OR mate_nome LIKE '%" . $Search . "%'"
                    . "OR depo_centro LIKE '%" . $Search . "%'"
                    . ") ";
        }

        $sql = 'SELECT * FROM etiquetas
                INNER JOIN materiais ON mate_id = etiq_mate_material
                INNER JOIN deposito ON depo_id = etiq_depo_centro
               ' . $Search . $OrderBy . $Paginacao;

        $etiq = $db->GetObjectList($sql);

        return $etiq;
    }

    function GetById($Id, $IsArray = false) {
        global $db;

        $this->SQL_GetById = "SELECT * FROM etiquetas 
                INNER JOIN materiais ON mate_id = etiq_mate_material
                INNER JOIN deposito ON depo_id = etiq_depo_centro
                WHERE etiq_id=" . (int) $Id;

        return parent::GetById($IsArray);
    }

    function VerificarLeituraAberta($etiq_id) {
        global $db;

        $sql = 'SELECT etiq_leitura FROM etiquetas WHERE etiq_id = ' . $etiq_id;

        $leitura = $db->GetObject($sql);

        if ($leitura) {
            return $leitura->etiq_leitura;
        } else {
            return 1;
        }
    }

    function SalvarLeitura($QuantidadeAferida, $IdMaterial, $LocMaterial, $Livre1, $Livre2, $EtiquetaId, $MateId, $Cod_leitura) {
        global $db;

        $leitura = $this->VerificarLeituraAberta($EtiquetaId);
        $Cod_leitura = $leitura . '-' . $Cod_leitura;

        $sql = "INSERT INTO leitura (leit_quantidade_aferida, leit_id_material, leit_loc_material, leit_etiq_id, leit_mate_id, leit_livre1, leit_livre2, leit_cod_leitura, leit_nu_leitura) VALUES ('$QuantidadeAferida', '$IdMaterial', '$LocMaterial', '$EtiquetaId', '$MateId', '$Livre1', '$Livre2', '$Cod_leitura', '$leitura')";
        
//        echo $sql;
//        die();

        if ($db->ExecSQL($sql)) {
            $sql = "UPDATE etiquetas SET etiq_cod_leitura" . $leitura . " = '" . $Cod_leitura . "' , etiq_leitura = " . ($leitura + 1) . " WHERE etiq_id = " . $EtiquetaId;

            $db->ExecSQL($sql);

            return true;
        } else {
            return false;
        }
    }

    function ObterLeitura($EtiqId, $MateId, $Leitura) {
        global $db;

        $sql = "SELECT leit_quantidade_aferida FROM leitura WHERE leit_etiq_id = " . $EtiqId . " AND leit_mate_id = " . $MateId . " AND leit_nu_leitura = " . $Leitura;

        if($leit = $db->GetObject($sql)) {
            return $leit->leit_quantidade_aferida;
        } else {
            return null;
        }
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

    function CriarImagemEtiqueta($IdEtiqueta, $QtdEtiquetas, $MaterialCodigo, $MaterialNome, $DepositoCentro, $UnidadeMedida, $Folder, $Diretorio) {

        // Salvar na sessão
        $_SESSION['imagens'][$IdEtiqueta] = $QtdEtiquetas;

        // Criando o container da imagem
        $imagecontainer = imagecreatetruecolor(620, 550);
        imagesavealpha($imagecontainer, true);
        $alphacolor = imagecolorallocatealpha($imagecontainer, 0, 0, 0, 127);
        imagefill($imagecontainer, 0, 0, $alphacolor);

        $background = imagecreatefrompng('TemplateEtiqueta.png');
        imagecopyresampled($imagecontainer, $background, 0, 0, 0, 0, 600, 550, 608, 542);
//        imagecopyresampled($dst_image, $src_image, $dst_x = 0, $dst_y = 0, $src_x = 0, $src_y = 0, $dst_w, $dst_h, $src_w, $src_h);
//        http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=olaaa
//        $qrimage = imagecreatefrompng('http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=');

        $Link = "http://vivoinventario.asix6.com/modulos/etiquetas/mleitura.php?id=" . $IdEtiqueta;
        $qrimage = imagecreatefrompng('http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=' . $Link);
//        $qrimage = imagecreatefrompng('qrcode.png');

        $src_wid = 165;
        $src_hei = 165;
        $dst_wid = 155;
        $dst_hei = 155;
        $y = 225;
        // Adicionando as leituras QR-Code na imagem por coordenadas
        imagecopyresampled($imagecontainer, $qrimage, 30, $y, 0, 0, $dst_wid, $dst_hei, $src_wid, $src_hei);
        imagecopyresampled($imagecontainer, $qrimage, 220, $y, 0, 0, $dst_wid, $dst_hei, $src_wid, $src_hei);
        imagecopyresampled($imagecontainer, $qrimage, 415, $y, 0, 0, $dst_wid, $dst_hei, $src_wid, $src_hei);

        $textcolor = imagecolorallocate($imagecontainer, 0, 0, 0);
        $font = $_SERVER['DOCUMENT_ROOT'] . '/assets/fonts/OpenSans-Bold.ttf';


        // Escrevendo as informaçẽs em texto na imagem
        imagettftext($imagecontainer, 27, 0, 25, 50, $textcolor, $font, 'CENTRO: ' . strtoupper($DepositoCentro));
        if (strlen($MaterialCodigo) > 12) {
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

        $nome = 'Temp/' . $Folder . '/' . $IdEtiqueta . '.png';
//        $nome = 'Temp/imagem.png';

        return imagepng($imagecontainer, $nome);
    }

    function GerarPDFEtiquetas($Folder, $Diretorio) {
        $MLeft = 0.73;
        $MTop = 0.93;

        $CellWidth = 6.61;
        $CellHeight = 4.65;

        $EspacoMeio = 2.6;
        $EspacoBaixo = 0.001;

        $pdf = new FPDF('P', 'cm', 'A4');

        $pdf->SetMargins($MLeft, $MTop);
        $pdf->AddPage('P', 'A4');

        // Loop entre array de imagens criadas, salvas na sessão
        $_SESSION['imagens'] = array_filter($_SESSION['imagens']);
        $Caminho = $Diretorio . 'Temp/' . $Folder . '/';

        $Topo = $MTop;
        $Esquerdo = $MLeft;
        $j = 1;
        $k = 1;
        foreach ($_SESSION['imagens'] as $IdEtiqueta => $Quantidade) {
            $Imagem = $Caminho . $IdEtiqueta . '.png';

            for ($i = 1; $i <= $Quantidade; $i++) {
                $pdf->Image($Imagem, $Esquerdo, $Topo, $CellWidth, $CellHeight);

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
        }

        $Diretorio = $_SERVER['DOCUMENT_ROOT'] . '/modulos/etiquetas/';
        $nome = 'Temp/' . time() . '.pdf';

        $pdf->Output('F', $nome);

        echo $nome;
        
        return $nome;
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

    function CriarDiretorio($Diretorio) {
        $_SESSION['imagens'] = NULL;
        unset($_SESSION['imagens']);

        $folder = md5(time());
        mkdir($Diretorio . 'Temp/' . $folder);
        
        return $folder;
    }

    function GerarQrCode($IdEtiqueta, $QtdEtiquetas, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida) {

        $Diretorio = $_SERVER['DOCUMENT_ROOT'] . '/modulos/etiquetas/';

        $Folder = $this->CriarDiretorio($Diretorio);

        foreach ($IdEtiqueta as $key => $etiquetas) {

            $this->GerarImagemEtiqueta($IdEtiqueta[$key], $QtdEtiquetas[$key], $CodigoMaterial[$key], $NomeMaterial[$key], $Centro[$key], $UnidadeMedida[$key], $Folder);
        }

        if ($Arquivo = $this->GerarPdfEtiqueta($Folder, $Diretorio)) {
//            echo $Arquivo;
//            $this->DeletarPdf($Arquivo);
        } else {
            return false;
        }
    }

    function GerarImagemEtiqueta($IdEtiqueta, $QtdEtiquetas, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida, $Folder) {

        $res = $this->CriarImagemEtiqueta($IdEtiqueta, $QtdEtiquetas, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida, $Folder);

        if ($res) {
            return $IdEtiqueta;
        } else {
            return false;
        }
    }

    function GerarPdfEtiqueta($Folder, $Diretorio) {
        $nome = $this->GerarPDFEtiquetas($Folder, $Diretorio);

        $_SESSION['imagens'] = NULL;
        unset($_SESSION['imagens']);


        rrmdir($Diretorio . 'Temp/' . $Folder);

        return $nome;
    }

    function DeletarPdf($Arquivo) {
        unlink($Arquivo);
    }

}
