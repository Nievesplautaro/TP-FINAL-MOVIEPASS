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

        public function ShowMenuView()
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

        public function login($email,$password){

            $daoUser= new UserDAO();

            try{
                if(!$this->UserExist($email)){

                    $user = $daoUser->read($email);
                    
                    if($user->getPassword() == $password){                    
                        $_SESSION["loggedUser"] = $user;
                        $_SESSION["status"] = "on";
                        $message = "Login Successfully";
                        echo $message;
                        /*Se implementa header ya que con require rompe al volver hacia atras como en tp6*/
                        header("location:Menu");
                    }else{
                        $message = "Contraseña incorrecta";
                        require_once(VIEWS_PATH."main.php"); 
                    }
                }else{
                    $message = "Usuario incorrecto";
                    require_once(VIEWS_PATH."main.php");
                }
            }catch(\PDOExeption $ex){
                $message = "ERROR 404 NOT FOUND";
                require_once(VIEWS_PATH."main.php"); 
            }

        }

        public function Main (){
            require_once(VIEWS_PATH."main.php");
        }

        public function Menu(){
            require_once(VIEWS_PATH."validate-session.php");
            include(VIEWS_PATH."menu.php");
            
        }

        public function SignUp($username,$pass){

            try{
                if(!$this->UserExist($username))
                {

                    $user = new User($username,$pass);
    
                    $daoUser= new UserDAO(); 

                    //se crean los usuarios sin rol de admin
                    if($daoUser->create($user)){
                        $message = "Usuario registrado correctamente";
                    }else{
                        $message = "Error de usuario: intentelo de nuevo mas tarde...";
                    }
                    
                }else{
                    $message = "Ya existe un usuario registrado con esa direccion de correo";
    
                }
                require_once(VIEWS_PATH."main.php");
                
            }catch(\PDOException $ex){
                throw $ex;
            }
            
        }

    /**
     * Chequea el usuario por el nombre
     */
    public function UserExist($username){
        
        $daoUser= new UserDAO();
        
        try{
            if($daoUser->read($username)){
                return true;
            }else{
                return false;
            }
        }catch(\PDOException $ex){
            throw $ex;
        }
    }
/**
 * Rompe la session iniciada
 */

        public function logout(){

            session_destroy();

            $message = "Logout Successfully";

            $this->ShowMainView($message);
        }
        
    }
?>