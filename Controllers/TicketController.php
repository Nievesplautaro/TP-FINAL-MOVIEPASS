<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Cinema as Cinema;
    use DAO\RoomDAO as RoomDAO;
    Use Models\Room as Room;
    use DAO\ShowDAO as ShowDAO;
    Use Models\Show as Show;
    use DAO\TicketDAO as TicketDAO;
    Use Models\Ticket as Ticket;
    

    

    class TicketController
    {
        private $ticketDAO;
        private $showDAO;
        private $cinemaDAO;    
        
        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->showDAO = new ShowDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
            
        }

        public function selectQuantity() {
            if($_POST){
                $id_show = $_POST['id_show'];
                echo $id_show;
                $roomPrice = $this->ticketDAO->getRoomPriceByShowId($id_show);
                require_once(VIEWS_PATH."ticketQuantity.php");
            }
        }

        public function purchaseTicket(){
            if($_POST){
                $quantity = $_POST['quantity'];
                $id_show = $_POST['id_show'];
                $room_price = $_POST['room_price'];
                
                $show = new Show();
                $show = $this->showDAO->getShowById($id_show);
                //var_dump($show);

                require_once(VIEWS_PATH."registerTicket.php");
            }

        }

        public function registerTicket(){
            if($_POST){
                $id_show = $_POST['id_show'];
                echo $id_show;
            }
            require_once(VIEWS_PATH."dashboard.php");
        }


        public function showMyTickets(){
            $data = $this->ticketDAO->readTickets();
             if ($data instanceof Ticket) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE TICKETS O UN TICKET SOLO */
                $ticketList = [];
                $ticketList[0] = $data;
            }else{
                $ticketList = $data;
            } 
            //require_once(VIEWS_PATH."validate-session.php");
            if(!isset($_SESSION["loggedUser"])){
                header('location:../User/Logme');  
            }else{
                require_once(VIEWS_PATH."ticketsManagment.php");
            }
        }


    }
?>