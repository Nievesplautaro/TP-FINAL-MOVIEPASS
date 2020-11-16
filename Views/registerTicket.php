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
                        <p>Show Information.</p> 
                    </div>
                    <?php $total = $quantity * $room_price ?>
                    <div class="form">
                        <form action="<?php echo FRONT_ROOT ?>Ticket/registerTicket"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                            <input type="hidden" name="id_show" id="id_show" value="<?php echo $show->getShowId(); ?>">
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
                                Final Price: <?php echo $quantity.' tickets * $'.$room_price.' = $'.$total;  ?>
                            </div>
                            <script
                                src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
                                data-public-key="TEST-64bdf9fa-688d-4f27-b55a-928bdea4e4ae"
                                data-button-label="Payment"
                                data-transaction-amount=<?php echo $total; ?>>
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>