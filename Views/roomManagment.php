<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="add">
        <form action="<?php echo FRONT_ROOT?>Room/ShowRegisterRoom" method="GET">
            <?php //<input type="hidden" value="<?php echo $cinema->getName()" name="name">"?>
            <button type="submit" class="uk-button uk-button-danger uk-button-small">
            <img src="<?php echo IMG_PATH ?>RoomIcon.png">
            </button>
        </form>
    </div>
    <div class="room_list">
        <ul class="catalogo cine">
            <?php
                $id = -1;
                    if ($roomList){
                        foreach($roomList as $room){
                        $id++;
                        echo "<li class='room' >";
                        echo "<div class='room_element'>";
                            echo "<div onclick=\"location.href='"; echo FRONT_ROOT; echo "Room/ShowEditView/"; echo $room->getRoomId();echo "'\";  class='card' >"
                            ;
                                echo "<div class='title center'>
                                        ".$room->getRoomName()."
                                        </div>
                                        "
                                        ;
                                echo "<div class='data'>
                                        <div class='title center'>
                                        ".$room->getCapacity()."
                                        </div>";
                                echo "<div class='title center'>
                                        ".$room->getPrice()."
                                        </div>";
                            echo "</div>
                                </div>";?>
                                <div class="delete">
                                <form action="<?php echo FRONT_ROOT?>Room/Delete" method="GET">
                                    <input type="hidden" value="<?php echo $room->getRoomId() ?>" name="name">
                                    <button type="submit" class="uk-button uk-button-danger uk-button-small">
                                        <img src="<?php echo IMG_PATH ?>trash.png">
                                    </button>

                                </form>
                                </div>
                            <?php
                        echo "</div>";
                        echo "</li>";
                        }
                    }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>