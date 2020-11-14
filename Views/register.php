<!-- In this VIEW we can register an User completing a form -->
<?php
     require_once(VIEWS_PATH."nav.php");
?>
     <main class="d-flex align-items-center justify-content-center height-100" >
          <div class="content">
               <div class="container">
                    <div class="grid"> 
                         <div class="form_login register">
                              <div class= "logo_head"> 
                                   <div class="media">
                                        <a href="">
                                        <img src="<?php echo IMG_PATH ?>favicon.png" alt="Logo">
                                        </a>
                                   </div>
                              </div>
                              <div class="data_register">
                                   <p>¡Welcome!</p>
                                   <p>Please Enter Your Information To Register.</p> 
                              </div>
                              <div class="form">
                                   <form action="<?php echo FRONT_ROOT ?>User/SignUp"  method="post" class="login-form bg-dark-alpha p-5 bg-light">
                                   <?php
                                        if(isset($error)){
                                             switch ($error) {
                                                  case "10":
                                                       echo "<div class='error' >Username Already Exists. Please Try Another One.</div>";
                                                       break;
                                                  case "02":
                                                       echo "<div class='error' >Error Sending Data</div>";
                                                       break;
                                                  }
                                        }

                                   ?>
                                        <div class="form-group">
                                             <label for="">Email</label>
                                             <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter Email" title="Email" oninvalid="this.setCustomValidity('Insert a Valid Email')" oninput="this.setCustomValidity('')" required>
                                        </div>
                                        <div class="form-group">
                                             <label for="">Password</label>
                                             <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password" title="Password" minlength = "6" maxlength = "16" oninvalid="this.setCustomValidity('The password should have between 6 to 16 characters')" oninput="this.setCustomValidity('')" required>
                                        </div>
                                        <div class="btn_cont">
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Register</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </main>