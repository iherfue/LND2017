<?php
include("funciones.php");
$conexion = ConexionBD();

$lista = "select nombre,apellido,direccion,telefono,email from cliente,clienteTelefono,clienteEmail where cliente.id_cliente = clienteTelefono.id_cliente and cliente.id_cliente = clienteEmail.id_cliente";
$consulta = mysqli_query($conexion, $lista);
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8"?>';
echo("<clientes>");

while($fila= mysqli_fetch_row($consulta)){
    
    echo("<cliente>");
    
    echo("<nombre>$fila[0]</nombre>");
    echo("<apellido>$fila[1]</apellido>");
    echo("<direccion>$fila[2]</direccion>");
    echo("<telefono>$fila[3]</telefono>");
    echo("<email>$fila[4]</email>");
    echo("</cliente>");
    
}
echo ("</clientes>");
?>

