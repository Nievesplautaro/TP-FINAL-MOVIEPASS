<?php

    namespace Controllers;

    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Room as Room;

    class RoomController{

        private $roomDAO;
        private $cinemaDAO;


        public function __construct(){
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowEditView($id_cinema)
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."editRoom.php");

        }

        public function ShowRegisterRoom($id_cinema)
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerRoom.php");
        }

        public function ShowEditRoom($id_cinema, $id_room){
            require_once(VIEWS_PATH."validate-session.php");
            if($id_room){
                $room = $this->roomDAO->readRooms($id_cinema);
            }
            require_once(VIEWS_PATH."editRoom.php");
        }

        public function showRooms($id_cinema){
            $data = $this->roomDAO->readRooms($id_cinema);
            if ($data instanceof Room) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE Room O UN Room SOLO */
                $data->setCinema($this->cinemaDAO->read($id_cinema));
                $roomList = [];
                $roomList[0] = $data;
            }else{
                $roomList = $data;
                if($data){
                foreach($roomList as $room){
                    $room->setCinema($this->cinemaDAO->read($id_cinema));
                } } 
            } 
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."roomManagment.php");
        }


        /*      ESTA FUNCION AGREGA UNA SALA A UN CINE */
        public function addRoom(){
                if($_POST){
                    $id_cinema = $_POST['id_cinema'];
                    $roomName = $_POST['room_name'];
                    $capacity = $_POST['capacity'];
                    $price = $_POST['price'];
                    $cinema = $this->cinemaDAO->getCinemaById($id_cinema);

                    $room = new Room();
                    $room->setRoomName($roomName);
                    $room->setCapacity($capacity);
                    $room->setPrice($price);
                    $room->setRoomId(0);
                    $room->setCinema($cinema);
                    $this->roomDAO->create($room);
                    /* ESTE SCRIPT SIRVE DE ALGO=? */
                    echo '<script language="javascript">alert("Your Room Has Been Added Successfully");</script>';  
                    require_once(VIEWS_PATH."validate-session.php");
                    $this->showRooms($id_cinema);
                }
        }

        public function editRoom($id_cinema, $id_room){
            if($id_room){
                echo $id_room;
                if ($_POST){
                        
                    $room_name = $_POST['room_name'];
                    $capacity = $_POST['capacity'];
                    $price = $_POST['price'];

                    if($this->roomDAO->readByName($room_name) == 0){

                        $room = new Room();
                        
                        $room->setRoomName($room_name);
                        $room->setCapacity($capacity);
                        $room->setPrice($price);
                        

                        $this->roomDAO->editRoom($id_room,$room);
                        
                        $this->showRooms($id_cinema);
                        //header("location:showCinemas");

                }else{
                    // manejar error en pantalla
                    require_once(VIEWS_PATH."menuAdmin.php");
                } 
            }
        }
    }
        
        public function Delete($id_cinema,$id_room){
            if($id_room){
                try{

                    $this->roomDAO->Delete($id_room);
    
                }catch(\PDOException $ex){
                    throw $ex;
                } 
            }
            $this->showRooms($id_cinema);
        
        }

        /**
        * Chequea el room por el nombre
        */
        public function CinemaExists($roomName){

            $roomDAO2 = new CinemaDAO();

            try{
                if($roomDAO2->readByName($roomName)){
                    
                    $error = "02";
                
                    return $error;
                }else{
                    return false;
                }
                
            }catch(\PDOException $ex){
                throw $ex;
            }
        }

    }

?>