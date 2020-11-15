<?php
    namespace Controllers;

    use DAO\RequestDAO as RequestDAO;
    use DAO\ShowDAO as ShowDAO;
    Use Models\Movie as Movie;
    Use Models\Genre as Genre;
    

    

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
          //require_once(VIEWS_PATH."validate-session.php");
          require_once(VIEWS_PATH."dashboard.php");
     }

    public function showMovies(){
    
        $movieList = array();

           //$this->dashboardDAO->SaveGenresFromApi();
           //$this->dashboardDAO->SaveMoviesFromApi();

          //var_dump($this->dashboardDAO->getMovieById(1));

        $data = $this->dashboardDAO->readGenres();
        if ($data instanceof Genre) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
            $genreList = [];
            $genreList[0] = $data;
        }else{
            $genreList = $data;
        }
        $data2 = $this->dashboardDAO->readMoviesShow();
        if ($data2 instanceof Movie) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
            $movieList = [];
            $movieList[0] = $data2;
        }else{
            $movieList = $data2;
        }
        
        //require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."dashboard.php");
        
    }

    public function showMovieDetails ($id){
        if ($id){
            $movie =  $this->GetMovieById($id);
            $showInfoTicket = $this->showDAO->showInfoToGetTicket($id);
        }
        $data = $this->dashboardDAO->readGenres();
        if ($data instanceof Genre) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
            $genreList = [];
            $genreList[0] = $data;
        }else{
            $genreList = $data;
        }
        $data2 = $this->showDAO->showInfoToGetTicket($id);
        if (isset($data2['cinema_name'])) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
            $showInfoTicket = [];
            $showInfoTicket[0] = $data2;
        }else{
            $showInfoTicket = $data2;
        }
        //require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."movieDetails.php");
    }

     public function showMoviesByGenre($idGenre){

        if($idGenre){
               $movieList = array();
               $movieList = $this->GetMoviesByGenre($idGenre);
               $data = $this->dashboardDAO->readGenres();
               if ($data instanceof Genre) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
                    $genreList = [];
                    $genreList[0] = $data;
                }else{
                    $genreList = $data;
                }
               //require_once(VIEWS_PATH."validate-session.php");
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
               $data = $this->dashboardDAO->readGenres();
               if ($data instanceof Genre) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
                    $genreList = [];
                    $genreList[0] = $data;
                }else{
                    $genreList = $data;
                }
          }
          //require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."dashboard.php");  
    }

    public function searchMovie() {                                            
        
        $title = $_POST['title'];

        $movieList = array();
        $movieList = $this->dashboardDAO->getMovieByTitle($title);
        $data = $this->dashboardDAO->readGenres();
        if ($data instanceof Genre) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
            $genreList = [];
            $genreList[0] = $data;
        }else{
            $genreList = $data;
        }
        //require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."dashboard.php");

    }

    public function GetMoviesByGenre($id){ 
        $movieGenreList = array();
        $movieList = array();
        $movieList = $this->dashboardDAO->readMoviesShow();
        if(!empty($movieList)){
            foreach ($movieList as $movie){
                $movieId = $this->dashboardDAO->getMovieIdByInternId($movie->getId());
                $data = $this->dashboardDAO->GetGenreByMovieId($movieId);
                if ($data instanceof Genre) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
                    $genres = [];
                    $genres[0] = $data;
                }else{
                    $genres = $data;
                }
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
        $idList = $this->dashboardDAO->readMovieIdDateShow($date);
        $newIdArray = array();
        if(!empty($idList)){
            if(!(count($idList)===1)){
                foreach($idList as $id){
                    $trueId = $id['id_movie'];
                    array_push($newIdArray,$trueId);
                }
            }else{
                $newIdArray = $idList;
            }
        }
        if(!empty($movieList)){
        foreach ($movieList as $movie){
            $movieId = $movie->getMovieId();
            if (in_array($movieId,$newIdArray)){
                array_push($movieGenreList, $movie);
            }
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