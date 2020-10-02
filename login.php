<?php 

require_once("Config/Autoload.php");

Use Models\User as User;

$error;

if($_POST){
	$userName = $_POST['username'];
	$password = $_POST['password'];

	if(($userName == 'test') && ($password == '123')){

        session_start();

		$loggedUser = new User();
		$loggedUser->setEmail($userName);
		$loggedUser->setPassword($password);

		$_SESSION["loggedUser"] = $loggedUser;

		header ("location:nav.php");

		
	}else{
        $error = 'Nombre de usuario/constraseña incorrecto';
        header ("location: main.php");
	}
}else{
	$error = 'Error en el envio de datos';
    header("location: main.php");
}
?>	