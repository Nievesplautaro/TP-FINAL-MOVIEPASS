
<?php
     include('Views/nav.php'); //Tratar de usar el framework, VIEWS_PATH nav
?>
<div class="container menu">
     <div class="grid">
          <div class="dash">
          <div class="narrow">
               <div class="searchBar">
                    <input type="search" placeholder="Que buscas?...">
               </div>
               <div class="filters">
                    <div class="head_title">Genres</div>
                    <ul class="filter_by">
                         <?php 
                              if(!empty($genreList)){
                                   foreach($genreList as $genre){
                         ?>
                                   <li class="categoria">
                                        <a href="<?php echo FRONT_ROOT ?>Dashboard/showMoviesByGenre"><?php echo $genre->getGenreName()?></a>
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
                         foreach($movieList as $movie){
                         echo "<li class='movie' >";
                              echo "<div class='card' >";
                                   echo "<div class='movie_media' ><img src='http://image.tmdb.org/t/p/w185".$movie->getPosterPath()."'></div>";
                                   echo "<div class='title'>
                                        <p><b>".$movie->getTitle()."</b></p>
                                        </div>";
                                    echo "<div class='generos' >Genres: ";
                                    foreach($movie->getGenreIds() as $genreId){
                                        $genre = $this->dashboardDAO->GetGenreById($genreId);
                                        echo $genre." - ";
                                    }
                                    echo "</div>";     
                             echo "</div>";
                         echo "</li>";
                         }
               ?>
          </ul>
          </div>
          </div>
     </div>
</div>

