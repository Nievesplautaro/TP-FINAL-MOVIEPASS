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
        public function ShowRegisterView($cinemaId)
        {
            require_once(VIEWS_PATH."validate-session.php");
            if($cinemaId){
                $cinema = $this->cinemaDAO->read($cinemaId);
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
                $this->ShowMenuView($message);
            }else{
                $message = "Cinema Registered Successfully";
                echo '<script language="javascript">alert("Your Cinema Has Been Registered Successfully");</script>';
                header("location:showCinemas");
            }
        }


        public function showCinemas(){
            $data = $this->cinemaDAO->readCinemas();
             if ($data instanceof Cinema) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
                $cinemaList = [];
                $cinemaList[0] = $data;
            }else{
                $cinemaList = $data;
            } 
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."cinemaManagment.php");
        }

        public function removeCinema($cinemaId){
            require_once(VIEWS_PATH."validate-session.php");

            if ($cinemaId && !empty($cinemaId)){
                $this->cinemaDAO->deleteCinema($cinemaId);
                echo '<script language="javascript">alert("Your Cinema Has Been Deleted Successfully");</script>';      
            }

            $this->ShowMenuView("");            
            
        }

        public function editCinema(){
            require_once(VIEWS_PATH."validate-session.php");
                if ($_POST){
                        
                        $name = $_POST['name'];
                        $phoneNumber = $_POST['phoneNumber'];
                        $address = $_POST['address'];
                        $id  = $_POST["id_cine"];

                        $editCinema = new Cinema();
                        $newDAO = new cinemaDAO();
                        $editCinema->setName($name);
                        $editCinema->setPhoneNumber($phoneNumber);
                        $editCinema->setAddress($address);
                        $newDAO->editCinema($id,$editCinema);
                        
                        echo '<script language="javascript">alert("Your Cinema Has Been Edited Successfully");</script>';  
                    }
            $this->ShowMenuView("");  
        }

        public function registerShow(){
            $data = $this->cinemaDAO->readCinemas();
             if ($data instanceof Cinema) { /* ESTE IF CHEQUEA SI EL READ RETORNA UN ARRAY DE CINES O UN CINE SOLO */
                $cinemaList = [];
                $cinemaList[0] = $data;
            }else{
                $cinemaList = $data;
            } 
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."SelectCinema.php");
        }

    }
?>