<?php
    namespace Controllers;

    use DAO\RequestDAO as RequestDAO;
    use DAO\ShowDAO as ShowDAO;
    Use Models\Movie as Movie;

    

    class DashboardController
    {
     private $dashboardDAO;
     private $showDAO;
     //private $movieListArray ;
        
     public function __construct(){
         //$this->movieListArray = array();
          $this->dashboardDAO = new RequestDAO();
          $this->showDAO = new ShowDAO();
     }

     public function ShowDashboardView($message = ""){
          //$movieList = $this->movieListArray;
          require_once(VIEWS_PATH."validate-session.php");
          require_once(VIEWS_PATH."dashboard.php");
     }

    public function showMovies(){
         
          $movieList = array();

           //$this->dashboardDAO->SaveGenresFromApi();
           //$this->dashboardDAO->SaveMoviesFromApi();

          //var_dump($this->dashboardDAO->getMovieById(1));

          $genreList = $this->dashboardDAO->readGenres();
          $movieList = $this->dashboardDAO->readMoviesShow();
          
         
          require_once(VIEWS_PATH."validate-session.php");
          require_once(VIEWS_PATH."dashboard.php");
          
    }

    public function showMovieDetails ($id){
        if ($id){
            $movie =  $this->GetMovieById($id);
            $showInfoTicket = $this->showDAO->showInfoToGetTicket($id);
        }
        $genreList = $this->dashboardDAO->readGenres();
        //var_dump($showInfoTicket);
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."movieDetails.php");
    }

     public function showMoviesByGenre($idGenre){

        if($idGenre){
               $movieList = array();
               $movieList = $this->GetMoviesByGenre($idGenre);
               $genreList = $this->dashboardDAO->readGenres();
               require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."dashboard.php");
        }
          
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

      public function GetMoviesByGenre($id){ 
        $movieGenreList = array();
        $movieList = array();
        $movieList = $this->dashboardDAO->readMoviesShow();
        if(!empty($movieList)){
            foreach ($movieList as $movie){
                $movieId = $this->dashboardDAO->getMovieIdByInternId($movie->getId());
                $genres = $this->dashboardDAO->GetGenreByMovieId($movieId);
                foreach ($genres as $genre){
                    if($id == $genre->getGenreId()){
                        array_push($movieGenreList, $movie);
                    }
                }
            }
        }
        return $movieGenreList;
      }

    public function GetMoviesByDate($date){
        $movieGenreList = array();
        $movieList = array();
        $movieList = $this->dashboardDAO->readMoviesShow();
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