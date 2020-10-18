<?php
    require_once(VIEWS_PATH."navCinema.php");
?>
<div class="container menu">
    <div class="movie_list">
        <ul class="catalogo">
            <?php
                        foreach($cinemaList as $cinema){
                        echo "<li class='movie' >"; /* no pienso hacer un css para esto */
                            echo "<div class='card' >";
                                echo "<div class='title center'>
                                        ".$cinema->getName()."
                                        </div>
                                        "
                                        ;
                                echo "<div class='data'>
                                        <div class='title center'>
                                        ".$cinema->getPhoneNumber()."
                                        </div>";
                                echo "<div class='title center'>
                                        ".$cinema->getTicketPrice()."
                                        </div>";
                                echo "<div class='title center'>
                                        ".$cinema->getAddress()."
                                        </div>";
                                        echo "<div class='title center'>
                                        ".$cinema->getCapacity()."
                                        </div>";
                                /* echo "<div class='title'>
                                        ".$cinema->getShow()."
                                        </div>"; */
                            echo "</div>
                                </div>";
                        echo "</li>";
                        }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>