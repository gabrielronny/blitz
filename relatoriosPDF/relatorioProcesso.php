<?php
    require_once '../lib/fpdf/fpdf.php';
    require_once '../backEnd/backDoc.php';

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $boletim = listarBoletim();
    $data = date('d/m/y');
    $data .= ' '.date('H:i:s');

    $arquivo = "relatorio-boletim.pdf";

    $tipoPdf = "I";

    

    $pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, $pdf->Image('../img/logo_sem_borda.png', 10, 10, 10, 10 ), 0, 0, 'C');
    $pdf->Cell(170, 10, '', 0, 0, 'C');
    $pdf->Cell(10, 10, $pdf->Image('../img/logo-blitz.png', 190, 10, 10, 10 ), 0, 1, 'C');
    $pdf->Cell(190, 15, 'Relatorio de Processos | data: '.$data, 0, 1, 'C');

    $pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(15, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(85, 10, 'Descricao', 1, 0, 'C');
    $pdf->Cell(190/4, 10, 'Cidadao', 1, 0, 'C');
    $pdf->Cell(190/4, 10, 'Data', 1, 1, 'C');

    foreach($boletim as $b){
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(15, 5, $b['codBoletim'], 'B, L', 0, 'C');
        $pdf->Cell(85, 5, $b['descrBoletim'], 'B, L', 0, 'L');
        $pdf->Cell(190/4, 5, $b['cidadao'], 'B, L', 0, 'L');
        $pdf->Cell(190/4, 5, $b['dataBoletim'], 'B, L, R', 1, 'C');
    }






    $pdf->Output($arquivo, $tipoPdf);
?>