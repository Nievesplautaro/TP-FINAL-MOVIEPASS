<?php
    namespace Controllers;

    use DAO\RequestDAO as RequestDAO;
    Use Models\Movie as Movie;

    

    class DashboardController
    {
     private $dashboardDAO;
     //private $movieListArray ;
        
     public function __construct(){
         //$this->movieListArray = array();
          $this->dashboardDAO = new RequestDAO();
     }

     public function ShowDashboardView($message = ""){
          //$movieList = $this->movieListArray;
          require_once(VIEWS_PATH."validate-session.php");
          require_once(VIEWS_PATH."dashboard.php");
     }

    public function showMovies(){
         
          $movieList = array();

          /* $this->dashboardDAO->SaveMoviesFromApi();
          $this->dashboardDAO->SaveGenresFromApi(); */

          $movieList = $this->dashboardDAO->readMovies(); 
          $genreList = $this->dashboardDAO->readGenres();
          
          //var_dump($this->dashboardDAO->readGenres());
          //var_dump($this->dashboardDAO->readMovies());

         
          require_once(VIEWS_PATH."validate-session.php");
          require_once(VIEWS_PATH."dashboard.php");
          
    }

    public function showMovieDetails ($id){
        if ($id){
            $movie =  $this->GetMovieById($id);
        }
        //$genreList = $this->dashboardDAO->GetGenres();
        $genreList = $this->dashboardDAO->readGenres();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."movieDetails.php");
    }

     public function showMoviesByGenre(){

        $query = $_SERVER["QUERY_STRING"];

        if($query){
             $idGenre = str_replace("url=Dashboard/showMoviesByGenre&", "", $query);
        }
        if($idGenre){
               $movieList = array();
               $movieList = $this->GetMoviesByGenre($idGenre);
               $genreList = $this->dashboardDAO->GetGenres();
          }
          require_once(VIEWS_PATH."validate-session.php");
          require_once(VIEWS_PATH."dashboard.php");
          
     }

     public function showMoviesByDate(){

        
        if($_GET && $_GET["date"]){
            $date = $_GET["date"];
        }
        if($date){
               $movieList = array();
               $movieList = $this->GetMoviesByDate($date);
               $genreList = $this->dashboardDAO->readGenres();

          }
          require_once(VIEWS_PATH."validate-session.php");
          require_once(VIEWS_PATH."dashboard.php");
          
     }

     public function searchMovie() {                                            
        
        $title = $_POST['title'];

        $movieList = array();
        $movieList = $this->dashboardDAO->getMovieByTitle($title);
        $genreList = $this->dashboardDAO->readGenres();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."dashboard.php");

      }

      public function GetMoviesByGenre($id){ // a adaptar a la db
          $movieGenreList = array();
          $movieList = array();
          $movieList = $this->dashboardDAO->GetAllMovies();
          foreach ($movieList as $movie){
              if (in_array($id,$movie->getGenreIds())){
                  array_push($movieGenreList, $movie);
              }
          }
          return $movieGenreList;
      }

    public function GetMoviesByDate($date){
        $movieGenreList = array();
        $movieList = array();
        $movieList = $this->dashboardDAO->readMovies();
        foreach ($movieList as $movie){
            if ($movie->getReleaseDate() == $date){
                array_push($movieGenreList, $movie);
            }
        }
        return $movieGenreList;
    }

    public function GetMovieByTitle($title){
        foreach ($this->movieList as $movie){
            if ($movie->getTitle() == $title){
                return $movie;
            }
        }
        return $this->movieList;
    }

    public function GetMovieById($id){
        if($id){
            $movieList = array();
            $movieList = $this->dashboardDAO->readMovies();
            $selected = "";
            if($movieList){
                foreach ($movieList as $movie){
                    if ($movie->getId() == $id){
                        $selected = $movie;
                    }
                }
                return $selected;
            }
        }
    }

    }