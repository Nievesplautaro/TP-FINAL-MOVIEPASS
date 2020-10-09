
<?php
     include('Views/nav.php');
?>

<?php
          foreach($movieList as $movie){
              echo "<div class='card' >";
                    echo "<img src='http://image.tmdb.org/t/p/w185".$movie->getPosterPath()."' style='width:15rem; padding-left: 2.5rem; padding-top:1rem;'>";
                    echo "<div class='txtContainer' >
                            <br><b>".$movie->getTitle()."</b></br>
                            <br>".$movie->getOverview()."
                            </br> </div>";
              echo "</div>";
          }
?>

<?php
     include('Views/estructura/footer.php');
?>
