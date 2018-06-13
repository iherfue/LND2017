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
                    <form action="eliminar_distribuidor.php" method="POST">
                        <?php
                            $consulta = mysqli_query($conexion,"select nombre from distribuidor where id_distribuidor =".$_GET['id_distribuidor']);
                        ?>
                        <h2>Eliminar El Distribuidor
                         <?php while(($fila= mysqli_fetch_assoc($consulta))==true){
                            echo $fila['nombre']. ' ';
                            }?></h2>
                        <input class="btn btn-danger btn-sm" type="submit" name="eliminar" value="Eliminar" /><br><br>
                        <div class="alert alert-warning">
                            <strong>Atención!</strong>Seguro que desea realizar esta operación
                        </div>
                        <input type="hidden" name="borrar" value="true" />
                        <?php if(isset($_GET['id_distribuidor'])): ?>
                        <input type="hidden" name="id_distribuidor" value="<?php echo $_GET['id_distribuidor']; ?>" />
                        <?php endif; ?>
                    </form><br><br>
                    <a href="distribuidor.php"><button class="btn">volver</button></a>
                </div>
            </div>                
    <?php
    if(isset($_POST['borrar']) == true){

	$eliminar = "delete from distribuidor where id_distribuidor =".$_POST['id_distribuidor']; 
	if(mysqli_query($conexion, $eliminar)){ 
		header("Location: distribuidor.php"); 
	}else{ 
            echo "Hubo un problema al eliminar el registro";
            echo mysqli_error($conexion);
	}
    }?>
        </div>
    </div>
</body>
</html>