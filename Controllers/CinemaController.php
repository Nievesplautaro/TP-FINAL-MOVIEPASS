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
            
            try{

                $name = $_POST['name'];
                $phoneNumber = $_POST['phoneNumber'];
                $address = $_POST['address'];

                if(!$this->CinemaExists($name, $address)){

                        $newCinema = new Cinema();
        
                        $newCinema->setName($name);
                        $newCinema->setPhoneNumber($phoneNumber);
                        $newCinema->setAddress($address);

                        $this->cinemaDAO->create($newCinema);

                        header("location:showCinemas");

                }else{
                    $error = $this->CinemaExists($name, $address);
                    require_once(VIEWS_PATH."registerCinema.php");
                }
            }catch(\PDOExeption $ex){
                throw $ex; 
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
                $error = "04";     
            }else{
                $error = "05";
            }

            $this->showCinemas("");            
            
        }

        public function editCinema(){
            require_once(VIEWS_PATH."validate-session.php");
                if ($_POST){
                        
                        $name = $_POST['name'];
                        $phoneNumber = $_POST['phoneNumber'];
                        $address = $_POST['address'];
                        $id  = $_POST["id_cine"];

                        if(!$this->CinemaExists($name, $address)){

                            $editCinema = new Cinema();
                            
                            $editCinema->setName($name);
                            $editCinema->setPhoneNumber($phoneNumber);
                            $editCinema->setAddress($address);
    
                            $this->cinemaDAO->editCinema($id,$editCinema);
    
                            header("location:showCinemas");
    
                    }else{
                        $error = $this->CinemaExists($name, $address);
                        require_once(VIEWS_PATH."menuAdmin.php");
                    } 
                }
        }

        /**
        * Chequea el cine por el nombre
        */
        public function CinemaExists($cinemaName, $address){

            $cinemaDAO2 = new CinemaDAO();

            try{
                if($cinemaDAO2->readByName($cinemaName) or $cinemaDAO2->readByAddress($address)){
                    if ($cinemaDAO2->readByAddress($address)){
                        $error = "03";
                    }else{
                        $error = "02";
                    } 
                    return $error;
                }else{
                    return false;
                }
                
            }catch(\PDOException $ex){
                throw $ex;
            }
        }

    }
?>