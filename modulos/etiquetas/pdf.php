<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vivo-inventario/Config.php';

define('FPDF_FONTPATH', DOCUMENT_ROOT . "/lib/external/fpdf/font/");
require_once DOCUMENT_ROOT . "/lib/external/fpdf/fpdf.php";
require_once DOCUMENT_ROOT . "/lib/external/fpdi/fpdi.php";

/*
  $pdf = new FPDI('P', 'mm', 'A4');

  $pageCount = $pdf->setSourceFile("gaetiqueta.pdf");
  $tplIdx = $pdf->importPage(1, '/MediaBox');

  $pdf->addPage();
  $pdf->useTemplate($tplIdx, 10, 10, 200);

  $pdf->Output();

 */



$MLeft = 10.1;
$MTop = 15.2;

$CellWidth = 63.5;
$CellHeight = 46.6;

$EspacoMeio = 2.6;
$EspacoBaixo = 4;

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->SetMargins($MLeft, $MTop);
$pdf->AddPage();

$pdf->AddFont('times');
$pdf->SetFont('times');

$Topo = $MTop;
for ($i = 0; $i <= 4; $i++) {
    $pdf->Image('etiquetaTemp.png', $MLeft, $Topo, $CellWidth, $CellHeight);
    $pdf->Image('etiquetaTemp.png', $MLeft + $CellWidth, $Topo, $CellWidth, $CellHeight);
    $pdf->Image('etiquetaTemp.png', ($CellWidth * 2) + $MLeft, $Topo, $CellWidth, $CellHeight);

    $Topo = ($CellHeight + $Topo) + $EspacoBaixo;
}

$pdf->Output('F', 'flawless.pdf');

/**
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */
function FpdfFirst() {
    $MLeft = 10.1;
    $MTop = 15.2;

    $CellWidth = 63.5;
    $CellHeight = 46.6;

    $EspacoMeio = 2.6;
    $EspacoBaixo = 4;

    $pdf = new FPDF('P', 'mm', 'A4');

    $pdf->SetMargins($MLeft, $MTop);
    $pdf->AddPage();

    $pdf->AddFont('times');
    $pdf->SetFont('times');

    $html = "<b>CENTRO:</b> 1124\n MATERIAL: \n04ffffffffffffffff";

    $pdf->Cell($CellWidth, $CellHeight, $html, 1, 0, "R");
    $pdf->SetX($MLeft + $CellWidth + $EspacoMeio);

    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);

    $pdf->SetX((($CellWidth) * 2) + $EspacoMeio * 2 + $MLeft);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);

    $pdf->Ln($CellHeight + $EspacoBaixo);

    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);

    $pdf->SetX($MLeft + $CellWidth + $EspacoMeio);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);

    $pdf->SetX((($CellWidth) * 2) + $EspacoMeio * 2 + $MLeft);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);

    $pdf->Ln($CellHeight + $EspacoBaixo);

    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);
    $pdf->SetX($MLeft + $CellWidth + $EspacoMeio);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);
    $pdf->SetX((($CellWidth) * 2) + $EspacoMeio * 2 + $MLeft);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);

    $pdf->Ln($CellHeight + $EspacoBaixo);

    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);
    $pdf->SetX($MLeft + $CellWidth + $EspacoMeio);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);
    $pdf->SetX((($CellWidth) * 2) + $EspacoMeio * 2 + $MLeft);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);

    $pdf->Ln($CellHeight + $EspacoBaixo);

    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);
    $pdf->SetX($MLeft + $CellWidth + $EspacoMeio);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);
    $pdf->SetX((($CellWidth) * 2) + $EspacoMeio * 2 + $MLeft);
    $pdf->Cell($CellWidth, $CellHeight, "ue", 1, 0);

    $pdf->Output();
}
