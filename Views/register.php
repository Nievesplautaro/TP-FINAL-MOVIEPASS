<!-- SE COPIPASTEO EL LAYOUT, HAY QUE HACER UN FORMULARIO CON MAS DATOS -->
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
                              <div class="form">
                                   <form action="<?php echo FRONT_ROOT ?>User/SignUp"  method="post" class="login-form bg-dark-alpha p-5 bg-light">
                                   <?php
                                        if(isset($error)){
                                             switch ($error) {
                                                  case "invalid":
                                                       echo "<div class='error' >Ese nombre de usuario ya ha sido registrado</div>";
                                                       break;
                                                  case "02":
                                                       echo "<div class='error' >Error en el envio de datos</div>";
                                                       break;
                                                  }
                                        }

                                   ?>
                                        <div class="form-group">
                                             <label for="">Email</label>
                                             <input type="text" name="email" class="form-control form-control-lg" required>
                                        </div>
                                        <div class="form-group">
                                             <label for="">Password</label>
                                             <input type="password" name="password" class="form-control form-control-lg" required>
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