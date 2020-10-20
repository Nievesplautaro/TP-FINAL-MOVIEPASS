<?php
    namespace Controllers;
    use DAO\AdminDAO as AdminDAO;
    Use Models\Admin as Admin;

    

    class AdminController
    {
        private $adminDAO;
        
        public function __construct(){
            $this->adminDAO = new AdminDAO();
        }

        public function ShowMenuView($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."menuAdmin.php");
        }
        /* ESTA REPETIDA APROPOSITO*/
        public function Menu(){
            require_once(VIEWS_PATH."validate-session.php");
            include(VIEWS_PATH."menuAdmin.php");
        }
        public function ShowAdminView($message = "")
        {
            require_once(VIEWS_PATH."mainAdmin.php");
        }
        public function registerAdmin($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerAdmin.php");
        }


        public function login($email, $password)
        {
            $adminList = $this->adminDAO->GetAll();
            $adminName = $email;
            $count = 0;

            foreach($adminList as $admin){
                if(($admin -> getEmail() == $adminName) && ($admin -> getPassword() == $password)){

                    $count = 1;
                    

                    $loggedUser = new Admin();
                    $loggedUser->setEmail($adminName);
                    $loggedUser->setPassword($password);

                    $_SESSION["loggedUser"] = $loggedUser;
                    
                    $message = "Login Successfully";

                    header("location:Menu");    
                }
            }
            if ($count == 0){
                $error = true;
                header("location:Main");    
            }
        }  

        public function Main(){
            include(VIEWS_PATH."mainAdmin.php");
        }
        
        public function register(){
            
            $userName = $_POST['email'];
            $password = $_POST['password'];
            
            $newUser = new Admin();
        
            $newUser->setEmail($userName);
            $newUser->setPassword($password);
        
            $newUserRepository = new AdminDAO();
            $valid = $newUserRepository->Add($newUser);
        
            if ($valid === 0){
                $error = "invalid";
                require_once(VIEWS_PATH."registerAdmin.php");
            }else{
                //usar require ya que permite el pasaje de la variable para mensajes, si uso la funcion show no puedo pasar vars.
                $error = "03";
                require_once(VIEWS_PATH."mainAdmin.php");
            }
        
        }

        public function logout(){

            session_destroy();

            $message = "Logout Successfully";

            $this->ShowAdminView($message);
        }
        
    }
?>