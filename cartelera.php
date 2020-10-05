
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
              echo "<div class='card'>";
                    echo "<img src='http://image.tmdb.org/t/p/w185".$movie->getPosterPath()."' style='width:20%; padding-top:50px'>";
                    echo "<div class='container' style='width:20%; padding-top:0px; padding-bottom:100px;'>
                            <h4><b>".$movie->getTitle()."</b></h4>
                            <p>".$movie->getOverview()."</p>
                          </div>";
              echo "</div>";
          }
    ?>
<?php
     include('Views/estructura/footer.php');
?>