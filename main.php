<?php
 include('Views/estructura/header.php');
  ?>
     <header class="text-center">
          <div class="cont_header">
               <div class="logo_header">
                    <img src="Style/img/MoviePass_w.png" alt="Movie-Pass">
               </div>
          </div>
     </header>
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
                                   <form action="#" method="post" class="login-form bg-dark-alpha p-5 bg-light">
                                        <div class="form-group">
                                             <label for="">Direccion de Email</label>
                                             <input type="text" name="username" class="form-control form-control-lg" >
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
