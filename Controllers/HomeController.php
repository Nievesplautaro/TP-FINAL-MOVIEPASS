<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\RequestDAO as RequestDAO;
    Use Models\User as User;

    class HomeController
    {

        private $userDAO;
        private $dashboardDAO;
        
        public function __construct(){
            $this->userDAO = new UserDAO();
            $this->dashboardDAO = new RequestDAO();
        }


        public function Index($message = "")
        {
            $showList = array();
            $showList = $this->dashboardDAO->readMoviesShow();
            $lastshows = array();
            if(!empty($showList)){
                foreach($showList as $key=>$show) {
                    if($key<10){
                        array_push($lastshows, $show);
                    }
                }
            }
            //require_once(VIEWS_PATH."main.php");
            require_once(VIEWS_PATH."menu.php");
        }
    }
?>