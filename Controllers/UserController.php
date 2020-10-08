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
        public function ShowMainView($message = "")
        {
            require_once(VIEWS_PATH."main.php");
        }
        public function ShowRegisterView($message = "")
        {
            require_once(VIEWS_PATH."register.php");
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
                    
                    $message = "Login Successfully";

                    $this->ShowMenuView($message);
                }
            }
            if ($count == 0){
                $message = "Email or Password Invalid.";
                $this->ShowMainView($message);
            }
        }  
        
        public function register($email, $password){
            
            $userName = $_POST['email'];
            $password = $_POST['password'];
            
            $newUser = new User();
        
            $newUser->setEmail($userName);
            $newUser->setPassword($password);
        
            $newUserRepository = new UserDAO();
            $valid = $newUserRepository->Add($newUser);
        
            if ($valid === 0){
                $message = "Email Already in Use";
                echo '<script language="javascript">alert("Email Already In Use");</script>';
            }else{
                $message = "User Registered Successfully";
                echo '<script language="javascript">alert("You Have Been Registered Successfully");</script>';
            }
            $this->ShowMainView($message);
        
        }

        public function logout(){

            session_destroy();

            $message = "Logout Successfully";

            $this->ShowMainView($message);
        }
        
    }
?>