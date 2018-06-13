<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php $cabecera = cabecera()?>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="eliminar_parte.php" method="POST">
                        <?php
                            $consulta = mysqli_query($conexion,"select nombre,apellido from cliente,solicita_recuperacion,parte_servicio where cliente.id_cliente = solicita_recuperacion.id_cliente and solicita_recuperacion.id_parte = parte_servicio.id_parte and parte_servicio.id_parte  =".$_GET['id_parte']);
                        ?>
                        <h2>Eliminar El Parte
                         <?php while(($fila= mysqli_fetch_assoc($consulta))==true){
                            echo $fila['nombre']. ' ';
                            echo $fila['apellido'];
                            }?></h2>
                        <input class="btn btn-danger btn-sm" type="submit" name="eliminar" value="Eliminar" /><br><br>
                        <div class="alert alert-warning">
                            <strong>Atención!</strong>Seguro que desea realizar esta operación
                        </div>
                        <input type="hidden" name="borrar" value="true" />
                        <?php if(isset($_GET['id_parte'])): ?>
                        <input type="hidden" name="id_parte" value="<?php echo $_GET['id_parte']; ?>" />
                        <?php endif; ?>
                    </form><br><br>
                        <a href="parte_servicio.php"><button class="btn">volver</button></a>
                </div>
            </div>                
    <?php
    if(isset($_POST['borrar']) == true){

	$eliminar = "delete from parte_servicio where id_parte =".$_POST['id_parte']; 
	if(mysqli_query($conexion, $eliminar)){ 
		header("Location: parte_servicio.php"); 
	}else{ 
            echo "Hubo un problema al eliminar el registro, Esto puede deberse a las Restricciones que existen, Asegurese de eliminar los partes de servicio asociados al cliente";
	}
    }?>
        </div>
    </div>
</body>
</html>