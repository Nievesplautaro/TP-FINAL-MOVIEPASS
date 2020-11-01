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
                    </div>
                    <div class="form">
                        <form action="<?php echo FRONT_ROOT ?>Show/register"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                            <div class="form-group">
                                <label for="id_room">Choose a room:</label>
                                <select name="id_room" id="id_room">
                                    <?php 
                                    if($roomList && !empty($roomList)){
                                        foreach($roomList as $room){
                                            echo "<option value='".$room->getRoomId()."'>".$room->getRoomName()."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
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
                            </div>
                            <div class="form-group">
                                <label for="start_time">Select Date and Hour of the Show:</label>
                                <input type="datetime-local" id="start_time" name="start_time">
                            </div>
                            <div class="form-group">
                            <div class="btn_cont">
                                <button class="btn btn-primary btn-block btn-lg" type="submit">Add Show</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>