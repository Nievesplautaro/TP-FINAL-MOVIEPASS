<?php
    namespace Controllers;
    Use Models\User as User;
    Use DAO\UserDAO as UserDAO;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Cinema as Cinema;
    use DAO\RoomDAO as RoomDAO;
    Use Models\Room as Room;
    use DAO\ShowDAO as ShowDAO;
    Use Models\Show as Show;
    use DAO\TicketDAO as TicketDAO;
    use Models\Ticket as Ticket;
    

    

    class TicketController
    {
        private $ticketDAO;
        private $showDAO;
        private $cinemaDAO;
        private $roomDAO;  
        private $userDAO;  
        
        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->showDAO = new ShowDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
            $this->userDAO = new UserDAO();
            
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
                $quantity = $_POST['quantity'];
                $ticket_price = $_POST['ticket_price'];
                
                $user = new User();
                $user = $_SESSION['loggedUser'];
                var_dump($user);
                $id_user = $this->userDAO->getIdByUserName($user->getEmail());
                
                echo $id_user;
                /*echo $quantity;
                echo $ticket_price;*/

                

                for($i = 0; $i < $quantity; $i++){
                    $ticket = new Ticket();
                    $ticket->setIdUser($id_user);
                    $ticket->setIdShow($id_show);
                    $ticket->setPrice($ticket_price);
                    $this->ticketDAO->create($ticket);
                }
                
            }
            require_once(VIEWS_PATH."menu.php");
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