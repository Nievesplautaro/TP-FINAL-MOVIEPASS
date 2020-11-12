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
                $date = $_POST['date'];
                $time = $_POST['time'];
                echo $date;
                echo $time;
               // $date->setTime($time->format('H'), $time->format('i'), $time->format('s'));
                //echo $date->format('Y-m-d H:i:s');
                $start_time = ($date.' ' .$time);
                echo $start_time;
                $newShow = new Show();
                
                if ($this->verifyDateAndCinema($id_room,$date,$time,$id_movie)){

                    $newShow->setRoom($this->roomDAO->read($id_room));
                
                    $newShow->setMovie($this->movieDAO->getMovieById($id_movie));
                    $newShow->setStartTime($start_time);

                    $this->showDAO->create($newShow);

                    echo '<script language="javascript">alert("Your Show Has Been Registered Successfully");</script>';
                }else{
                    $message = "Show Registered Successfully";
                    echo '<script language="javascript">alert("This cinema already has a show in this room at this time");</script>';
                }
                
            }
            $this->ShowMenuView();
            
        }

        public function verifyDateAndCinema($id_room, $date, $time, $id_movie){

            $movieShowList= $this->showDAO->GetAll();

            $cinemaID = $this->roomDAO->read($id_room)->getCinema()->getCinemaId();
            
            $movie = $this->movieDAO->getMovieById($id_movie);

            $movie_duration = ($movie->getDuration() + 15);

            $newStartTime=date_create($time);          

            $newEndTime = date_create($time);
            date_add($newEndTime,date_interval_create_from_date_string($movie_duration." minutes"));

            if($movieShowList == null){
                return true;
            }else{
                $uniqueCinemaPerDay = $this->verifyNoRepeatCinema($id_movie, $date);
                if ($uniqueCinemaPerDay == 0){
                    foreach ($movieShowList as $movieshow){

                        if(($movieshow->getRoom()->getRoomId() == $id_room ) && ($movieshow->getStartTime()->format('Y-m-d') == $date)){

                            $previousEndTime = date_create($movieshow->getStartTime()->format('H:i:s'));
                            $previousShowDuration = ($movieshow->getMovie()->getDuration() + 15);
                            date_add($previousEndTime,date_interval_create_from_date_string($previousShowDuration." minutes"));
                            
                            if(($movieshow->getStartTime()->format('H:i:s') <= $newEndTime) && ($previousEndTime >= $newStartTime)){
                                
                                $error = "02";//asignar valor se pisa con otro show en la misma sala
                                return false;
                                
                            }
                        }
                    }
                }

                return true;
            }
        
        }

        public function verifyNoRepeatCinema($id_movie, $date){
           
            foreach($movieShowList as $movieshow){

                if ($movieshow->getMovie()->getId() == $id_movie && $movieshow->getStartTime()->format('Y-m-d') == $date){
                    return 1; // there is already one movie today
                }else{
                    return 0; // no movie today
                }
            }

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
                    if($showList){
                    foreach($showList as $show){
                        $movie = $show->getMovie();
                        $show->setMovie($this->movieDAO->getMovieById($movie->getMovieId()));
                        $room = $show->getRoom();
                        $show->setRoom($this->roomDAO->read($room->getRoomId()));
                    }}
                }
            }
            
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."ShowManagment.php");
        }


        public function removeShow($id_show){
            require_once(VIEWS_PATH."validate-session.php");

            if($id_show){
                try{

                    $this->showDAO->deleteShow($id_show);
    
                }catch(\PDOException $ex){
                    throw $ex;
                } 
            }

            $this->ShowMenuView("");             
            
        }

        public function registerShow($id_cinema){
            if($id_cinema){
                // $id_cinema = $_POST['id_cinema'];
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