<!-- In this VIEW we can add Cinemas if there is no one charged and Also we display all the data from the Cinemas -->
<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="movie_list">
        <ul class="catalogo cine">
            <?php
                if($cinema){
            ?>
            <li class="cinema earnings">
                <div class="element_cine">
                    <div class="header">
                        <img src="<?php echo IMG_PATH?>/favicon.png" alt="Logo"></img>
                    </div>
                    <div class="title">
                            Cinema Details
                    </div>
                    <div class="data">
                            <div class="element">
                                Name: <?php echo $cinema->getName() ; ?>
                            </div>
                            <div class="element">
                                Total Earnings: $ <?php echo $totalMoney;?>
                            </div>
                            <div class="element">
                                Total Tickets Sold: <?php echo $ticketsSold;?>
                            </div>
                            <div class="element">
                                Phone: <?php echo $cinema->getPhoneNumber() ; ?>
                            </div>
                            <div class="element">
                                Address: <?php echo $cinema->getAddress()  ;?>
                            </div>
                    </div>
                </div>
            </li>
            <?php
                        }
                else{  
                    echo "<div class='Error'>";
                    echo "<div class='empty_cine'><p>Currently, We Don't Have Any Cinema Available To Show.</p><p> If You Want to Add a New One Click Here.</p></div>";
                    echo "<div class='button'><a href='";
                    echo FRONT_ROOT;
                    echo"Cinema/registerCinema'>Add Cine</a></div></div>";
                }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>