<?php
include("funciones.php");
$conexion = ConexionBD();

$archivo_csv = fopen('clientes.csv', 'w');

if($archivo_csv)
{
    fputs($archivo_csv, "nombre, apellido, direccion".PHP_EOL);  

    $sql = "SELECT nombre, apellido, direccion from cliente;";
   /* $sth = $conexion->query($sql);
    echo mysqli_error($conexion);
    $sth->execute();*/
    
 $resultado = mysqli_query($conexion, $sql);

    
      while(($fila= mysqli_fetch_assoc($resultado))==true){
               
        
           fputs($archivo_csv, implode($fila, ',').PHP_EOL);
      };

      exec ("explorer.exe C:\\xampp\\htdocs\\proyecto_php\\clientes.csv");
    header("Location: clientes.php");
}else{
    fclose($archivo_csv);
}

?>