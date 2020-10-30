
<?php
    namespace Controllers;
    use DAO\RoomDAO as RoomDAO;
    Use Models\Room as Room;

    class RoomController{
        private $roomDAO;


        public function __construct(){
            $this->roomDAO = new RoomDAO();
        }




        /*      ESTA FUNCION AGREGA UNA SALA A UN CINE */
        public function addRoom($cinemaName){
            require_once(VIEWS_PATH."validate-session.php");
                if($cinemaName){
                    $roomName = $_POST['roomName'];
                    $capacity = $_POST['capacity'];
                    $price = $_POST['price'];

                    $room = new Room();

                    $room->setRoomName($roomName);
                    $room->setCapacity($capacity);
                    $room->setPrice($price);
                    $id_cinema = $this->cinemaDAO->getCinemaIdByName($cinemaName);
                    $this->roomDAO->create($id_cinema,$room);
                    /* ESTE SCRIPT SIRVE DE ALGO=? */
                    echo '<script language="javascript">alert("Your Room Has Been Added Successfully");</script>';  
                }
            $this->ShowMenuView(""); 
        }
        
    }