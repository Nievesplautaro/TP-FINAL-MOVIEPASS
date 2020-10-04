<?php
     require_once("Config/Autoload.php");
     Use Model\User as User;

     session_start();

     if (isset($_SESSION["loggedUser"])){
          $loggedUser = $_SESSION["loggedUser"];
     }
     else{
          header("location:index.php");
     }
     include('header.php');
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="menu.php">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="catalogo.php">Catalogo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reserva.php">Reserva</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Cerrar Sesion</a>
      </li>
    </ul>
  </div>
</nav>
