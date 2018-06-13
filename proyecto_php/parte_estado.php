<?php
include("funciones.php");
$conexion = ConexionBD();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Untitled Document</title>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    
    <style type="text/css">
        table{
            
            width: 50%;
            border: 1px solid black;
            text-align: left;
        }
        
        td,th{
           width: 20%;
           padding:5px;
           margin:0;
        }
        
        td:first-child{
            
            width: 5%;
        }
        
     </style>
</head>
<body>
    
    <h2>Estado de los Partes Servicio</h2>
    <h2>Partes Pendientes</h2>
      <table>
       <thead>
        <tr>    
             <th>id Parte</th>
             <th>estado</th>
             </tr>
             </thead>
        <tbody>
    <?php

        $consulta = "select id_parte,estado from parte_servicio where estado = 'Pendiente';";
        $resultado = mysqli_query($conexion,$consulta);
        
        while(($fila= mysqli_fetch_assoc($resultado))==true):
    ?>
        <tr>
            <td><?php echo $fila["id_parte"]; ?></td>
	<td><?php echo $fila["estado"]; ?></td>
	</tr>  
        <?php endwhile; ?>
            <?php mysqli_free_result($resultado); ?>
	
        </tbody>
      </table>
    <h2>Partes En curso</h2>
    <table>
       <thead>
        <tr>    
          <th>id Parte</th>
          <th>estado</th>
        </tr>
        </thead>
        <tbody>
    <?php

        $consulta = "select id_parte,estado from parte_servicio where estado = 'En curso';";
        $resultado = mysqli_query($conexion,$consulta);
        
        while(($fila= mysqli_fetch_assoc($resultado))==true):
    ?>
        <tr>
            <td><?php echo $fila["id_parte"]; ?></td>
	<td><?php echo $fila["estado"]; ?></td>
	</tr>  
        <?php endwhile; ?>
            <?php mysqli_free_result($resultado); ?>
	
        </tbody>
      </table>
    
    <h2>Partes Finalizados</h2>
         <table>
       <thead>
        <tr>    
             <th>id Parte</th>
             <th>estado</th>
             </tr>
             </thead>
        <tbody>
    <?php

        $consulta = "select id_parte,estado from parte_servicio where estado = 'Finalizado';";
        $resultado = mysqli_query($conexion,$consulta);
        
        while(($fila= mysqli_fetch_assoc($resultado))==true):
    ?>
        <tr>
            <td><?php echo $fila["id_parte"]; ?></td>
	<td><?php echo $fila["estado"]; ?></td>
	</tr>  
        <?php endwhile; ?>
            <?php mysqli_free_result($resultado); ?>
	
        </tbody>
      </table>
    
    <h2>Partes Entregados</h2>
         <table>
       <thead>
        <tr>    
             <th>id Parte</th>
             <th>estado</th>
             </tr>
             </thead>
        <tbody>
    <?php

        $consulta = "select id_parte,estado from parte_servicio where estado = 'Entregado';";
        $resultado = mysqli_query($conexion,$consulta);
        
        while(($fila= mysqli_fetch_assoc($resultado))==true):
    ?>
        <tr>
            <td><?php echo $fila["id_parte"]; ?></td>
	<td><?php echo $fila["estado"]; ?></td>
	</tr>  
        <?php endwhile; ?>
            <?php mysqli_free_result($resultado); ?>
	
        </tbody>
      </table>
</body>
</html>