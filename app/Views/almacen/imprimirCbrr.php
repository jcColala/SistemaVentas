<?php  

require 'public/imprimir/fpdf/fpdf.php';

$pdf = new PDF('P', 'mm', array(300,210));
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(50,6,'Actividad',1,0,'C',1);
    $pdf->Output();
?>