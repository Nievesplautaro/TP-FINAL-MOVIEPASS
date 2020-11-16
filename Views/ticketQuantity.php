<!-- In this VIEW we can register a ticket completing a form -->
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
                        <p>Enter the tickets quantity you want.</p> 
                    </div>
                    <div class="form">
                        <form action="<?php echo FRONT_ROOT ?>Ticket/purchaseTicket"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                            <div class="form-group">
                                <label for=""></label>
                                <input type="number" name="quantity" class="form-control form-control-lg" placeholder="Quantity" title="Capacity" min = "1" max = "10" oninvalid="this.setCustomValidity('You have to select a number of tickets between 1 and 10.')" oninput="this.setCustomValidity('')" required>
                                
                            </div>
                            <div class="element">
                                   Unit Price: $<?php echo $roomPrice ?>
                            </div>
                            <div class="form-group">
                              <input type="hidden" name="id_show" value="<?php echo $id_show; ?>">
                              <input type="hidden" name="room_price" value="<?php echo $roomPrice; ?>">
                              <div class="btn_cont">                                        
                                   <input type="submit" value="Continue" class="btn btn-primary btn-block btn-lg btn_ticket">
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>