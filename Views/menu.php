<!-- In this VIEW we show the Users menu -->
<?php
     require_once(VIEWS_PATH."nav.php");
?>
<div class="container">
     <div class="grid">
          <?php 
          if(isset($_COOKIE['PaymentSuccesfull'])){
          ?>
          <div class="Succesfull Payment">
               Your payment has been successfully credited. We have sent to your Email all the necessary data to enter the cinema. Congratulations.
          </div>
          <?php
          }else{
          ?>
          <div class="msg_welcome">
               <?php if (isset($_SESSION["loggedUser"])){
                    $name = explode("@",$_SESSION["loggedUser"]->getEmail());
               ?>
                    Welcome back <?php echo $name[0]?>! 
               <?php
               }else{
               ?>
                    Welcome!
               <?php
               }
               ?>
          </div>
          <?php
          }
          ?>
          <div class="slider_shows">
               <div class="owl-carousel owl-theme">
               <?php
                    if($lastshows && !empty($lastshows)){
                         foreach($lastshows as $show){
               ?>
                    <div class="item">
                         <div class="show_data">
                         <a href="<?php echo FRONT_ROOT ?>Dashboard/showMovieDetails/<?php echo $show->getId()?>">
                              <div class="title">
                                   <?php echo $show->getTitle();?>
                              </div>
                              <div class="data line-clamp_three ">
                                   <?php echo $show->getOverview();?>
                              </div>
                              <div class="details">
                                   <div class="element">
                                   Genres:
                                   <?php 
                                   $movieId = $this->dashboardDAO->getMovieIdByInternId($show->getId());
                                   $genres = $this->dashboardDAO->GetGenreByMovieId($movieId);
                                   if(!is_array($genres)){
                                        $genresList = [];
                                        $genresList[0] = $genres;
                                   }else{
                                        $genresList = $genres;
                                   }
                                   $size = count($genresList);

                                   foreach($genresList as $key=>$genre){
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
                                   </a>
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