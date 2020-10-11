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
          require_once(VIEWS_PATH."dashboard.php");
     }

     public function showMovies(){
          $movieList = array();
          $movieList = $this->dashboardDAO->GetAllMovies();
          $genreList = $this->dashboardDAO->GetGenres();
          
          require_once(VIEWS_PATH."dashboard.php");
          
          /*$this->movieListArray = $this->dashboardDAO->GetAllMovies();
          $this->ShowDashboardView();*/

          //return $movieList;
     }



    }