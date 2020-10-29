<?php
require_once(VIEWS_PATH."navAdmin.php");
if(isset($error)){
    switch ($error) {
         case "03":
              echo "<div class='valid' >Admin Registered Successfully</div>";
              break;
         case "02":
              echo "<div class='error' >Error Sending Data</div>";
              break;
         }
}
?>