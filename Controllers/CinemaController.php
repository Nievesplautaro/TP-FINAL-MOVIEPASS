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
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."menuCinema.php");
        }
        public function ShowRegisterView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $query = $_SERVER["QUERY_STRING"];


            if($query){
                $query = urldecode($query);
                $name = str_replace("url=Cinema/ShowRegisterView&", "", $query);
                $newCinema = new Cinema();
                $newCinema = $this->cinemaDAO->GetCinemaByName($name);
            }

            require_once(VIEWS_PATH."editCinema.php");

        }
/*         public function ShowCinemaView($message = "")
        {
            require_once(VIEWS_PATH."mainCinema.php");
        } */
        public function registerCinema($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerCinema.php");
        }

        
        public function register(){
            
            $name = $_POST['name'];
            $phoneNumber = $_POST['phoneNumber'];
            $ticketPrice = $_POST['ticketPrice'];
            $address = $_POST['address'];
            $capacity = $_POST['capacity'];
            /* $show = $_POST['show']; */

            $newCinema = new Cinema();
        
            $newCinema->setName($name);
            $newCinema->setPhoneNumber($phoneNumber);
            $newCinema->setTicketPrice($ticketPrice);
            $newCinema->setAddress($address);
            $newCinema->setCapacity($capacity);
            /* $newCinema->setShow($show); */
            $newCinema->setShow(array());
            $valid = $this->cinemaDAO->Add($newCinema);
        
            if ($valid === 0){
                $message = "Cinema Name Already in Use";
                echo '<script language="javascript">alert("Cinema Name In Use");</script>';
            }else{
                $message = "Cinema Registered Successfully";
                echo '<script language="javascript">alert("Your Cinema Has Been Registered Successfully");</script>';
            }
            $this->ShowMenuView($message);
        
        }


        public function showCinemas(){
            $cinemaList = array();
            $cinemaList = $this->cinemaDAO->GetAllCinemas();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."cinemaManagment.php");
        }

        public function removeCinema(){
            require_once(VIEWS_PATH."validate-session.php");

            if ($_GET){
                $name = $_GET["name"];
                $this->cinemaDAO->removeCinema($name);
                echo '<script language="javascript">alert("Your Cinema Has Been Deleted Successfully");</script>';  
            
            }

            $this->ShowMenuView("");            
            
        }

        public function editCinema(){
            require_once(VIEWS_PATH."validate-session.php");



            $query = $_SERVER["QUERY_STRING"];

            if($query){
                    $query = urldecode($query);
                    $cinemaToReplace = str_replace("url=Cinema/editCinema&", "", $query);

                    if ($_POST){
                        $name = $_POST['name'];
                        $phoneNumber = $_POST['phoneNumber'];
                        $ticketPrice = $_POST['ticketPrice'];
                        $address = $_POST['address'];
                        $capacity = $_POST['capacity'];


                        $editCinema = new Cinema();
        
                        $editCinema->setName($name);
                        $editCinema->setPhoneNumber($phoneNumber);
                        $editCinema->setTicketPrice($ticketPrice);
                        $editCinema->setAddress($address);
                        $editCinema->setCapacity($capacity);

                        $this->cinemaDAO->editCinema($cinemaToReplace,$editCinema);

                        echo '<script language="javascript">alert("Your Cinema Has Been Edited Successfully");</script>';  
                    
                    }

            }

            $this->ShowMenuView(""); 
                
        }
    }
?>