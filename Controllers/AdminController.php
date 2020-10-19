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
            require_once(VIEWS_PATH."menuAdmin.php");
        }
        public function ShowAdminView($message = "")
        {
            require_once(VIEWS_PATH."mainAdmin.php");
        }
        public function registerAdmin($message = "")
        {
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

                    header("location:Showmenu");    
                }
            }
            if ($count == 0){
                $error = true;
                require_once(VIEWS_PATH."mainAdmin.php");
            }
        }  

        public function Showmenu(){
            include(VIEWS_PATH."menuAdmin.php");
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
                $message = "Email Already in Use";
                echo '<script language="javascript">alert("Email Already In Use");</script>';
            }else{
                $message = "User Registered Successfully";
                echo '<script language="javascript">alert("You Have Been Registered Successfully");</script>';
            }
            $this->ShowAdminView($message);
        
        }

        public function logout(){

            session_destroy();

            $message = "Logout Successfully";

            $this->ShowAdminView($message);
        }
        
    }
?>