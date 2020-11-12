<!-- Validate the User Session -->
<?php
  if(!isset($_SESSION["loggedUser"]))
    header("location:../index.php");  
?> 