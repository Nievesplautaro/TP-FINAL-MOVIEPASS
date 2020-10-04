<?php 

require_once("Config/Autoload.php");

use Repositories\UserRepository as UserRepository;
Use Models\User as User;

$userRepository = new UserRepository();
$userList = $userRepository->GetAll();

var_dump($userList);

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

			header ("location:menu.php");
		}
	}
	if ($count == 0){
        header ("location: index.php?error");
	}
}else{
     header("location: index.php?error-data");
}
?>	