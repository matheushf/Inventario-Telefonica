<?php

/**
 * Description of Etiquetas
 *
 *
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/external/fpdf/fpdf.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/external/fpdi/fpdi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/DB.class.php";

$db = new DB();

class PEtiquetas extends Geleia
{

    function PEtiquetas($Table = "")
    {

        parent::Geleia($Table);
        $this->LoadSQL4Datasource();
//        $this->LoadLiteralDatasource();
//        $this->DynamicVars['$1'] = $this->GetUserIdLogged();
//        $this->DynamicVars['$2'] = "'" . date('Y-m-d H:i:s') . "'";
    }

    function LoadSQL4Datasource()
    {

        $this->SQList['select.centro']['sql'] = "SELECT * FROM deposito ORDER BY depo_centro ASC";
        $this->SQList['select.centro']['value'] = "depo_centro";
        $this->SQList['select.centro']['key'] = "depo_id";

        $this->SQList['select.material']['sql'] = "SELECT * FROM materiais ORDER BY mate_nome ASC";
        $this->SQList['select.material']['value'] = "mate_nome";
        $this->SQList['select.material']['key'] = "mate_id";
    }

    function ListarEtiquetas($OrderBy = null, $Search = null, $Paginacao = null)
    {
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

    function GetById($Id, $IsArray = false)
    {
        global $db;

        $this->SQL_GetById = "SELECT * FROM etiquetas 
                INNER JOIN materiais ON mate_id = etiq_mate_material
                INNER JOIN deposito ON depo_id = etiq_depo_centro
                WHERE etiq_id=" . (int)$Id;

        return parent::GetById($IsArray);
    }

    function DeletarPorId($Id)
    {
        global $db;

        $db->ExecSQL('DELETE FROM leitura WHERE leit_etiq_id = ' . $Id);

        if ($db->ExecSQL('DELETE FROM etiquetas WHERE etiq_id = ' . $Id)) {
            return true;
        } else {
            return false;
        }
    }

    function VerificarNumeroLeitura($centro)
    {
        global $db;

        $sql = "SELECT * FROM deposito WHERE depo_centro = '{$centro}' ORDER BY depo_id DESC LIMIT 1";

        if ($centroLeitura = $db->GetObject($sql)) {
            return $centroLeitura->depo_leitura;
        } else {
            return false;
        }
    }

    function VerificarNumeroEtiqueta($EtiquetaId)
    {
        global $db;

        $sql = "SELECT * FROM leitura WHERE leit_etiq_id = {$EtiquetaId} ORDER BY leit_num_etiq DESC LIMIT 1";
//        echo $sql; die();
        $NumEtiqueta = $db->GetObject($sql);

        if ($NumEtiqueta) {
            return $NumEtiqueta->leit_num_etiq;
        } else {
            return 1;
        }
    }

    function QuantidadeLeituraAtual($EtiquetaId, $Leitura)
    {
        global $db;

        $sql = "SELECT COUNT(*) as quantidade FROM leitura WHERE leit_etiq_id = {$EtiquetaId} AND leit_nu_leitura = {$Leitura}";
//        echo $sql; die();

        if ($Quantidade = $db->GetObject($sql)) {
            return $Quantidade->quantidade;
        } else {
            return false;
        }
    }

    function SalvarLeitura($QuantidadeAferida, $IdMaterial, $LocMaterial, $Livre1, $Livre2, $EtiquetaId, $MateId, $Cod_leitura, $Identificacao, $nome, $centro)
    {
        global $db;

        /*var_dump($Identificacao);
        die();*/

        // Localizar em qual número de etiqueta está a leitura e montar a identificação/material
        /*
        if ($Identificacao == null && !$Nova) {
            $NumEtiqueta = $this->VerificarNumeroEtiqueta($EtiquetaId);
        } else if ($Nova) {
            $NumEtiqueta = $this->VerificarNumeroEtiqueta($EtiquetaId);
            $NumEtiqueta++;
        } else {
            $NumEtiqueta = $this->ConsultarPorIdentificacao($Identificacao);
            $NumEtiqueta = $NumEtiqueta->leit_num_etiq;
        }
        */

        $NumEtiqueta = self::VerificarNumeroEtiqueta($EtiquetaId);
        $leitura = $this->VerificarNumeroLeitura($centro);

        $Leitura_ident_mate = $Cod_leitura . '/' . $NumEtiqueta;

        if ($leitura > 3) {
            return 'A leitura atingiu seu limite.';
        }

        $Cod_leitura = $leitura . '-' . $Cod_leitura;

        // Inserir Leitura
        $sql = "INSERT INTO leitura "
            . "(leit_quantidade_aferida, leit_identificacao_material, leit_num_etiq, leit_id_material, leit_loc_material, leit_etiq_id, leit_mate_id, leit_livre1, leit_livre2, leit_cod_leitura, leit_nu_leitura, leit_usua_nome, leit_centro) "
            . "VALUES "
            . "('$QuantidadeAferida', '$Leitura_ident_mate', '$NumEtiqueta', '$IdMaterial', '$LocMaterial', '$EtiquetaId', '$MateId', '$Livre1', '$Livre2', '$Cod_leitura', '$leitura', '$nome', '$centro')";


        if ($db->ExecSQL($sql)) {
            $sql = "UPDATE leitura SET leit_nu_leit_grupo = " . $leitura . " WHERE leit_identificacao_material = '" . $Leitura_ident_mate . "'";
            $db->ExecSQL($sql);

            return true;
        } else {
            return false;
        }
    }

    function QuantidadeLeitura($EtiquetaId)
    {
        global $db;

        $sql = "SELECT * FROM leitura WHERE leit_etiq_id = " . $EtiquetaId;
        $QuantidadeLeitura = $db->GetObjectList($sql);

        return count($QuantidadeLeitura);
    }

    function ConsultarPorLocalizacao($Localizacao, $EtiquetaId)
    {
        global $db;

        $sql = "SELECT * FROM leitura WHERE leit_loc_material = '" . $Localizacao . "' AND leit_etiq_id = " . $EtiquetaId;

        $Resultado = $db->GetObject($sql);

        return $Resultado;
    }

    function ConsultarPorIdentificacao($Identificacao)
    {
        global $db;

        $sql = "SELECT * FROM leitura WHERE leit_identificacao_material = '" . $Identificacao . "'";
        $Resultado = $db->GetObject($sql);

        return $Resultado;
    }

    function ListarLocalizacao($EtiquetaId)
    {
        global $db;

        $sql = "SELECT * FROM (SELECT * FROM leitura WHERE leit_etiq_id = " . $EtiquetaId . " AND leit_nu_leit_grupo != 3 ORDER BY leit_nu_leitura DESC) AS tmp_table  GROUP BY leit_identificacao_material";
//        echo $sql;     

        $resultado = $db->GetObjectList($sql);

        if ($resultado) {
            return $resultado;
        } else {
            $sql = "SELECT * FROM leitura WHERE leit_etiq_id = " . $EtiquetaId;
            $resultado = $db->GetObjectList($sql);

            if ($resultado) {
                return 'nova_localizacao';
            } else {
                return false;
            }
        }
    }

    function SelectLocalizacao($Objeto)
    {

        $html = "<select id='localizacao' class='form-control'>
                    <option value=''>Escolha uma localização..</option>
                ";

        foreach ($Objeto as $valor) {
            $valor = $valor->leit_loc_material;
            $html .= "<option value='" . $valor . "'> " . $valor . " </option>";
        }

        $html .= "</select>";

        return $html;
    }

    function ObterLeitura($depo_id, $Leitura, $etiq_cod_final)
    {
        global $db;

        $sql = "SELECT SUM(leit_quantidade_aferida) as contagem FROM leitura l
                INNER JOIN etiquetas e ON l.leit_etiq_id = e.etiq_id
                INNER JOIN deposito d ON d.depo_id = e.etiq_depo_centro
                WHERE d.depo_centro = " . $depo_id .
            " AND l.leit_nu_leitura = " . $Leitura .
            " AND e.etiq_cod_final = '" . $etiq_cod_final . "'";

//        echo $sql;

        if ($leit = $db->GetObject($sql)) {
            return $leit->contagem;
        } else {
            return null;
        }
    }

    function TerceiraLeitura($Search)
    {
        global $db;

        $sql = " SELECT DISTINCT leit_etiq_id FROM leitura ";
        $Etiquetas = $db->GetObjectList($sql);

        /*
         * Comentado para testar com todas as etiquetas, mesmo se a leitura 1 e 2 nao tiverem sido completadas
         *
         * foreach ($Etiquetas as $etiqueta) {
            $etiqueta = $etiqueta->leit_etiq_id;

            // verificar se existe as duas leituras
            $sql = " SELECT 
	                 IF 
                        (
                            (SELECT etiq_quantidade FROM etiquetas e WHERE e.etiq_id = {$etiqueta}) = (SELECT COUNT(leit_id) FROM leitura WHERE leit_etiq_id = {$etiqueta} AND leit_nu_leitura = 1) AND
                            (SELECT etiq_quantidade FROM etiquetas e WHERE e.etiq_id = {$etiqueta}) = (SELECT COUNT(leit_id) FROM leitura WHERE leit_etiq_id = {$etiqueta} AND leit_nu_leitura = 2), 'yes', 'no') AS cond ";


            $res = $db->GetObject($sql);

            // caso exista
            if ($res->cond == 'yes')
                $arrayEtiquetas[] = $etiqueta;
        }*/

//        _debug($arrayEtiquetas);
        // nas leituras que existem as 1 e 2, verificar se são diferentes
        foreach ($Etiquetas as $key => $etiqueta) {
            $etiqueta = $etiqueta->leit_etiq_id;
//            var_dump($etiqueta);
            $sql = " SELECT leit_etiq_id FROM leitura
                     WHERE
                    (SELECT SUM(leit_quantidade_aferida) as total1 FROM leitura WHERE leit_etiq_id = {$etiqueta} AND leit_nu_leitura = 1) != 
                    (SELECT SUM(leit_quantidade_aferida) as total2 FROM leitura WHERE leit_etiq_id = {$etiqueta} AND leit_nu_leitura = 2) 
                    AND leit_etiq_id = {$etiqueta}
                    GROUP BY leit_etiq_id";

            $res = $db->GetObjectList($sql);

            // caso sejam diferentes, pegar as informacoes
            if ($res) {
//                $Retorno[$key]['etiqueta'] = $etiqueta;

                $sql = " SELECT DISTINCT SUBSTRING_INDEX(l.leit_identificacao_material, '/', 1) as codigo, l.leit_centro,
                          (SELECT SUM(leit_quantidade_aferida) FROM leitura WHERE leit_etiq_id = {$etiqueta} AND leit_nu_leitura = 1) as total1, 
                          (SELECT SUM(leit_quantidade_aferida) FROM leitura WHERE leit_etiq_id = {$etiqueta} AND leit_nu_leitura = 2) as total2  
                          FROM leitura l
                          INNER JOIN etiquetas e ON e.etiq_id = l.leit_etiq_id
                          INNER JOIN deposito d ON d.depo_centro = l.leit_centro
                          WHERE l.leit_etiq_id = {$etiqueta} ";

                if ($Search) {
                    $sql .= " AND (l.leit_centro LIKE '%$Search%' ";
                    $sql .= " OR d.depo_empresa LIKE '%$Search%' ";
                    $sql .= " OR d.depo_cidade LIKE '%$Search%' )";
                }

//                echo $sql;
//                die();

//                die($sql);
                $Retorno[$key] = $db->GetObject($sql);
            }
        }

        return array_filter($Retorno);
    }

    function TotalContagem($etiq)
    {

    }

    function PorcentagemLeit($centro, $leit)
    {
        global $db, $Materiais, $Deposito;
        
        $quant_leitura_possivel = $Deposito->QuantidadeLeituraPorCentro($centro)->qnt_etiqueta;


//        $quant_materiais = $Materiais->QuantidadePorCentro($centro);

        $sql = " SELECT COUNT(leit_id) as quantidade FROM leitura WHERE leit_nu_leitura = {$leit} AND leit_centro = " . $centro;
        $quant_leitura = $db->GetObject($sql);
        $quant_leitura = $quant_leitura->quantidade;

//        $porcentagem = ($quant_leitura * 100) / $quant_materiais;
        $porcentagem = ($quant_leitura * 100) / $quant_leitura_possivel;

        return number_format($porcentagem, 2);
    }

    function PorcentagemGeral($centro)
    {
        $leit1 = $this->PorcentagemLeit($centro, 1);
        $leit2 = $this->PorcentagemLeit($centro, 2);

        //$geral = (($leit1 + $leit2) * 100) / 200;
        $geral = ($leit1 + $leit2) / 2;

        return number_format($geral, 2) . '%';
    }

    function ObterLocalizacao($EtiqId, $MateId)
    {
        global $db;

        for ($i = 3; $i >= 1; $i--) {
            $sql = "SELECT leit_loc_material FROM leitura WHERE leit_etiq_id = " . $EtiqId . " AND leit_mate_id = " . $MateId . " AND leit_nu_leitura = " . $i;

            if (!$obj = $db->GetObject($sql)) {

            } else {
                return $obj->leit_loc_material;
            }
        }
    }

    /**
     * @param $etiq
     * @param $leitura
     * @return id da bobina, de acordo com a quantidade de leituras efetuadas
     */
    function ObterIdBobina($etiq, $leitura)
    {
        global $db;

        $sql = " SELECT etiq_id_bobina, 
                (SELECT COUNT(leit_id) FROM leitura WHERE leit_etiq_id = {$etiq} AND leit_nu_leitura = {$leitura} ) as posicao_id 
                FROM etiquetas 
                WHERE etiq_id = {$etiq} ";
        $resultado = $db->GetObjectList($sql);
//        var_dump($resultado);
        $id_bobina = explode("#", $resultado[0]->etiq_id_bobina);
//        var_dump($resultado[0]->posicao_id);

        return $id_bobina[$resultado[0]->posicao_id];
    }

}

class Etiquetas extends PEtiquetas
{

    function CriarImagemEtiqueta($IdEtiqueta, $QtdEtiquetas, $MaterialCodigo, $MaterialNome, $DepositoCentro, $UnidadeMedida, $Folder, $Diretorio)
    {
        global $Etiquetas;

        // Salvar na sessão
        $_SESSION['imagens'][$IdEtiqueta] = $QtdEtiquetas;

        // Criando o container da imagem
        $imagecontainer = imagecreatetruecolor(620, 550);
        imagesavealpha($imagecontainer, true);
        $alphacolor = imagecolorallocatealpha($imagecontainer, 0, 0, 0, 127);
        imagefill($imagecontainer, 0, 0, $alphacolor);

//        $background = imagecreatefrompng('TemplateEtiqueta.png');
        $background = imagecreatefrompng('TemplateEtiqueta2.png');
        imagecopyresampled($imagecontainer, $background, 0, 0, 0, 0, 600, 550, 608, 542);
//        imagecopyresampled($dst_image, $src_image, $dst_x = 0, $dst_y = 0, $src_x = 0, $src_y = 0, $dst_w, $dst_h, $src_w, $src_h);
//        http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=olaaa
//        $qrimage = imagecreatefrompng('http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=');

        $Link = "http://vivoinventario.asix6.com/modulos/etiquetas/mleitura.php?id=" . $IdEtiqueta;
//        $qrimage = imagecreatefrompng('http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=' . $Link);
        $qrimage = imagecreatefrompng('http://api.qrserver.com/v1/create-qr-code/?size=265x265&data=' . $Link);
//        $qrimage = imagecreatefrompng('qrcode.png');

        $src_wid = 165;
        $src_hei = 165;
        $dst_wid = 155;
        $dst_hei = 155;
        $y = 175;
        // Adicionando as leituras QR-Code na imagem por coordenadas
//        imagecopyresampled($imagecontainer, $qrimage, 30, $y, 0, 0, $dst_wid, $dst_hei, $src_wid, $src_hei);
        imagecopyresampled($imagecontainer, $qrimage, 185, $y, 0, 0, 240, 240, 265, 265);
//        imagecopyresampled($imagecontainer, $qrimage, 415, $y, 0, 0, $dst_wid, $dst_hei, $src_wid, $src_hei);

        $textcolor = imagecolorallocate($imagecontainer, 0, 0, 0);
        $font = $_SERVER['DOCUMENT_ROOT'] . '/assets/fonts/OpenSans-Bold.ttf';


        $centro = (strlen($DepositoCentro) > 4) ? substr($DepositoCentro, -4) : $DepositoCentro;
        // Escrevendo as informaçẽs em texto na imagem
        imagettftext($imagecontainer, 27, 0, 25, 50, $textcolor, $font, 'CENTRO: ' . $centro);


        // Caso seja bobina, colocar o ID na frente do centro
        $IdBobina = $Etiquetas->GetById($IdEtiqueta)->etiq_id_bobina;
        if ($IdBobina) {
            imagettftext($imagecontainer, 22, 0, 350, 50, $textcolor, $font, 'ID: ' . $IdBobina);
        }

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

    function GerarPDFEtiquetas($Folder, $Diretorio)
    {
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

    function ImportarEtiquetas($ArquivoNome)
    {
        global $db, $Materiais, $Deposito;

        $insert = "INSERT INTO etiquetas (etiq_depo_centro, etiq_mate_material, etiq_quantidade, etiq_cod_final, etiq_id_bobina) VALUES (";

//        $handle = fopen(DOCUMENT_ROOT . '/csv/' . $ArquivoNome, "r");
        $handle = fopen($ArquivoNome, "r");
        if ($handle !== FALSE) {
            $data = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);

                $Mate_id = $Materiais->ObterIdPorCodigo($data[0]);
                $Depo_id = $Deposito->ObterIdPorCentro($data[1]);
                $bobina = $data[3];

                $Cod_final = $data[1] . '-' . $data[0];
                if ($bobina)
                    $Cod_final .= '-' . $bobina;

                $sql = $insert . " '{$Depo_id}', '{$Mate_id}', '{$data[2]}', '{$Cod_final}', '{$bobina}')";
//                echo $sql . " \n\n\n ";
//                var_dump($data);
//                die();

                $db->ExecSQL($sql);
            }

//            die();

            fclose($handle);
            unlink($ArquivoNome);

            return true;
        } else {
            return false;
        }
    }

    function CriarDiretorio($Diretorio)
    {
        $_SESSION['imagens'] = NULL;
        unset($_SESSION['imagens']);

        $folder = md5(time());
        mkdir($Diretorio . 'Temp/' . $folder);

        return $folder;
    }

    function GerarQrCode($IdEtiqueta, $QtdEtiquetas, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida)
    {

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

    function GerarImagemEtiqueta($IdEtiqueta, $QtdEtiquetas, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida, $Folder)
    {

        $res = $this->CriarImagemEtiqueta($IdEtiqueta, $QtdEtiquetas, $CodigoMaterial, $NomeMaterial, $Centro, $UnidadeMedida, $Folder);

        if ($res) {
            return $IdEtiqueta;
        } else {
            return false;
        }
    }

    function GerarPdfEtiqueta($Folder, $Diretorio)
    {
        $nome = $this->GerarPDFEtiquetas($Folder, $Diretorio);

        $_SESSION['imagens'] = NULL;
        unset($_SESSION['imagens']);


        rrmdir($Diretorio . 'Temp/' . $Folder);

        return $nome;
    }

    function DeletarPdf($Arquivo)
    {
        unlink($Arquivo);
    }

}
