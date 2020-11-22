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
    use controllers\EmailController as EmailController;

    

    

    class TicketController
    {
        private $ticketDAO;
        private $showDAO;
        private $EmailController;
        private $cinemaDAO;
        private $roomDAO;  
        private $userDAO;  
        
        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->showDAO = new ShowDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
            $this->userDAO = new UserDAO();
            $this->EmailController = new EmailController();
        }

        public function checkPurchase () {
            if(!isset($_SESSION["loggedUser"])){
                $returnTO =  $_SERVER['HTTP_REFERER'];
                setcookie ("ReturnTo", $returnTO, time()+3600, '/', NULL, 0 );  
                var_dump ($_COOKIE['ReturnTo']);
                $error = "Por favor, ingrese con sus datos para poder continuar con la compra";
                header('location:../User/Logme');
            }
        }

        public function selectQuantity() {
            require_once(VIEWS_PATH."validate-session.php");
            if($_POST){
                $id_show = $_POST['id_show'];
                $roomPrice = $this->ticketDAO->getRoomPriceByShowId($id_show);
                $roomCapacity = $this->roomDAO->getRoomCapacityByShowId($id_show);
                $ticketsPurchased = $this->ticketDAO->getTicketsPurchaseByShowId($id_show);
                require_once(VIEWS_PATH."ticketQuantity.php");
            }
        }

        public function purchaseTicket(){
            require_once(VIEWS_PATH."validate-session.php");
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
            require_once(VIEWS_PATH."validate-session.php");
            if($_POST){
                $id_show = $_POST['id_show'];
                $quantity = $_POST['quantity'];
                $ticket_price = $_POST['ticket_price'];
                
                $user = new User();
                $user = $_SESSION['loggedUser'];
                $id_user = $this->userDAO->getIdByUserName($user->getEmail());
                if($id_show){
                    $show = $this->showDAO->getShowById($id_show);
                }
                
                /*echo $quantity;
                echo $ticket_price;*/

                

                for($i = 0; $i < $quantity; $i++){
                    $ticket = new Ticket();
                    $ticket->setIdUser($id_user);
                    $ticket->setIdShow($id_show);
                    $ticket->setPrice($ticket_price);
                    $this->ticketDAO->create($ticket);
                }

                $this->EmailController->sendTicketPurchase($user,$show);
                
            }
            //require_once(VIEWS_PATH."menu.php");
            header('location:../Home/Index');
        }


        public function showMyTickets(){
            require_once(VIEWS_PATH."validate-session.php");
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