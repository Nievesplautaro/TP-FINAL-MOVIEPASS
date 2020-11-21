<?php
    namespace Controllers;
    use DAO\ShowDAO as ShowDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\RequestDAO as RequestDAO;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Show as Show;
    Use Models\Room as Room;
    Use Models\Movie as Movie;
    Use Models\Cinema as Cinema;
    

    

    class ShowController
    {
        private $showDAO;
        private $roomDAO;
        private $movieDAO;
        private $cinemaDAO;
        
        public function __construct(){
            $this->showDAO = new ShowDAO();
            $this->roomDAO = new RoomDAO();
            $this->movieDAO = new RequestDAO();
            $this->cinemaDAO = new CinemaDAO();
            
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
                //PRUEBEN LAS COSAS PADRE, NUNCA LE PASABAN LA HORA AL SHOW, POR ESO AGREGUE LOS DOS DE ABAJO
                $date = $_POST['date'];
                $time = $_POST['time'];
                
                if($date && $time){
                    $start_time = $date.' '.$time;
                }

                $newShow = new Show();

                $newShow->setRoom($this->roomDAO->read($id_room));
                
                $newShow->setMovie($this->movieDAO->getMovieById($id_movie));
                $newShow->setStartTime($start_time);

                $this->showDAO->create($newShow);

                echo '<script language="javascript">alert("Your Show Has Been Registered Successfully");</script>';
                
                /*if ($this->verifyDate($id_room,$start_time,$id_movie)){

                    $newShow->setRoom($this->roomDAO->read($id_room));
                
                    $newShow->setMovie($this->movieDAO->getMovieById($id_movie));
                    $newShow->setStartTime($start_time);

                    $this->showDAO->create($newShow);

                    echo '<script language="javascript">alert("Your Show Has Been Registered Successfully");</script>';
                }else{
                    echo '<script language="javascript">alert("This cinema already has a show in this room at this time");</script>';
                }*/
                
            }
            $this->ShowMenuView();
            
        }

        public function verifyDateAndCinema($id_room, $date, $time, $id_movie){

            $movieShowList= $this->showDAO->GetAll();

            $cinemaID = $this->cinemaDAO->readCinemaIdByRoomId($id_room);
            
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
                    // var_dump($movieShowList);
                    foreach ($movieShowList as $movieshow){
                        
                        $movieShowDateTime = date_create($movieshow->getStartTime());
                        
                        if(($movieshow->getRoom()->getRoomId() == $id_room ) && (date_format($movieShowDateTime,'Y-m-d') == $date)){

                            $previousEndTime = date_create(date_format($movieShowDateTime, 'H:i:s'));
                            $previousShowDuration = ($movieshow->getMovie()->getDuration() + 15);
                            date_add($previousEndTime,date_interval_create_from_date_string($previousShowDuration." minutes"));
                            
                            if((date_format($movieShowDateTime, 'H:i:s') <= $newEndTime) && ($previousEndTime >= $newStartTime)){
                                
                                $error = "02";//asignar valor se pisa con otro show en la misma sala
                                return false;
                                
                            }
                        }
                    }

                    return true;
                }else{
                    echo '<script language="javascript">alert("The movie has a show in this or other cinema today");</script>';
                    return false;
                }      
            }
        
        }

        public function verifyNoRepeatCinema($id_movie, $date){
            $flag = 0;
            $movieShowList2= $this->showDAO->GetAll();

            foreach($movieShowList2 as $movieshow){
                $movieShowDateTime2 = date_create($movieshow->getStartTime());
                if (($movieshow->getMovie()->getMovieId() == $id_movie) && (date_format($movieShowDateTime2, "Y-m-d") == $date)){     
                    $flag = 1; // there is already one movie today
                }
            }
            return $flag;
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