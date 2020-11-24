<div class="container menu">
    <div class="grid">
        <div class="dash">
            <div class="movie_list">
            <ul class="catalogo">
                        <?php
                            if($movie && !empty($movie)){
                            ?>
                            <div class="selected_movie">
                                <div class="movie_details">
                                    <div class="media">
                                        <img src='http://image.tmdb.org/t/p/w185<?php echo $movie->getPosterPath()?>' alt="Movie Poster">
                                    </div>
                                    <div class="data">
                                        <div class="titulo">
                                            <?php echo $movie->getTitle()?>
                                        </div>
                                        <div class="description">
                                            <?php echo $movie->getOverview()?>
                                        </div>
                                        <div class="details">
                                            <p>Duration:<?php echo $movie->getDuration()?></p>
                                            <p>Release Date:<?php echo $movie->getReleaseDate()?></p>
                                            <p>Original Lenguage:<?php echo $movie->getOriginalLanguage()?></p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div>
                                <?php echo $total ?>
                            </div>
                        <?php
                            }
                        ?>
            </ul>
            </div>
        </div>
    </div>
</div>