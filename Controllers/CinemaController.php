<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Cinema as Cinema;

    

    class CinemaController
    {
        private $cinemaDAO;
        
        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowMenuView($message = "")
        {
            require_once(VIEWS_PATH."menuCinema.php");
        }
        public function ShowCinemaView($message = "")
        {
            require_once(VIEWS_PATH."mainCinema.php");
        }
        public function registerCinema($message = "")
        {
            require_once(VIEWS_PATH."registerCinema.php");
        }

        
        public function register(){
            
            $name = $_POST['name'];
            $phoneNumber = $_POST['phoneNumber'];
            $ticketPrice = $_POST['ticketPrice'];
            $address = $_POST['address'];
            $capacity = $_POST['capacity'];
            $show = $_POST['show'];

            $newCinema = new Cinema();
        
            $newCinema->setName($name);
            $newCinema->setPhoneNumber($phoneNumber);
            $newCinema->setTicketPrice($ticketPrice);
            $newCinema->setAddress($address);
            $newCinema->setCapacity($capacity);
            $newCinema->setShow($show);
        
            $newCinemaRepository = new CinemaDAO();
            $valid = $newCinemaRepository->Add($newCinema);
        
            if ($valid === 0){
                $message = "Cinema Name Already in Use";
                echo '<script language="javascript">alert("Cinema Name In Use");</script>';
            }else{
                $message = "Cinema Registered Successfully";
                echo '<script language="javascript">alert("Your Cinema Has Been Registered Successfully");</script>';
            }
            $this->ShowCinemaView($message);
        
        }

    }
?>