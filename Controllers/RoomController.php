<?php

    namespace Controllers;

    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Room as Room;

    class RoomController{

        private $roomDAO;
        private $cinemaDAO;


        public function __construct(){
            require_once(VIEWS_PATH."validate-session.php");
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
                $room = $this->roomDAO->read($id_room);
                $id_room = $room->getRoomId();
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
                } 
                } 
            } 
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."roomManagment.php");
        }


        /*      ESTA FUNCION AGREGA UNA SALA A UN CINE */
        public function addRoom(){
                if($_POST){
                    try{
                        $id_cinema = $_POST['id_cinema'];
                        $roomName = $_POST['room_name'];
                        $capacity = $_POST['capacity'];
                        $price = $_POST['price'];
                        $cinema = $this->cinemaDAO->getCinemaById($id_cinema);
                        if(!$this->roomExists($id_cinema, $roomName)){
                            $room = new Room();
                            $room->setRoomName($roomName);
                            $room->setCapacity($capacity);
                            $room->setPrice($price);
                            $room->setRoomId(0);
                            $room->setCinema($cinema);
                            $this->roomDAO->create($room);
                            require_once(VIEWS_PATH."validate-session.php");
                            $this->showRooms($id_cinema);
                        }else{
                            $error = "01";
                            require_once(VIEWS_PATH."registerRoom.php");
                        }
                        
                    }catch(\PDOExeption $ex){
                        throw $ex; 
                    }    
                }
        }

        public function editRoom(){
            if ($_POST){
                    $id_cinema = $_POST['id_cinema'];
                    $id_room = $_POST['id_room'];
                    $room_name = $_POST['room_name'];
                    $capacity = $_POST['capacity'];
                    $price = $_POST['price'];

                    $room = new Room();
                            
                    $room->setRoomName($room_name);
                    $room->setCapacity($capacity);
                    $room->setPrice($price);

                    if(!$this->roomExists($id_cinema, $room_name)){
                        
                        $this->roomDAO->editRoom($id_room,$room);
                        
                        $this->showRooms($id_cinema);
                    }else{
                        $error = "01";
                        require_once(VIEWS_PATH."editRoom.php");
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
        public function roomExists($id_cinema,$roomName){

            $roomDAO = new RoomDAO();

            try{
                if($roomDAO->readByName($id_cinema, $roomName)){
                    return true;
                }else{
                    return false;
                }
                
            }catch(\PDOException $ex){
                throw $ex;
            }
        }

    }

?>