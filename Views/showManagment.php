<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="movie_list">
        <ul class="catalogo cine">
            <?php
            $id = -1;
                if($showList && !empty($showList)){
                        foreach($showList as $show){
                        $id++;
            ?>
            <li class="show">
                <div class="element_cine">
                    <div class="header">
                        <img src="<?php echo IMG_PATH?>/favicon.png" alt="Logo"></img>
                    </div>
                    <div class="title">
                            show Data
                    </div>
                    <div class="data">
                            <div class="element">
                                Name: <?php echo $show->getName()  ?>
                            </div>
                            <div class="element">
                                Phone: <?php echo $show->getPhoneNumber()  ?>
                            </div>
                            <div class="element">
                                Address: <?php echo $show->getAddress()  ?>
                            </div>
                    </div>
                    <div class="actions">
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>show/ShowRegisterView/<?php echo $show->getshowId() ?>">Edit show</a>
                        </div>
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT ?>room/ShowRooms/<?php echo $show->getshowId(); ?>">Admin Rooms</a>
                        </div>
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>show/removeshow/<?php echo $show->getshowId() ?>">Delete show</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php
                        }
                }else{  
                    echo "<div class='Error'>";
                    echo "<div class='empty_cine'><p>Actualmente no tenemos ningun disponible para mostrar.</p><p> Si desea agregar un cine clickee aqui.</p></div>";
                    echo "<div class='button'><a href='";
                    echo FRONT_ROOT;
                    echo"show/registershow'>Add Cine</a></div></div>";
                }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>