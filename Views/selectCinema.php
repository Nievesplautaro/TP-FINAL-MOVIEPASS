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
                        <p>Please Enter Show Information To Register.</p>
                        <?php echo $type; ?> 
                    </div>
                    <div class="form">
                        <form action="<?php echo FRONT_ROOT . $path;?>"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                            <div class="form-group">
                                <label for="id_cinema">Choose a cinema:</label>
                                <select name="id_cinema" id="id_cinema">
                                    <?php 
                                    if($cinemaList && !empty($cinemaList)){
                                        foreach($cinemaList as $cinema){
                                            echo "<option value='".$cinema->getCinemaId()."'>".$cinema->getName()."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                            <div class="btn_cont">
                                <button class="btn btn-primary btn-block btn-lg" type="submit">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>