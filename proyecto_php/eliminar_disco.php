<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php $head = cabecera()?>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="eliminar_disco.php" method="POST">
                        <h2>Eliminar disco con Nº Serie <?php echo $_GET['sn']?></h2>
                        <p>¿Esta seguro de que quiere eliminar el Disco Duro?</p>
                        <input class="btn btn-danger btn-sm" type="submit" name="eliminar" value="Eliminar" /><br><br>
                         <div class="alert alert-warning">
                            <strong>Atención!</strong>Seguro que desea realizar esta operación
                        </div>
                        <input type="hidden" name="borrar" value="true" />
                        <?php if(isset($_GET['sn'])): ?>
                        <input type="hidden" name="sn" value="<?php echo $_GET['sn']; ?>" />
                        <?php endif; ?>
                    </form><br>
                    <a href="discos.php"><button class="btn">volver</button></a><br>
                </div>
    <?php
    if(isset($_POST['borrar']) == true){

	$eliminar = "delete from discos where sn = '$_POST[sn]'";
	if(mysqli_query($conexion, $eliminar)){ 
		header("Location: discos.php"); 
	}else{ 
           
            mysqli_error($conexion);
	}
    }?>
        </div>
        </div>
    </div>
</body>
</html>