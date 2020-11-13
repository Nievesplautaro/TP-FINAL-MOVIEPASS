<!-- Validate the User Session -->
<?php
  if(!isset($_SESSION["loggedUser"])){
    header(FRONT_ROOT);  
    die();
  }
?> 