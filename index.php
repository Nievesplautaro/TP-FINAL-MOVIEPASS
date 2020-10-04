<?php
 include('Views/estructura/header.php');
  ?>
     <main class="d-flex align-items-center justify-content-center height-100" >
          <div class="content">
               <div class="container">
                    <div class="grid"> 
                         <div class="form_login">
                              <div class= "logo_head"> 
                                   <div class="media">
                                        <a href="">
                                        <img src="Style/img/favicon.png" alt="Logo">
                                        </a>
                                   </div>
                              </div>
                              <div class="form">
                                   <form action="login.php" method="post" class="login-form bg-dark-alpha p-5 bg-light">
                                   <?php
                                         if(isset($_GET['error']))
                                             echo '<p class="alert-danger">Usuario y/o Contraseña incorrecto</p>';
                                        if(isset($_GET['error-data']))
                                             echo '<p class="alert-danger">Error en el envio de datos</p>'; 
                                   ?>
                                        <div class="form-group">
                                             <label for="">Direccion de Email</label>
                                             <input type="text" name="email" class="form-control form-control-lg" >
                                        </div>
                                        <div class="form-group">
                                             <label for="">Contraseña</label>
                                             <input type="password" name="password" class="form-control form-control-lg" >
                                        </div>
                                        <div class="btn_cont">
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </main>

<?php
 include('Views/estructura/footer.php')
?>
