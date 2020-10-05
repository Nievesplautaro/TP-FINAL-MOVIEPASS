
<?php
     //include('Views/estructura/header.php');
     include('Views/estructura/nav.php');
     require_once("Config/Autoload.php");

     use Repositories\ApiRepository as ApiRepository;
     use Models\Movie as Movie;


     $apiRepository = new ApiRepository();
     $movieList = array();
     $movieList = $apiRepository->GetAllMovies();

    //var_dump($list);

?> 
    <?php
          foreach($movieList as $movie){
              echo "<div class='card' >";
                    echo "<img src='http://image.tmdb.org/t/p/w185".$movie->getPosterPath()."' style='width:15rem; padding-left: 2.5rem; padding-top:1rem;'>";
                    echo "<div class='txtContainer' >
                            <br><b>".$movie->getTitle()."</b></br>
                            <br>".$movie->getOverview()."</br>
                          </div>";
              echo "</div>";
          }
    ?>

<?php
     include('Views/estructura/footer.php');
?>
