<?php
require_once(VIEWS_PATH."navAdmin.php");
if(isset($error)){
    switch ($error) {
          case "05":
               echo "<div class='valid' >Admin Registered Successfully</div>";
               break;
          case "02":
               echo "<div class='error' >Cinema Name Already in Use</div>";
          break;
          case "03":
               echo "<div class='error' >Cinema Address Already in Use</div>";
          break;
          case "06":
               echo "<div class='error' >Error Sending Data</div>";
               break;
          }
}
?>