<?php
     require_once("Config/Autoload.php");
     Use Model\User as User;

     session_start();

     if (isset($_SESSION["loggedUser"])){
          $loggedUser = $_SESSION["loggedUser"];
     }
     else{
          header("location:main.php");
     }
     include('header.php');
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="#">Listar Libros</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="#">Agregar Libro</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="logout.php">Cerrar sesión</a>
          </li>
     </ul>
</nav>
