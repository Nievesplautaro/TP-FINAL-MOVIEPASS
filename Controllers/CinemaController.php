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
            require_once(VIEWS_PATH."menuAdmin.php");
        }
        public function ShowRegisterView($cinemaName)
        {
            require_once(VIEWS_PATH."validate-session.php");
            if($cinemaName){
                $newCinema = new Cinema();
                $newCinema = $this->cinemaDAO->read($cinemaName);
                $id_cinema = $this->cinemaDAO->getCinemaIdByName($cinemaName);
            }
            require_once(VIEWS_PATH."editCinema.php");

        }

        public function registerCinema($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerCinema.php");
        }

        
        public function register(){
            
            $name = $_POST['name'];
            $phoneNumber = $_POST['phoneNumber'];
            $address = $_POST['address'];

            $newCinema = new Cinema();
        
            $newCinema->setName($name);
            $newCinema->setPhoneNumber($phoneNumber);
            $newCinema->setAddress($address);

            $valid = $this->cinemaDAO->create($newCinema);
        
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
            $cinemaList = $this->cinemaDAO->readCinemas();
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
                $id_cinema = str_replace("url=Cinema/editCinema&", "", $query);
            }
            if($id_cinema){
                    if ($_POST){
                        
                        $name = $_POST['name'];
                        $phoneNumber = $_POST['phoneNumber'];
                        $address = $_POST['address'];

                        $editCinema = new Cinema();
                        $newDAO = new cinemaDAO();
                        $editCinema->setName($name);
                        $editCinema->setPhoneNumber($phoneNumber);
                        $editCinema->setAddress($address);
                        $newDAO->editCinema($id_cinema,$editCinema);
                        
                        echo '<script language="javascript">alert("Your Cinema Has Been Edited Successfully");</script>';  
                    
                    }
            }
            $this->ShowMenuView("");  
        }



    }
?>