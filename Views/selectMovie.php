<!-- In this VIEW we can Select movies to Create a Show -->
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
                        <p>Please Pick Movie desired.</p> 
                    </div>
                    <div class="form">
                        <form action="<?php echo FRONT_ROOT;?>Ticket/moneyByMovie"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                            <div class="form-group">
                                <label for="id_movie">Choose a movie:</label>
                                <select name="id_movie" id="id_movie">
                                    <?php 
                                    if($movieList && !empty($movieList)){
                                        foreach($movieList as $movie){
                                            echo "<option value='".$movie->getMovieId()."'>".$movie->getTitle()."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </br>
                                <label for="indate">Min Date:</label>
                                <input type="date" id="indate" name="indate" required>
                                <label for="outdate">Max Date:</label>
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