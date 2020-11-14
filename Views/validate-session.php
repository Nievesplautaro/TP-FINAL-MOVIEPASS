<!-- Validate the User Session -->
<?php
  if(!isset($_SESSION["loggedUser"])){
    header('location:'.FRONT_ROOT);  
    die();
  }
?> 