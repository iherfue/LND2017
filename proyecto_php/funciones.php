<?php

function ConexionBD(){
     error_reporting(0);
    $db_host="localhost";
    $db_nombre="pctota";
    $db_usuario="root";
    $db_contra="78597168G";
    $port="3306";
    
        $conexion= mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre, $port);
        
        return $conexion;
}

function cabecera(){
    error_reporting(0);
    
   echo '
    <meta charset="utf-8"/>
    <meta name="robots" content="index,follow" />
    <meta name="keywords" content="administracion,web de administracion," />
    <meta name="author" content="Ivan hernandez fuentes" />
    <meta http-equiv="x-ua compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="pagina realizada para el proyecto final de curso Módulos PROGRAMACIÓN, BASE DE DATOS, LENGUAJE DE MARCAS Y SISTEMAS DE GESTIÓN DE LA INFORMACIÓN" />
    <meta name="tag-name" content="tag-content" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="js/tinymce.min.js"></script>
    <link rel="stylesheet" href="custom.css">
    ';
    
}


function menu(){
  echo  
 '<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">
   <img src="logo.jpg" alt="Logo" style="width:40px;">
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="menu">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Inicio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="clientes.php">Clientes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="servicios.php">Servicios</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="parte_servicio.php">Partes</a>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Discos
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="discos.php">Ver</a>
        <a class="dropdown-item" href="fallos_discos.php">Fallos</a>
      </div>
    </li>
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Equipos
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="equipos.php">Ver</a>
        <a class="dropdown-item" href="fallos_equipos.php">Fallos</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="distribuidor.php">Distribuidor</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="repuestos.php">Repuestos</a>
    </li>
  </ul>
  </div>
</nav>';
    
}

function acceso_rapido(){
   echo 
    '<div class="col-md-2">
            <div class="list-group">
              <a href="" class="list-group-item active color-primary">Acceso Rápido</a>
              <a href="clientes.php" class="list-group-item"><img src="glyphicons/glyphicons-4-user.png">  Clientes</a>
              <a href="parte_servicio.php" class="list-group-item"><img src="glyphicons/glyphicons-530-list-alt.png"> Partes</a>
              <a href="servicios.php" class="list-group-item"><img src="glyphicons/glyphicons-281-settings.png"> Servicios</a>
              <a href="distribuidor.php" class="list-group-item"><img src="glyphicons/glyphicons-60-cargo.png"> Distribuidor</a>
              <a href="repuestos.php" class="list-group-item"><img src="glyphicons/glyphicons-137-cogwheel.png"> Repuestos</a>
            </div>
          </div>';
    
}

function footer(){
    
    echo ' <footer style="margin-top: 5%;">
        <div class="col-md-12">
            <div class="card" style="background-color: #343A40">
                <div class="card-body">
                    <h5><p style="color: white; text-align: center; margin-top: 1%;">Página web realizada por Iván Hernández Fuentes - Proyecto de BAE,LND,PRO</p></h5>
                </div>
            </div>
        </div>
    </footer>';
    
    mysqli_close($conexion);
}

