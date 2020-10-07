<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    Use Models\User as User;

    class UserController
    {
        private $userDAO;
        
        public function __construct(){
            $this->$userDAO = new UserDAO();
        }


        public function login()
        {
            
            $userList = $userDAO->GetAll();


            if($_POST){
                $userName = $_POST['email'];
                $password = $_POST['password'];
                $count = 0;

                foreach($userList as $user){
                    if(($user -> getEmail() == $userName) && ($user -> getPassword() == $password)){

                        $count = 1;
                            session_start();

                        $loggedUser = new User();
                        $loggedUser->setEmail($userName);
                        $loggedUser->setPassword($password);

                        $_SESSION["loggedUser"] = $loggedUser;

                        require_once(VIEWS_PATH."menu.php");
                    }
                }
                if ($count == 0){
                    require_once(VIEWS_PATH."main.php?error");
                }
                }else{
                    require_once(VIEWS_PATH."menu.php?error-data");
                }
        }        
    }
?>