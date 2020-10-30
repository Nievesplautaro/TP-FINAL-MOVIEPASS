<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="movie_list">
        <ul class="catalogo cine">
            <?php
            $id = -1;
                        foreach($cinemaList as $cinema){
                        $id++;
                        echo "<li class='cinema' >";
                        echo "<div class='element_cine'>";
                            echo "<div onclick=\"location.href='"; echo FRONT_ROOT; echo "Cinema/ShowRegisterView/"; echo $cinema->getName();echo "'\";  class='card' >"
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
                                        ".$cinema->getAddress()."
                                        </div>";
                            echo "</div>
                                </div>";?>
                                <div class="delete">
                                <form action="<?php echo FRONT_ROOT?>Cinema/removeCinema" method="GET">
                                    <input type="hidden" value="<?php echo $cinema->getName() ?>" name="name">
                                    <button type="submit" class="uk-button uk-button-danger uk-button-small">
                                        <img src="<?php echo IMG_PATH ?>trash.png">
                                    </button>
                                </form>
                            </div>
                            <?php
                        echo "</div>";
                        echo "</li>";
                        }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>