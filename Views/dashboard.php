
<?php
     include('Views/nav.php');
?>
<div class="container menu">
     <div class="grid">
          <div class="dash">
          <div class="narrow">
               <div class="searchBar">
                    <input type="search" placeholder="Que buscas?...">
               </div>
               <div class="filters">
                    <ul class="filter_by">
                         <li class="categoria">
                              <a href="">ACA VAN LOS ID PARA PEGARLE A LA API POR CATEGORIA</a>
                         </li>
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
                                    echo "<br>Genres: ";
                                    foreach($movie->getGenreIds() as $genreId){
                                        // recorre todos los id, y ejecuta la funcion del dao, si el id existe, devuelve e imprime el nombre
                                        $genre = $this->dashboardDAO->GetGenreById($genreId);
                                        echo $genre." ";
                                    }
                             echo "</div>";
                         echo "</li>";
                         }
               ?>
          </ul>
          </div>
          </div>
     </div>
</div>

