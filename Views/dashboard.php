
<?php
     require_once(VIEWS_PATH."nav.php");
?>
<div class="container menu">
     <div class="grid">
          <div class="dash">
          <div class="narrow">
<!--                <div class="searchBar">
                    <form action="<?= FRONT_ROOT ?>Dashboard/searchMovie" method="post" class="search-container">
                         <input type="search" name="title" placeholder="Que buscas?...">
                    </form>
               </div> -->
               <div class="filters">
                    <div class="date_filter">
                    <div class="head_title">Search by date</div>
                    <form action="<?php echo FRONT_ROOT ?>Dashboard/showMoviesByDate" method="GET">
                         <input type="date" id="start" name="date"
                              value="<?php if(isset($date)){echo $date;}else{ echo date("Y-m-d");}?>"
                              min="2018-01-01" max="2022-12-31">
                         <input type="submit" name="" value="Search"/>
                    </form>
                    </div>
                    <div class="head_title">Search by genres</div>
                    <ul class="filter_by">
                         <?php 
                              if(!empty($genreList)){
                                   foreach($genreList as $genre){
                         ?>
                                   <li class="categoria">
                                        <a href="<?php echo FRONT_ROOT?>Dashboard/showMoviesByGenre?<?php echo $genre->getGenreId()?>"><?php echo $genre->getGenreName()?></a>
                                   </li>
                         <?php
                                   }
                              }
                         ?>
                    </ul>
               </div>
          </div>
          <div class="movie_list">
          <ul class="catalogo">
               <?php
                    if($movieList && !empty($movieList)){
                         foreach($movieList as $movie){
                         echo "<li class='movie' >";
                         echo "<a href='";echo FRONT_ROOT; echo "Dashboard/showMovieDetails/"; echo $movie-> getId(); echo "'>";
                              echo "<div class='card' >";
                                   echo "<div class='movie_media' ><img src='http://image.tmdb.org/t/p/w185".$movie->getPosterPath()."'></div>";
                                   echo "<div class='title'>
                                        <p><b>".$movie->getTitle()."</b></p>                                       
                                        </div>";
                                    echo "<div class='generos' >Genres: ";
                                    $movieId = $this->dashboardDAO->getMovieIdByInternId($movie->getId());
                                    $genres = $this->dashboardDAO->GetGenreByMovieId($movieId);
                                    //var_dump($genres);
                                    foreach($genres as $genre){
                                        echo $genre->getGenreName()." - ";
                                    }
                                    /*foreach($movie->getGenreIds() as $genreId){
                                        $genre = $this->dashboardDAO->GetGenreById($genreId);
                                        
                                    }*/
                                    echo "</div>";     
                             echo "</div>";
                         echo "</a>";
                         echo "</li>";
                         }
                    }
               ?>
          </ul>
          </div>
          </div>
     </div>
</div>

