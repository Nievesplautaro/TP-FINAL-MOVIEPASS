<?php
     require_once(VIEWS_PATH."nav.php");
?>
<div class="container">
     <div class="grid">
          <div class="msg_welcome">
               Bienvenido ! 
          </div>
          <div class="slider_shows">
               <div class="owl-carousel owl-theme">
               <?php
                    if($lastshows && !empty($lastshows)){
                         foreach($lastshows as $show){
               ?>
                    <div class="item">
                         <div class="show_data">
                              <div class="title">
                                   <?php echo $show->getTitle();?>
                              </div>
                              <div class="data line-clamp_four">
                                   <?php echo $show->getOverview();?>
                              </div>
                              <div class="details">
                                   <div class="element">
                                   Genres:
                                   <?php 
                                   $movieId = $this->dashboardDAO->getMovieIdByInternId($show->getId());
                                   $genres = $this->dashboardDAO->GetGenreByMovieId($movieId);
                                   $size = count($genres);

                                   foreach($genres as $key=>$genre){
                                        if($key < $size-1){
                                             echo $genre->getGenreName()." - ";
                                        }else{
                                             echo $genre->getGenreName(); 
                                        } 
                                   }
                                   ?>
                                   </div>
                                   <div class="element">
                                        Duration:
                                        <?php
                                              echo $show->getDuration();
                                        ?>
                                        minutes
                                   </div>
                                   <div class="element">
                                        Language:
                                        <?php
                                              echo $show->getOriginalLanguage();
                                        ?>
                                   </div>
                                   <div class="element">
                                        Rate:
                                        <?php
                                              echo $show->getVoteAverage();
                                        ?>
                                   </div>
                              </div>
                              <div class="action">
                                   <a href="<?php echo FRONT_ROOT ?>Dashboard/showMovieDetails/<?php echo $show->getId()?>">BUY TICKETS</a>
                              </div>
                         </div>
                         <div class="show_img">
                              <img src="http://image.tmdb.org/t/p/w185<?php echo $show->getPosterPath();?>" alt="Our Cinema">
                         </div>
                    </div>
               
               <?php               
                         }
                    }
               ?>
               </div>
          </div>
     </div>
</div>
<?php
?>