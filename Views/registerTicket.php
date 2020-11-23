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
                        <p>Ticket Information.</p> 
                    </div>
                    <div class="form ticket">
                        <form action="<?php echo FRONT_ROOT ?>Ticket/registerTicket"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                            <input type="hidden" name="id_show" id="id_show" value="<?php echo $show->getShowId(); ?>">
                            <input type="hidden" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
                            <input type="hidden" name="ticket_price" id="ticket_price" value="<?php echo $room_price; ?>">
                            <div class="element">
                                Movie: <?php echo $show->getMovie()->getTitle(); ?>
                            </div>
                            <div class="element">
                                Duration: <?php echo $show->getMovie()->getDuration(); ?> mins.
                            </div>
                            <div class="element">
                                Date Time: <?php echo $show->getStartTime(); ?>
                            </div>
                            <div class="element">
                                Cinema: <?php echo $show->getRoom()->getCinema()->getName(); ?>
                            </div>
                            <div class="element">
                                Room: <?php echo $show->getRoom()->getRoomName(); ?>
                            </div>
                            <div class="element">
                                Tickets: <?php echo $quantity;?>
                            </div>
                            <?php
                            if(isset($discount)){
                            ?>
                            <div class="element">
                                Discount per day: $<?php echo $discount;?>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="element">
                                Final Price: $ <?php echo $total;?>
                            </div>

                                <script
                                    src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
                                    data-public-key="TEST-64bdf9fa-688d-4f27-b55a-928bdea4e4ae"
                                    data-button-label="Purchase"
                                    data-summary-product-label="Total"
                                    data-max-installments="6"
                                    data-summary-product="<?php echo $show->getMovie()->getTitle(); ?>"
                                    data-transaction-amount=<?php echo $total; ?>>
                                </script>   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>