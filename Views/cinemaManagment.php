<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="movie_list">
        <ul class="catalogo cine">
            <?php
            $id = -1;
                if($cinemaList && !empty($cinemaList)){
                        foreach($cinemaList as $cinema){
                        $id++;
            ?>
            <li class="cinema">
                <div class="element_cine">
                    <div class="header">
                        <img src="<?php echo IMG_PATH?>/favicon.png" alt="Logo"></img>
                    </div>
                    <div class="title">
                            Cinema Data
                    </div>
                    <div class="data">
                            <div class="element">
                                Name: <?php echo $cinema->getName() ; ?>
                            </div>
                            <div class="element">
                                Phone: <?php echo $cinema->getPhoneNumber() ; ?>
                            </div>
                            <div class="element">
                                Address: <?php echo $cinema->getAddress()  ;?>
                            </div>
                    </div>
                    <div class="actions">
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>Cinema/ShowRegisterView/<?php echo $cinema->getCinemaId(); ?>">Edit Cinema</a>
                        </div>
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT ?>room/ShowRooms/<?php echo $cinema->getCinemaId(); ?>">Manage Rooms</a>
                        </div>
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>Cinema/removeCinema/<?php echo $cinema->getCinemaId() ;?>">Delete Cinema</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php
                        }
                }else{  
                    echo "<div class='Error'>";
                    echo "<div class='empty_cine'><p>Actualmente no tenemos ningun cine disponible para mostrar.</p><p> Si desea agregar un cine clickee aqui.</p></div>";
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