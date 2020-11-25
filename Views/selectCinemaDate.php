<!-- In this VIEW we can Select Cinemas to Create a Show / to see all shows/ to get info about money spent by cinema-->
<?php
    require_once(VIEWS_PATH."navAdmin.php");
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
                        <p>Please Pick Cinema desired.</p> 
                    </div>
                    <div class="form">
                        <form action="<?php echo FRONT_ROOT;?>Ticket/moneyByCinema"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
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
                                </br>
                                <label class="dateLabel" for="indate">From:</label>
                                <input type="date" id="indate" name="indate" required>
                                <label class="dateLabel" for="outdate">To:</label>
                                <input type="date" id="outdate" name="outdate" required>
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