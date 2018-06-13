<?php
require("../funciones.php");

include 'plantilla.php';
$conexion = ConexionBD();
$consulta = "select nombre,apellido,telefono,email,acepta_presupuesto,valor_presupuesto,estado from cliente,solicita_reparacion,parte_servicio,clienteTelefono,clienteEmail
 where cliente.id_cliente = clienteEmail.id_cliente and cliente.id_cliente = clienteTelefono.id_cliente and cliente.id_cliente = solicita_reparacion.id_cliente and parte_servicio.id_parte = solicita_reparacion.id_parte and parte_servicio.estado = 'Finalizado';";
$resultado = mysqli_query($conexion, $consulta);
	$pdf = new PDF();
	$pdf->AliasNbPages();

    $pdf->AddPage('L','A4',0);  
        
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(40,10,'Nombre',1,0,'C');
        $pdf->Cell(45,10,'Apellido',1,0,'C');
        $pdf->Cell(40,10,'Telefono',1,0,'C');
        $pdf->Cell(50,10,'Email',1,0,'C');
        $pdf->Cell(50,10,'Presupuesto',1,0,'C');
        $pdf->Cell(45,10,'Estado',1,0,'C');
        $pdf->Ln();
    
   

        $pdf->SetFont('Times','',12);
         while(($fila= mysqli_fetch_assoc($resultado))==true){
            
        $pdf->Cell(40,10,$fila['nombre'],1,0,'C');
        $pdf->Cell(45,10,$fila['apellido'],1,0,'C');
        $pdf->Cell(40,10,$fila['telefono'],1,0,'C');
        $pdf->Cell(50,10,$fila['email'],1,0,'C');
        $pdf->Cell(50,10,$fila['valor_presupuesto'],1,0,'C');
        $pdf->Cell(45,10,$fila['estado'],1,0,'C');
        $pdf->Ln();
         }

/*
$pdf->headerTable();*/

$pdf->Output();
$pdf->AliasNbPages();
     
?>