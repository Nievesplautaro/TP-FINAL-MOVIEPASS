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
          $movieList = $this->dashboardDAO->GetAllMovies();
          $genreList = $this->dashboardDAO->GetGenres();
          require_once(VIEWS_PATH."validate-session.php");
          require_once(VIEWS_PATH."dashboard.php");
          
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

     public function searchMovie() {                                            
          
        $title = $_POST['title'];

        $movieList = array();
        $movieList = $this->dashboardDAO->getMovieByTitle($title);
        $genreList = $this->dashboardDAO->GetGenres();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."dashboard.php");

      }

      public function GetMoviesByGenre($id){
          echo $id;
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

      public function GetMovieByTitle($title){
          foreach ($this->movieList as $movie){
              if ($movie->getTitle() == $title){
                  return $movie;
              }
          }
          return $this->movieList;
      }

    }