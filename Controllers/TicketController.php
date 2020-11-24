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
    use Models\Movie as Movie;
    use DAO\RequestDAO as MovieDAO;
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
            $this->movieDAO = new MovieDAO();
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

                if(isset($quantity) && isset($room_price) && $quantity >=2){
                    $date = getdate();
                    if($date['weekday'] == 'Tuesday' || $date['weekday'] == 'Wednesday'){
                        $discount = ($quantity * $room_price)*0.25;
                    }
                }

                $total = $quantity * $room_price;
                if(isset($discount)){
                    $total = $total - $discount;
                    $room_price= $room_price-$room_price*0.25;
                }
                
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
                $qrArray = $_POST;
                $this->EmailController->sendTicketPurchase($user,$show,$qrArray);
                
            }
            //require_once(VIEWS_PATH."menu.php"); 
            header('location:../Home/Index');
        }


        public function showMyTickets(){
            require_once(VIEWS_PATH."validate-session.php");
            $user = new User();
            $user = $_SESSION['loggedUser'];
            $id_user = $this->userDAO->getIdByUserName($user->getEmail());
            $data = $this->ticketDAO->getTicketByUserId($id_user);
             if ($data instanceof Ticket) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE TICKETS O UN TICKET SOLO */
                $ticketList = [];
                $ticketList[0] = $data;
            }else{
                $ticketList = $data;
            } 

            if(!empty($ticketList)){
                foreach($ticketList as $ticket){
                    $idShow = $ticket->getIdShow();
                    if(isset($idShow)){
                        $instanceShow = $this->showDAO->getShowById($idShow);
                        if($instanceShow){
                            $ticket->setShow($instanceShow);
                        }
                    }
                }
            }
            //require_once(VIEWS_PATH."validate-session.php");
            if(!isset($_SESSION["loggedUser"])){
                header('location:../User/Logme');  
            }else{
                require_once(VIEWS_PATH."ticketsManagment.php");
            }
        }

        public function moneyByCinema($id_cinema){
            require_once(VIEWS_PATH."validate-session.php");
            if(isset($id_cinema)){
                $total = $this->ticketDAO->getAmountCollectedByCinemaId($id_cinema);
                $cinema = $this->cinemaDAO->read($id_cinema);
            }
            require_once(VIEWS_PATH."earningsCinema.php");
        }

        

        public function selectMovie(){
            require_once(VIEWS_PATH."validate-session.php");
            $movieList = $this->movieDAO->readMovies();
            require_once(VIEWS_PATH."selectMovie.php");
        }
    

        public function moneyByMovie($id_movie){
            require_once(VIEWS_PATH."validate-session.php");
            if(isset($id_movie)){
                $total = $this->ticketDAO->getAmountCollectedByMovieId($id_movie);
                $movie = $this->movieDAO->getMovieById($id_movie);
            }
            require_once(VIEWS_PATH."earningsMovie.php");
        }
    }
?>