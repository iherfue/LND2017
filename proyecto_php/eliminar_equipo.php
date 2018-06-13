<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php $head = cabecera();?>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="eliminar_equipo.php" method="post">
                        <h2>Eliminar el equipo con Nº de serie <?php echo $_GET['sn']?></h2>
                        <input class="btn btn-danger btn-sm" type="submit" name="eliminar" value="Eliminar" /><br><br>
                        <div class="alert alert-warning">
                            <strong>Atención!</strong>Seguro que desea realizar esta operación
                        </div>
                        <input type="hidden" name="borrar" value="true" />
                        <?php if(isset($_GET['sn'])): ?>
                        <input type="hidden" name="sn" value="<?php echo $_GET['sn']; ?>" />
                        <?php endif; ?>
                    </form>
        <a href="equipos.php"><button class="btn">volver</button></a>
                </div>
            </div><br>
    <?php
    //$cogeid = $_POST['id_cliente']; por si acaso borramos directamente
    if(isset($_POST['borrar']) == true){

	$eliminar = "delete from ordenador where sn ='$_POST[sn]'"; 
	if(mysqli_query($conexion, $eliminar)){ 
		header("Location: equipos.php"); 
        }else {
            
            echo mysqli_error($conexion);
        } 
   
    }  ?>
            
        </div>
    </div>
</body>
</html>