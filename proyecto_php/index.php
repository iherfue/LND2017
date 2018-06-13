<?php
include("funciones.php");
$conexion = ConexionBD();
// PARTES
$consulta = "select count(*) as total from  parte_servicio";
$resultado = mysqli_query($conexion, $consulta);

//RECUPERACIONES
$recuperaciones_totales = "select count(*) as total from solicita_recuperacion";
$recuperaciones = mysqli_query($conexion, $recuperaciones_totales);
//Grafico
$recuperaciones_totales1 = "select count(*) as total from solicita_recuperacion";
$recuperaciones_1 = mysqli_query($conexion, $recuperaciones_totales1);

//REPARACIONES

$reparaciones_totales = "select count(*) as total from solicita_reparacion";
$reparaciones = mysqli_query($conexion, $reparaciones_totales);

// grafico
$reparaciones_totales1 = "select count(*) as total from solicita_reparacion";
$reparaciones_1 = mysqli_query($conexion, $reparaciones_totales1);

//CLIENTES
$clientes_totales = "select count(*) as total from  cliente";
$clientes = mysqli_query($conexion, $clientes_totales);

//MOSTRAR ULTIMOS PARTES
$partes_ultimos = "select * from parte_servicio order by id_parte desc limit 5";
$partes = mysqli_query($conexion, $partes_ultimos);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Inicio</title><?php
        $head = cabecera();
        ?>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <link rel="stylesheet" href="custom.css">
    </head>
<body onload="hora(<?php date_default_timezone_set('Europe/Dublin'); echo date("H").", ".date("i").", ".date("s")?>)">
    <script>
        var progreso = 0;
        var progress = setInterval(function () {
        progreso = progreso + 55;
        $('#progreso').css('width', progreso + '%');
        if (progreso > 300) {
            document.getElementById("progreso_fuera").className = "novisible";
            document.getElementById("general").className = "visible";
            }
        }, 500);
    </script> 
<!--Menu-->
<?php $menu = menu() ?>
<header class="titulo">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Vista General</h2>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <ol class="breadcrumb">
            <li class="active">Panel de Control</li><div style="margin-left: 70%" id="muestra_hora"></div>
        </ol>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
          <!--ACCESO RÁPIDO-->
           <?php $acceso_rapido = acceso_rapido() ?>
            <div class="col-md-10">
                <div class="card-header">
                    <h4>Resumen General</h4></div>
                        <div class="card-body">
                            <div class="progress" id="progreso_fuera">
                                <div class="progress-bar progress-bar-striped progress-bar-animated active" id="progreso"role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                </div>
                            </div>
                            <div id ="general" class="novisible">
                                <div class="card-group">
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h2 class="card-text"><?php
                                                    $contados = mysqli_fetch_assoc($resultado);
                                                    echo $contados['total'];
                                                    mysqli_free_result($resultado);
                                                    ?>
                                                    <img src="glyphicons/glyphicons-530-list-alt.png">                   
                                                </h2>
                                                <h5>Partes</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h2 class="card-text">
                                                    <?php
                                                    $reparaciones_contadas = mysqli_fetch_assoc($reparaciones);
                                                    echo $reparaciones_contadas['total'];
                                                    ?>
                                                    <img src="glyphicons/glyphicons-440-wrench.png">
                                                </h2>
                                                <h5>Reparaciones</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h2 class="card-text"><?php
                                                    $recuperaciones_contadas = mysqli_fetch_assoc($recuperaciones);
                                                    echo $recuperaciones_contadas['total'];
                                                    ?>
                                                    <img src="glyphicons/glyphicons-343-hdd.png">
                                                </h2>
                                                <h5>Recuperaciones</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h2 class="card-text"><?php
                                                    $clientes_contados = mysqli_fetch_assoc($clientes);
                                                    echo $clientes_contados['total'];
                                                    ?>
                                                    <img src="glyphicons/glyphicons-4-user.png"> 
                                                </h2>
                                                <h5>Clientes</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: 0,
                        plotShadow: false
                    },
                    title: {
                        text: 'Servicios<br>',
                        align: 'center',
                        verticalAlign: 'middle',
                        y: -80
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            dataLabels: {
                                enabled: true,
                                distance: -50,
                                style: {
                                    fontWeight: 'bold',
                                    color: 'white',
                                    textShadow: '0px 1px 2px black'
                                }
                            },
                            startAngle: -90,
                            endAngle: 90,
                            center: ['50%', '27%']
                        }
                    },
                    series: [{
                            type: 'pie',
                            name: 'demanda',
                            innerSize: '35%',
                            data: [
                                ['Recuperaciones', <?php
                                    $recuperaciones_contadas = mysqli_fetch_assoc($recuperaciones_1);
                                    echo $recuperaciones_contadas['total'];
                                    ?>],
                                ['Reparaciones',  <?php
                                   $reparaciones_contadas = mysqli_fetch_assoc($reparaciones_1);
                                    echo $reparaciones_contadas['total'];
                                 ?>],
                              
                                
                            ]
                        }]
                });
            });
        </script>
        <script type="text/javascript">
        $(function () {
            $('#ingresos').highcharts({
                title: {
                    text: 'Ingresos',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: [
                    <?php 
                    $sql = "SELECT * FROM ingresosdia order by mes asc";
                    $result = mysqli_query($conexion,$sql);
                    while ($registros = mysqli_fetch_array($result))
                    {
                    ?>
                        <?php echo $registros['mes']; ?>,
                    <?php
                    }
                    ?>
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Ingresos'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ''
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Cantidad',
                    data: [
                    <?php 
                    $sql = "SELECT * FROM ingresosdia order by mes";
                    $result = mysqli_query($conexion,$sql);
                    while ($registros = mysqli_fetch_array($result))
                    {
                    ?>
                        <?php echo $registros['cantidad'] ?>,
                    <?php
                    }
                    ?>
                    ]
                }]
            });
        });
        </script>
        <div class="row">
            <div class="col-md-4">
             <div id="container" style=" min-width: 320px; height: 400px; margin: 0 auto"></div>
            </div>
            <div class="col-md-8">
            <div id="ingresos" style=" min-width: 320px; height: 200px; margin: 0 auto;"></div>
            </div>
        </div><br><br>
                    <div class="partes">
                 <!-- PARTES-->
                        <div class="card" id="tabla-partes" style="margin-top: -25%">
                            <div class="card-header">
                                <h4 class="card-title">Últimos Partes</h4>
                                <table class="table table-striped table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>ID Parte</th>
                                            <th>Acepta Presupuesto</th>
                                            <th>Valor Presupuesto</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php while (($fila = mysqli_fetch_assoc($partes)) == true) { ?>
                                            <tr>
                                                <td><?php echo $fila['id_parte']; ?></td>
                                                <td><?php echo $fila['acepta_presupuesto']; ?></td>
                                                <td><?php echo $fila['valor_presupuesto']; ?></td>
                                                <td><?php echo $fila['estado']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php mysqli_free_result($partes); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
<?php $pie = footer(); ?>
<script src="highcharts/js/highcharts.js"></script>
<script src="highcharts/js/modules/exporting.js"></script>
<script src="js/scripts.js"></script>
    </body>
</html>
