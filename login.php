<?php 

require_once("Config/Autoload.php");

use Repositories\UserRepository as UserRepository;
Use Models\User as User;

$userRepository = new UserRepository();
$userRepository = $userRepository->GetAll();
$error;

if($_POST){
	$userName = $_POST['username'];
	$password = $_POST['password'];
	$count = 0;

	foreach($userRepository as $user){
		if(($user -> getEmail() == $email) && ($user -> getPassword() == $password)){

			$count = 1;
        	session_start();

			$loggedUser = new User();
			$loggedUser->setEmail($userName);
			$loggedUser->setPassword($password);

			$_SESSION["loggedUser"] = $loggedUser;

			header ("location:nav.php");
		}
	}
	if ($count == 0){
        $error = 'Nombre de usuario/constraseña incorrecto';
        header ("location: main.php");
	}
}else{
	$error = 'Error en el envio de datos';
    header("location: main.php");
}
?>	