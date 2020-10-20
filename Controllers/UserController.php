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

        public function ShowMenuView($message)
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."menu.php");
        }
        public function ShowMainView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."main.php");
        }
        public function ShowRegisterView()
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

                    header("location:Menu");

                    //$this->ShowMenuView($message);
                }
            }
            if ($count == 0){
                $error = true;
                header("location:Main");
            }
        }  

        public function Main (){
            include(VIEWS_PATH."main.php");

        }

        public function Menu(){
            require_once(VIEWS_PATH."validate-session.php");
            include(VIEWS_PATH."menu.php");
            
        }
        
        public function register(){
            
            $userName = $_POST['email'];
            $password = $_POST['password'];
            
            $newUser = new User();
        
            $newUser->setEmail($userName);
            $newUser->setPassword($password);
        
            $valid = $this->userDAO->Add($newUser);
        
            if ($valid === 0){
                $error = "invalid";
                require_once(VIEWS_PATH."register.php");
            }else{
                //usar require ya que permite el pasaje de la variable para mensajes, si uso la funcion show no puedo pasar vars.
                $error = "03";
                require_once(VIEWS_PATH."main.php");
            }
        
        }

        public function logout(){

            session_destroy();

            $message = "Logout Successfully";

            $this->ShowMainView($message);
        }
        
    }
?>