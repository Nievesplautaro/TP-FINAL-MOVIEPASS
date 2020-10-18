<?php
    require_once(VIEWS_PATH."navCinema.php");
?>
<div class="container menu">
    <div class="movie_list">
        <ul class="catalogo">
            <?php
            $id = -1;
                        foreach($cinemaList as $cinema){
                        $id++;
                        echo "<li class='movie' >";
                            echo "<div onclick=\"location.href='"; echo FRONT_ROOT; echo "Cinema/editCinema?"; echo $id;echo "'\";  class='card' >"
                            ;
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