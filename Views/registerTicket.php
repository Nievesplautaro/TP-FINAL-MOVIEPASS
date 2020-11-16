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
                        <p>Please Enter your Payment Information.</p> 
                    </div>
                    <div class="form">
                        <form action="<?php echo FRONT_ROOT ?>Ticket/register"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                            <div class="form-group">
                                <label for="tarjeta">Choose a Card Type:</label>
                                <select name="tarjeta" id="tarjeta" required>
                                    <option value="credito">Credito</option>
                                    <option value="debito">Debito</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Card Number</label>
                                <input type="number" name="card_number" class="form-control form-control-lg" placeholder="Enter Card Number" title="Card Number" oninvalid="this.setCustomValidity('Insert a Valid Card')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                <label for="">Card Owner Name</label>
                                <input type="text" name="card_name" class="form-control form-control-lg" placeholder="Enter Card Name" title="Card Name" oninvalid="this.setCustomValidity('Insert a Valid Name')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                <label for="">Card Key</label>
                                <input type="number" name="card_key" class="form-control form-control-lg" placeholder="Enter Card Key" title="Card Key" oninvalid="this.setCustomValidity('Insert a Valid Key')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                            <!-- <div class="btn_cont">
                                <button class="btn btn-primary btn-block btn-lg" type="submit">Submit Payment Info</button>
                            </div> -->
                                <script
                                    src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
                                    data-public-key="TEST-64bdf9fa-688d-4f27-b55a-928bdea4e4ae"
                                    data-button-label="Payment"
                                    data-transaction-amount="100.00">
                                </script>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>