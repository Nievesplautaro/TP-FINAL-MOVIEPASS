<main class="d-flex align-items-center justify-content-center height-100" >
        <div class="content">
            <div class="container">
                    <div class="grid"> 
                        <div class="form_edit">
                            <div class= "logo_head"> 
                                <div class="media">
                                        <a href="">
                                        <img src="<?php echo IMG_PATH ?>favicon.png" alt="Logo">
                                        </a>
                                </div>
                            </div>
                            <div class="form">
                                <form action="<?php echo FRONT_ROOT ?>Cinema/editCinema?<?php echo $newCinema->getName() ?>"  method="post" class="login-form bg-dark-alpha p-5 bg-light">
                                <?php
                                        if(isset($_GET['error']))
                                            echo '<p class="alert-danger">Usuario y/o Contraseña incorrecto</p>';
                                        if(isset($_GET['error-data']))
                                            echo '<p class="alert-danger">Error en el envio de datos</p>';
                                            
                                        
                                        
                                ?>
                                        <div class="form-group">
                                            <label for="">Cinema Name</label>
                                            <input type="text" name="name" value="<?php echo $newCinema->getName() ?>" class="form-control form-control-lg" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone number</label>
                                            <input type="number" name="phoneNumber" value="<?php echo $newCinema->getPhoneNumber() ?>" class="form-control form-control-lg" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ticket Price</label>
                                            <input type="number" name="ticketPrice" value="<?php echo $newCinema->getTicketPrice() ?>" class="form-control form-control-lg" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" value="<?php echo $newCinema->getAddress() ?>" class="form-control form-control-lg" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Capacity</label>
                                            <input type="number" name="capacity" value="<?php echo $newCinema->getCapacity() ?>" class="form-control form-control-lg" >
                                        </div>
                                        <div class="btn_cont">
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Edit Cinema</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </main>