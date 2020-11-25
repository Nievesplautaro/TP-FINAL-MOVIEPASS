<!-- In this VIEW we show the admins menu -->
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
<div class="container">
 <div class="grid">
     <?php if(isset($updatemovies) && $updatemovies == '01'){
     ?>
     <div class="msg_welcome update">
          Movies were updated successfully
     </div>
     <?php } ?>
     <div class="msg_welcome">
          Welcome!
     </div>
     <div class="huge">
          ADMIN!
     </div>
 </div>
</div>