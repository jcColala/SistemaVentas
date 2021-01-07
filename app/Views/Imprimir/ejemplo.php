<?php

require('public/imprimir/fpdf/fpdf.php');
header("Content-type:application/pdf");
class PDF extends FPDF
	{

		function Footer()
		{
            $this->SetY(-10);
            $this->SetTextColor(125, 60, 152);
            $this->SetFont('Arial','B',10);
            $this->Cell(180,6,'FISI',5,1,'C');
            $this->Line(5,285,206,285);
		}
        



	}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',15);
$pdf->Image("public/img/logo/logo_comprobante.png",20,11,-150,20);
$pdf->SetXY(110, 10);
$pdf->MultiCell(90,8,utf8_decode($ventaU->descripcion)."\n"."RUC:32456712537\n".utf8_decode($ventaU->serie)."-".utf8_decode($ventaU->correlativo),1,'C');
$pdf->Ln();
$pdf->SetXY(10, 32);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(90,10,'De: HUARCAYA HUALLPARUCA CESAR',0,1,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(90,10,'AV.Giraldez N° 281 Int:05-Huancayo-Huancayo-Junin',0,2,'L');
$pdf->SetXY(10, 45);
$pdf->Cell(90,10,'(2do.piso-galerias paris) Telf.(064)589880 - Cel.993081081',0,2,'L');
$pdf->SetXY(10, 52);
$pdf->Cell(90,10,'* SERVICIO TECNICO:',0,2,'L');
$pdf->SetXY(10, 55);
$pdf->Cell(90,10,'Laptops, Pc s, Impresoras, Tablets, Smartphones',0,2,'L');
$pdf->SetXY(10, 59);
$pdf->Cell(90,10,'* VENTA:',0,2,'L');
$pdf->SetXY(10, 62);
$pdf->Cell(90,10,'Equipos, Portafolios, Suministros y Accesorios de computo',0,2,'L');
$pdf->SetXY(10, 66);
$pdf->Cell(90,10,'* SOLUCIONES INFORMATICOS:',0,2,'L');
$pdf->SetXY(10, 69);
$pdf->Cell(90,10,'Ins. de software, recuperación de datos e Informacion',0,2,'L');
$pdf->SetXY(10, 73);
$pdf->Cell(90,10,'* DISENO:',0,2,'L');
$pdf->SetXY(10, 76);
$pdf->Cell(90,10,'Paginas web y Programcion',0,2,'L');
$pdf->SetXY(110, 42);
$pdf->Cell(90,40,'',1,2,'L');
#--------
$pdf->SetXY(112, 44);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(90,10,'Fecha emision   :',0,2,'L');
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(144, 44);
$pdf->Cell(90,10,utf8_decode($ventaU->fechaventa),0,2,'L');
#-----------
$pdf->SetXY(112, 52);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(90,10,"Nom/Raz.soc     :",0,2,'L');
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(144, 52);
$pdf->Cell(50,10,utf8_decode($ventaU->nombre),1,2,'L');
#--------
$pdf->SetXY(112, 60);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(90,10,'DNI/RUC             :',0,2,'L');
$pdf->SetXY(144, 60);
$pdf->Cell(90,10,utf8_decode($ventaU->dni_ruc),0,2,'L');
#--------
$pdf->SetXY(112, 68);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(90,10,'Direccion            :',0,2,'L');
$pdf->SetXY(144, 68);
$pdf->Cell(90,10,utf8_decode($ventaU->direccion),0,2,'L');
$pdf->Ln();
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,6,'CODIGO',1,0,"C",0);
$pdf->Cell(80,6,'DESCRIPCION',1,0,"C",0);
$pdf->Cell(30,6,'PRECIO',1,0,"C",0);
$pdf->Cell(30,6,'CANTIDAD',1,0,"C",0);
$pdf->Cell(30,6,'IMPORTE',1,0,"C",0);
$pdf->Output();
exit;

?>

	

	