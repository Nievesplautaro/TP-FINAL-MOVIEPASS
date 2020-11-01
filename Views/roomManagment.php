<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="room_list">
        <ul class="catalogo cine">
            <?php
                $id = -1;
                    if ($roomList){
                        foreach($roomList as $room){
                             var_dump($room); 
                        $id++;
            ?>
            <li class="cinema">
                <div class="element_cine">
                    <div class="header">
                        <img src="<?php echo IMG_PATH?>/favicon.png" alt="Logo"></img>
                    </div>
                    <div class="title">
                            Room Data
                    </div>
                    <div class="data">
                            <div class="element">
                                Name: <?php echo $room->getRoomName()  ?>
                            </div>
                            <div class="element">
                                Capacity: <?php echo $room->getCapacity()  ?>
                            </div>
                            <div class="element">
                                Price: <?php echo $room->getPrice()  ?>
                            </div>
                    </div>
                    <div class="actions">
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>Room/Delete/<?php echo $room->getRoomId() ?>">Delete Room</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php
                        }
                    
                }else{
                    echo "<div class='Error'>";
                    echo "<div class='empty_cine'><p>Actualmente no tenemos ninguna sala disponible para mostrar.</p><p> Si desea agregar una sala clickee aqui.</p></div>";
                    echo "<div class='button'><a href='";
                    echo FRONT_ROOT;
                    echo "Room/ShowRegisterRoom/";
                    echo $id_cinema;
                    echo "'>Add Cine</a></div></div>";
                }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>