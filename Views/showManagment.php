<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="room_list">
        <ul class="catalogo cine">
            <?php
            $id = -1;
                if($showList && !empty($showList)){
                        foreach($showList as $show){
                        $id++;
            ?>
            <li class="cinema">
                <div class="element_cine">
                    <div class="header">
                        <img src="<?php echo IMG_PATH?>/favicon.png" alt="Logo"></img>
                    </div>
                    <div class="title">
                            show Data
                    </div>
                    <div class="data">
                            <div class="element">
                                Movie: <?php echo $show->getMovie()->getTitle();?>
                            </div>
                    </div>
                    <div class="data">
                            <div class="element">
                                Room: <?php echo $show->getRoom()->getRoomName();?>
                            </div>
                    </div>
                    <div class="data">
                            <div class="element">
                                Start Time: <?php echo $show->getStartTime()  ?>
                            </div>
                    </div>
                    <div class="actions">
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>show/editShow/<?php echo $show->getshowId() ?>">Edit show</a>
                        </div>
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>show/removeShow/<?php echo $show->getshowId() ?>">Delete show</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php
                        }
                }else{  
                    echo "<div class='Error'>";
                    echo "<div class='empty_cine'><p>Actualmente no tenemos ningun disponible para mostrar.</p><p> Si desea agregar un show clickee aqui.</p></div>";
                    echo "<div class='button'><a href='";
                    echo FRONT_ROOT;
                    echo"show/registershow/";
                    echo $id_cinema;
                    echo "'>Add Show</a></div></div>";
                }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>