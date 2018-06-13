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
                    <form action="eliminar_repuesto.php" method="POST">
                        <h2>Eliminar El repuesto</h2>
                        <input class="btn btn-danger btn-sm" type="submit" name="eliminar" value="Eliminar" /><br><br>
                        <div class="alert alert-warning">
                            <strong>Atención!</strong>Seguro que desea realizar esta operación
                        </div>
                        <input type="hidden" name="borrar" value="true" />
                        <?php if(isset($_GET['numero_serie'])): ?>
                        <input type="hidden" name="numero_serie" value="<?php echo $_GET['numero_serie']; ?>" />
                        <?php endif; ?>
                    </form><br><br>
                    <a href="repuestos.php"><button class="btn">volver</button></a>
                </div>
            </div>                
    <?php
    if(isset($_POST['borrar']) == true){

	$eliminar = "delete from repuestos where numero_serie = '$_POST[numero_serie]'";
	if(mysqli_query($conexion, $eliminar)){ 
		header("Location: repuestos.php"); 
	}else{ 
            echo '<div class="alert alert-danger alert-dismissible">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Atención:</strong> No se puede eliminar el repuesto debido a que esta asignado a un equipo
                  </div>';
	}
    }?>
        </div>
    </div>
</body>
</html>