<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="grid">
        <div class="dash">
            <div class="movie_list earnings">
            <ul class="catalogo">
                        <?php
                            if($movie && !empty($movie)){
                            ?>
                            <div class="selected_movie">
                                <div class="movie_details">
                                    <div class="data">
                                        <div class="titulo">
                                            <?php echo $movie->getTitle()?>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <img src='http://image.tmdb.org/t/p/w185<?php echo $movie->getPosterPath()?>' alt="Movie Poster">
                                    </div>
                                </div>  
                                <div class="earning_details">
                                <div class="element title">
                                        MOVIE DETAILS
                                    </div>
                                    <div class="element">
                                        Total Earnings: $<?php echo $totalMoney;?>
                                    </div>
                                    <div class="element">
                                        Total Tickets Sold: <?php echo $ticketsSold;?>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
            </ul>
            </div>
        </div>
    </div>
</div>