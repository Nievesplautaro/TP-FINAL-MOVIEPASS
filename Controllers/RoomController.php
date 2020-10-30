<?php

    namespace Controllers;

    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Room as Room;

    class RoomController{

        private $roomDAO;


        public function __construct(){
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowEditView($cinemaName)
        {
            require_once(VIEWS_PATH."validate-session.php");
            if($cinemaName){
                $newCinema = new Cinema();
                $newCinema = $this->cinemaDAO->read($cinemaName);
                $id_cinema = $this->cinemaDAO->getCinemaIdByName($cinemaName);
            }
            require_once(VIEWS_PATH."editCinema.php");

        }

        public function ShowRegisterRoom($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerRoom.php");
        }

        public function showRooms(){
            $roomList = array();
            $roomList = $this->roomDAO->readRooms();
            $query = $_SERVER["QUERY_STRING"];

            if($query){
                $cinemaName = str_replace("url=Room/ShowRooms&name=", "", $query);
            }
            if($cinemaName){
                $cinema = $this->cinemaDAO->Read($cinemaName);
            }
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."roomManagment.php");
        }


        /*      ESTA FUNCION AGREGA UNA SALA A UN CINE */
        public function addRoom($cinemaName){
            require_once(VIEWS_PATH."validate-session.php");
                if($cinemaName){
                    $roomName = $_POST['room_name'];
                    $capacity = $_POST['capacity'];
                    $price = $_POST['price'];

                    $room = new Room($roomName, $capacity, $price);

                    $id_cinema = $this->cinemaDAO->getCinemaIdByName($cinemaName);
                    $this->roomDAO->create($id_cinema,$room);
                    /* ESTE SCRIPT SIRVE DE ALGO=? */
                    echo '<script language="javascript">alert("Your Room Has Been Added Successfully");</script>';  
                }
            $this->showRooms(); 
        }
        
        public function Delete(){

            $query = $_SERVER["QUERY_STRING"];

            if($query){
                $room_name = str_replace("url=Room/Delete&", "", $query);
            }
            if($room_name){
                $room = $this->roomDAO->read($room_name);
                try{

                    $this->roomDAO->Delete($room);
    
                }catch(\PDOException $ex){
                    throw $ex;
                } 
            }
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."roomManagment.php");
        
        }

        private function TransformToArray($value){
            
            if ($value == false){
                $value = array();
            }
    
            if (!is_array($value)){
                $value = array($value);
            }
    
            return $value;
    
        }

    }

?>