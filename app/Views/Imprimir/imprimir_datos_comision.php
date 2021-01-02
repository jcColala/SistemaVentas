<?php

$mysqli = new mysqli("localhost","root","","comisiones"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}

  $query_tareas = " SELECT                      
                                         act.Nombre_Actividad,
                                         act.Desde,
                                         act.Desde_Real,
                                         act.Hasta,
                                         act.Hasta_Real,
                                         tar.Nombre_Tarea,
                                         tar.Proceso_Tarea
                                        
                               FROM  actividad_comision as act
                               inner join tareas_comision as tar
                               WHERE
                                    act.Id_Actividad_Comision=tar.Id_Actividad_Comision and act.Id_Comision=$id_comi
                             ";

	$tareas = $mysqli->query($query_tareas);

    $query_encargados = " SELECT                      
                                do.Nombre_Docente,
                                do.Apellido_Docente,
                                de_en.Presidente
                                        
                               FROM  detalle_encargado de_en
                               inner join docente as do
                               WHERE
                                    de_en.Id_Docente=do.Id_Docente and de_en.Id_Comision=$id_comi
                             ";

    $encargados = $mysqli->query($query_encargados);

    $query_actividades = "SELECT 
                               (SELECT COUNT(Id_Actividad_Comision) FROM actividad_comision  WHERE Id_Comision=$id_comi ) as cont_act,
                                (SELECT COUNT(Estado_Actividad) FROM actividad_comision  WHERE  com.Id_Comision=Id_Comision and Estado_Actividad=1) as cont,
                                (SELECT COUNT(Id_Tarea_Comision) FROM tareas_comision  WHERE  act.Id_Actividad_Comision=Id_Actividad_Comision and Estado=1) as cont_tar,
                                (SELECT COUNT(Id_Tarea_Comision) FROM tareas_comision  WHERE  act.Id_Actividad_Comision=Id_Actividad_Comision and Estado=1 and Proceso_Tarea=1) as cont_tar_rea,
                                act.Nombre_Actividad,
                                act.Estado_Actividad,
                                act.Desde,
                                act.Desde_Real,
                                act.Hasta,
                                act.Hasta_Real
                               FROM comision as com
                               inner join actividad_comision as act
                               where  com.Id_Comision=act.Id_Comision and com.Id_Comision=$id_comi
                               GROUP BY  act.Nombre_Actividad,
                                act.Estado_Actividad,
                                act.Desde,
                                act.Desde_Real,
                                act.Hasta,
                                act.Hasta_Real
                             ";

    $actividades = $mysqli->query($query_actividades);


	require 'assets/imprimir/fpdf/fpdf.php';
	
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

	   function logo(){
       
        $this->Cell(1,0,'',0,0,'C',$this->Image('assets/images/impri.png',10, 5, 25, 'R'));
      }
       function n_fecha($desde,$hasta){

        $this->SetXY(5,25); 
        $this->SetFont('Arial','',9);
        $this->Cell(195,5,'Desde: '.$desde.' / Hasta'.$hasta,0, 1 ,'R');
        $this->Line(10,32,202,32);
     
      }

 		function empresa($Nombre_c,$reso){
       
        $this->SetXY(50,14); 
        $this->SetFont('Arial','B',10);
        $this->Cell(100,2,utf8_decode($Nombre_c),0,1,'');
        $this->SetXY(51,15); 
        $this->SetFont('Arial','',9);
        $this->Cell(100,8,utf8_decode($reso),0,1,'');
    }


}

$pdf = new PDF('P', 'mm', array(300,210));
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->logo();

    $pdf->n_fecha($desde,$hasta);
    $pdf->Ln();

    $pdf->empresa($Nombre_c,$reso);

    $pdf->Ln(20);

    $pdf->SetFillColor(34, 153, 84);
    $pdf->SetTextColor(248, 249, 249);
    $pdf->SetFont('Arial','B',0);
    $pdf->Cell(120,6,'Encargado',1,0,'C',1);
    $pdf->Cell(70,6,'Presidente',1,1,'C',1);
    $pdf->SetTextColor(131, 145, 146);
    
    $pdf->SetFont('Arial','',8);
    
    while($row = $encargados->fetch_assoc())
    {
        $y = $pdf->GetY();
        $yt = $pdf->GetY();
        $pdf->MultiCell(120,4,$row['Nombre_Docente'].' '.$row['Apellido_Docente'],0,'C');
        $pdf->SetXY(130,$y);
        if ($row['Presidente']==1) {
            $pdf->SetTextColor(34, 153, 84);
            $pdf->Cell(70,6,'Presidente',0,1,'C');
        }
        else{
            $pdf->SetTextColor(192, 57, 43);
            $pdf->Cell(70,6,'Miembro',0,1,'C');
        }
        $pdf->SetTextColor(131, 145, 146);
        $pdf->Line(11,$y+5,200,$y+5);
        
    }

    $pdf->Ln(10);

    $pdf->SetFillColor(34, 153, 84);
    $pdf->SetTextColor(248, 249, 249);
    $pdf->SetFont('Arial','B',0);
    $pdf->Cell(50,6,'Actividad',1,0,'C',1);
    $pdf->Cell(50,6,'Fechas',1,0,'C',1);
    $pdf->Cell(20,6,utf8_decode('N° Tareas'),1,0,'C',1);
    $pdf->Cell(30,6,utf8_decode('N° Tareas Realizadas'),1,0,'C',1);
    $pdf->Cell(20,6,'%Avance',1,0,'C',1);
    $pdf->Cell(20,6,'Proceso',1,1,'C',1);
    $pdf->SetTextColor(131, 145, 146);
    
    $pdf->SetFont('Arial','',7);
    $to=0;
    $total=0;
    while($row = $actividades->fetch_assoc())
    {
        $y = $pdf->GetY();
        $yf = $pdf->GetY();
        $pdf->MultiCell(48,5,$row['Nombre_Actividad'],0);
        $pdf->SetXY(60,$y);
        $pdf->MultiCell(40,4,'Realizado:'.$row['Desde_Real'].'/'.$row['Hasta_Real'].'Planedo:'.$row['Desde'].'/'.$row['Hasta'],0);
        $pdf->SetXY(110,$yf);
        $pdf->Cell(20,10,$row['cont_tar'],0,0,'C');
        $pdf->Cell(30,10,$row['cont_tar_rea'],0,0,'C');
        $por=100/$row['cont_act'];
        if ($row['Estado_Actividad']==1) {
            $pdf->Cell(20,10,round($por,0).'%',0,0,'C');
        } 
        else{
            $pdf->Cell(20,10,'0 %',0,0,'C');
            $por=0;
        }
        if ($row['Estado_Actividad']==1) {
            $pdf->SetTextColor(34, 153, 84);
            $pdf->Cell(20,10,'Realizado',0,1,'C');
        }
        else{
            $pdf->SetTextColor(192, 57, 43);
            $pdf->Cell(20,10,'No Realizado',0,1,'C');
        }
        $pdf->SetTextColor(131, 145, 146);
        $pdf->Line(11,$y+9,200,$y+9);

        $total=$total+$por;
        
    }
    $p = $pdf->GetY();

    $pdf->Ln(30);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(248, 249, 249);
    $pdf->Cell(80,6,'Fecha Reporte',1,0,'C',1);
    $pdf->Cell(50,6,'% Avance Total',1,1,'C',1);
    $pdf->SetTextColor(131, 145, 146);
    $pdf->SetFont('Arial','',10);
    date_default_timezone_set('America/Mexico_City'); 
    $pdf->Cell(80,6,date('d/m/Y (g:ia)'),1,0,'C',0);
    $pdf->Cell(50,6,round($total,0).' %',1,1,'C',0);
    if (round($total,0)>=0 and round($total,0)<=49) {
        $pdf->Cell(1,0,'',0,0,'C',$pdf->Image('assets/images/colores/rojo.png',156, $p+20, 45, 'R'),100,40);
    }
    if (round($total,0)>=50 and round($total,0)<=69) {
          $pdf->Cell(1,0,'',0,0,'C',$pdf->Image('assets/images/colores/amarillo.png',160, $p+20, 30, 'R'),100,40);
    }
    if (round($total,0)>=70 and round($total,0)<=99) {
        $pdf->Cell(1,0,'',0,0,'C',$pdf->Image('assets/images/colores/azul.png',156, $p+18, 38, 'R'),100,40);
    }
    if (round($total,0)==100) {
         $pdf->Cell(1,0,'',0,0,'C',$pdf->Image('assets/images/colores/verde.png',160, $p+20, 30, 'R'),100,40);
    }


   $pdf->AddPage();

    $pdf->SetFillColor(34, 153, 84);
    $pdf->SetTextColor(248, 249, 249);
    $pdf->SetFont('Arial','B',0);
    $pdf->Cell(50,6,'Actividad',1,0,'C',1);
    $pdf->Cell(50,6,'Tarea',1,0,'C',1);
    $pdf->Cell(40,6,'Fechas',1,0,'C',1);
    $pdf->Cell(26,6,'Realizado',1,0,'C',1);
    $pdf->Cell(26,6,'Proceso',1,1,'C',1);
    $pdf->SetTextColor(131, 145, 146);
    
    $pdf->SetFont('Arial','',7);
    
    while($row = $tareas->fetch_assoc())
    {
        $y = $pdf->GetY();
        $yt = $pdf->GetY();
        $yf = $pdf->GetY();
        $pdf->MultiCell(48,5,$row['Nombre_Actividad'],0);
        $pdf->SetXY(60,$y);
        $pdf->MultiCell(48,5,$row['Nombre_Tarea'],0);
        $pdf->SetXY(110,$yt);
        $pdf->MultiCell(40,5,'Realizado:'.$row['Desde_Real'].'/'.$row['Hasta_Real'].'Planedo:'.$row['Desde'].'/'.$row['Hasta'],0);
        $pdf->SetXY(151,$yf);
        if ($row['Desde_Real']=='0000-00-00' and $row['Hasta_Real']=='0000-00-00') {
            $pdf->SetTextColor(192, 57, 43);
            $pdf->Cell(26,10,'No Realizado',0,0,'C');
        }
        else{
            if ($row['Desde_Real']>=$row['Desde']  and $row['Hasta_Real']<=$row['Hasta']) {
                   $pdf->SetTextColor(34, 153, 84);
                   $pdf->Cell(26,10,'En lo Planeado',0,0,'C');                   
            }
            else{
              $pdf->SetTextColor(241, 196, 15);
              $pdf->Cell(26,10,'Fuera de lo Planeado',0,0,'C');
              }  
        }
        if ($row['Proceso_Tarea']==1) {
            $pdf->SetTextColor(34, 153, 84);
            $pdf->Cell(26,10,'Realizado',0,1,'C');
        }
        else{
            $pdf->SetTextColor(192, 57, 43);
            $pdf->Cell(26,10,'No Realizado',0,1,'C');
        }
        $pdf->SetTextColor(131, 145, 146);
        $pdf->Line(11,$y+9,200,$y+9);
    }
    $pdf->Ln(20);
	$pdf->Output();
 
?>

