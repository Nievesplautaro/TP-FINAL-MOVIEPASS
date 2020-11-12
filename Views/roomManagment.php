<!-- In this VIEW we can add Rooms if there is no one charged and Also we display all the data from the rooms BY cinema -->
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
                            <a href="<?php echo FRONT_ROOT?>Room/ShowEditRoom/<?php echo $id_cinema ?>/<?php echo $room->getRoomId() ?>">Edit Room</a>
                        </div>
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>Room/Delete/<?php echo $id_cinema ?>/<?php echo $room->getRoomId() ?>">Delete Room</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php
                        }
                    
                }else{
                    echo "<div class='Error'>";
                    echo "<div class='empty_cine'><p>Currently, We Don't Wave Any Room Available to Show.</p><p> If You Want to Add a New One Click Here.</p></div>";
                }
            ?>
        </ul>
        <div class='Error'>
                <div class='empty_cine'>
                    <div class='button'>
                        <a href="<?php echo FRONT_ROOT ?> Room/ShowRegisterRoom/ <?php echo $id_cinema ?> ">Add Room</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>