<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    Use Models\User as User;

    class UserController
    {
        private $userDAO;
        
        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function ShowMenuView($message = "")
        {
            require_once(VIEWS_PATH."menu.php");
        }


        public function login($email, $password)
        {
            $userList = $this->userDAO->GetAll();
            $userName = $email;
            $count = 0;

            foreach($userList as $user){
                if(($user -> getEmail() == $userName) && ($user -> getPassword() == $password)){

                    $count = 1;
                    

                    $loggedUser = new User();
                    $loggedUser->setEmail($userName);
                    $loggedUser->setPassword($password);

                    $_SESSION["loggedUser"] = $loggedUser;
                    
                    $this->ShowMenuView();
                    //require_once(VIEWS_PATH."menu.php");
                }
            }
            if ($count == 0){
                $this->ShowMenuView("Email or Password Invalid.");
                //require_once(VIEWS_PATH."main.php?error");
            }
        }        
    }
?>