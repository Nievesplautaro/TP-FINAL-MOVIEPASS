<?php
    namespace Controllers;
    use DAO\ShowDAO as ShowDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\RequestDAO as RequestDAO;
    Use Models\Show as Show;
    Use Models\Room as Room;
    Use Models\Movie as Movie;
    

    

    class ShowController
    {
        private $showDAO;
        private $roomDAO;
        private $movieDAO;
        
        public function __construct(){
            $this->showDAO = new ShowDAO();
            $this->roomDAO = new RoomDAO();
            $this->movieDAO = new RequestDAO();
            
        }

        public function ShowMenuView($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."menuAdmin.php");
        }
        public function ShowView($showId)
        {
            require_once(VIEWS_PATH."validate-session.php");
            if($showId){
                $show = $this->showDAO->read($showId);
            }
            require_once(VIEWS_PATH."showManagment.php");

        }
        public function register(){

            if($_POST){
                //echo $_POST['start_time'];
                $id_room = $_POST['id_room'];
                $id_movie = $_POST['id_movie'];
                $start_time = $_POST['start_time'];

                $newShow = new Show();
                
                $newShow->setRoom($this->roomDAO->read($id_room));
                
                $newShow->setMovie($this->movieDAO->getMovieById($id_movie));
                $newShow->setStartTime($start_time);

                //var_dump($newShow);

                $valid = $this->showDAO->create($newShow);
            
                /* ESTAS VALIDACIONES HAY QUE CAMBIARLAS, LAS VOY A POSPONER HASTA QUE NOS PONGAMOS DE ACUERDO */
                if ($valid === 0){
                    $message = "Show Name Already in Use";
                    echo '<script language="javascript">alert("Show Name In Use");</script>';
                }else{
                    $message = "Show Registered Successfully";
                    echo '<script language="javascript">alert("Your Show Has Been Registered Successfully");</script>';
                }
            }
            $this->ShowMenuView($message);
            
        }


        public function showCinemaShows(){
            if($_POST){
                $id_cinema = $_POST['id_cinema'];
                $data = $this->showDAO->read($id_cinema);
                if($data instanceof Show){
                    $movie = $data->getMovie();
                    $data->setMovie($this->movieDAO->getMovieById($movie->getMovieId()));
                    $room = $data->getRoom();
                    $data->setRoom($this->roomDAO->read($room->getRoomId()));
                    $showList = [];
                    $showList[0] = $data;
                }else{
                    $showList = $data;
                    foreach($showList as $show){
                        $movie = $show->getMovie();
                        $show->setMovie($this->movieDAO->getMovieById($movie->getMovieId()));
                        $room = $show->getRoom();
                        $show->setRoom($this->roomDAO->read($room->getRoomId()));
                    }
                }
            }
            
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."ShowManagment.php");
        }


        public function removeShow(){
            require_once(VIEWS_PATH."validate-session.php");

            if ($_GET){
                $showId = $_GET["showId"];
                $this->showDAO->deleteShow($showId);
                echo '<script language="javascript">alert("Your Show Has Been Deleted Successfully");</script>';  
            
            }

            $this->ShowMenuView("");            
            
        }

        public function registerShow(){
            if($_POST){
                $id_cinema = $_POST['id_cinema'];
                $data = $this->roomDAO->readRooms($id_cinema);
                $movieList = $this->movieDAO->readMovies();
                if ($data instanceof Room) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
                    $roomList = [];
                    $roomList[0] = $data;
                }else{
                    $roomList = $data;
                } 
            }
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerShow.php");
        }


    }
?>