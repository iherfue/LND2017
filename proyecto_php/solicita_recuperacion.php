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
</head>    
<body>
    <script>
       
        var nom;
        var part;
        var sndisco;
        
        function valor(){
            
          nom  = nombre_valor.options[nombre_valor.selectedIndex].value;
          part = parte_valor.options[parte_valor.selectedIndex].value;
          sndisco = sn_valor.options[sn_valor.selectedIndex].value;
          <?php 
           
          ?>
        }
        
     </script>
    <?php 
            $consulta = "select * from cliente";
            $resultado = mysqli_query($conexion,$consulta);
             
            $consulta_parte = "select * from parte_servicio";
            $resultado_consulta_parte = mysqli_query($conexion, $consulta_parte);
            
            $consulta_sn_disco = "select * from discos";
            $resultado_sn_disco = mysqli_query($conexion, $consulta_sn_disco);
           
             if(isset($_POST['id_cliente'])) $id_cliente = $_POST['id_cliente'];
             if(isset($_POST['sn_disco'])) $sn_disco = $_POST['sn_disco'];
             if(isset($_POST['id_parte'])) $id_parte = $_POST['id_parte'];
   
         if(isset($_POST["envia"])){
             
             $insercion = mysqli_query($conexion, "insert into solicita_recuperacion values ('$id_cliente','$sn_disco','$id_parte')");
              echo mysqli_error($conexion);
                 header("Location:solicita_recuperacion.php");
        
              }
        ?>
         
             <form action='solicita_recuperacion.php' method="POST">
            
            <select name="id_cliente" id='nombre_valor'>
                <?php
                while(($fila= mysqli_fetch_assoc($resultado))==true){
                   echo "<option value=".$fila['id_cliente'].">".$fila['nombre'].$fila['apellido']."</option>";
                }
                
                ?>
              
             </select>
              <select name="sn_disco" id='sn_valor'>
                <?php
                while(($fila= mysqli_fetch_assoc($resultado_sn_disco))==true){
                   echo "<option value=".$fila['sn'].">".$fila['sn']."</option>";
                }

                ?>
             </select>
             <select name="id_parte" id='parte_valor'>
                <?php
                while(($fila= mysqli_fetch_assoc($resultado_consulta_parte))==true){
                   echo "<option value=".$fila['id_parte'].">".$fila['id_parte']."</option>";
                }

                ?>
             </select>
            
         
         <input type="submit" value="enviar" name='envia'>
      </form>
</body>    