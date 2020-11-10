
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
                        <p>Please Enter Room Information To Register.</p> 
                        <?php echo $room->getRoomId(); ?>
                    </div>
                    <div class="form">
                        <form action="<?php echo FRONT_ROOT ?>Room/editRoom"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                        <?php
                            if(isset($error)){
                                switch ($error) {
                                    case "01":
                                        echo "<div class='error' >Room Name Already Exists. Please Try Another One.</div>";
                                        break;
                                    case "02":
                                        echo "<div class='error' >Error Sending Data</div>";
                                        break;
                                    }
                            }

                        ?>
                            <div class="form-group">
                                <input type="hidden" name="id_cinema" value="<?php echo $id_cinema; ?>">
                                <input type="hidden" value="<?php echo $room->getRoomId() ?>" name="id_room">
                                <label for="">Room Name</label>
                                <input type="text" name="room_name" value="<?php echo $room->getRoomName(); ?>" class="form-control form-control-lg" placeholder="Enter Room Name" title="Room Name" oninvalid="this.setCustomValidity('Insert a Valid Email')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                <label for="">Capacity</label>
                                <input type="number" name="capacity" value="<?php echo $room->getCapacity(); ?>" class="form-control form-control-lg" placeholder="Enter Room Capacity" title="Capacity" min = "50" max = "200" oninvalid="this.setCustomValidity('The Capacity should be between 50 to 200 clients')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                              <input type="number" name="price" value="<?php echo $room->getPrice(); ?>" class="form-control form-control-lg" placeholder="Enter Room Price" title="Price" min = "50" max = "200" oninvalid="this.setCustomValidity('The Price should be between 50 to 200 clienARSts')" oninput="this.setCustomValidity('')" required>
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