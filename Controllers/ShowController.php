<?php
    namespace Controllers;
    use DAO\ShowDAO as ShowDAO;
    Use Models\Show as Show;
    

    

    class ShowController
    {
        private $ShowDAO;
        
        public function __construct(){
            $this->showDAO = new ShowDAO();
            
        }

        public function ShowMenuView($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."menuAdmin.php");
        }
        public function ShowView($showId)
        {
            require_once(VIEWS_PATH."validate-session.php");
            if($showId){
                $show = $this->ShowDAO->read($showId);
            }
            require_once(VIEWS_PATH."showManagment.php");

        }

        public function registerShow($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerShow.php");
        }

        
        public function register(){
            
            $id_room = $_POST['id_room'];
            $id_movie = $_POST['id_movie'];
            $start_time = $_POST['start_time'];

            $newShow = new Show();
            $newShow->setRoomId($id_room);
            $newShow->setMovieId($id_movie);
            $newShow->setStartTime($start_time);

            $valid = $this->showDAO->create($newShow);
        
            /* ESTAS VALIDACIONES HAY QUE CAMBIARLAS, LAS VOY A POSPONER HASTA QUE NOS PONGAMOS DE ACUERDO */
            if ($valid === 0){
                $message = "Show Name Already in Use";
                echo '<script language="javascript">alert("Show Name In Use");</script>';
            }else{
                $message = "Show Registered Successfully";
                echo '<script language="javascript">alert("Your Show Has Been Registered Successfully");</script>';
            }
            $this->ShowMenuView($message);
        
        }


        public function showCinemaShows($id_cinema){
            $showList = array();
            $showList = $this->showDAO->read($id_cinema);
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."ShowManagment.php");
        }

        public function removeShow(){
            require_once(VIEWS_PATH."validate-session.php");

            if ($_GET){
                $showId = $_GET["showId"];
                $this->showDAO->deleteShow($showId);
                echo '<script language="javascript">alert("Your Show Has Been Deleted Successfully");</script>';  
            
            }

            $this->ShowMenuView("");            
            
        }

    }
?>