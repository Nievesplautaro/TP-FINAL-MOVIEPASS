<!-- In this VIEW we can add shows if there is no one charged and Also we display all the data from the shows BY room -->
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
                            Show Data
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
                                Start Time: <?php echo $show->getStartTime() ?>
                            </div>
                    </div>
                    <div class="data">
                            <div class="element">
                                Purchased Tickets: <?php if($show->getTicketPurchased()!= null){echo $show->getTicketPurchased();}else{echo '0';} ?>
                            </div>
                    </div>
                    <div class="data">
                            <div class="element">
                                Remaining Tickets: <?php echo ($show->getRoom()->getCapacity()-$show->getTicketPurchased()) ?>
                            </div>
                    </div>
                    <div class="data">
                            <div class="element">
                                Amount Collected: $ <?php if($show->getAmountCollected()!= null){ echo $show->getAmountCollected();}else{echo '0';} ?>
                            </div>
                    </div>
                    <div class="actions">
                        <div class="button">
                            <a href="<?php echo FRONT_ROOT?>Show/removeShow/<?php echo $show->getShowId() ?>">Delete show</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php
                        }
                }else{  
                    echo "<div class='Error'>";
                    echo "<div class='empty_cine'><p>Currently, we don't have any Show available.</p><p> If You Want to Add a New One Click Here.</p></div>";
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