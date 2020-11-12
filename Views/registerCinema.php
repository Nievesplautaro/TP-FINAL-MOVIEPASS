<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="d-flex align-items-center justify-content-center height-100" >
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
                                <form action="<?php echo FRONT_ROOT ?>Cinema/register"  method="post" class="login-form bg-dark-alpha p-5 bg-light">
                                <?php
                                        if(isset($error)){
                                            switch ($error) {
                                                case "01":
                                                    echo "<div class='valid' >Cinema Registered Successfully</div>";
                                                    break;
                                                case "02":
                                                    echo "<div class='error' >Cinema Name Already in Use</div>";
                                                    break;
                                                case "03":
                                                    echo "<div class='error' >Cinema Address Already in Use</div>";
                                                    break;
                                                case "04":
                                                    echo "<div class='error' >Error Sending Data<</div>";
                                                    break;
                                                }
                                       }
                                ?>
                                        <div class="form-group">
                                            <label for="">Cinema Name</label>
                                            <input type="text" name="name" value="" class="form-control form-control-lg" placeholder="Enter Cinema Name" title="Cinema Name" minlength = "3" oninvalid="this.setCustomValidity('Invalid Cinema Name')" oninput="this.setCustomValidity('')" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone number</label>
                                            <input type="tel" name="phoneNumber" value="" class="form-control form-control-lg" placeholder="Enter Phone Number" title="Phone Number" oninvalid="this.setCustomValidity('Invalid Phone Numer')" oninput="this.setCustomValidity('')" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" value="" class="form-control form-control-lg" placeholder="Enter Address" title="Address" minlength = "6" maxlength = "75" oninvalid="this.setCustomValidity('Invalid Address')" oninput="this.setCustomValidity('')" required>
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
</div>