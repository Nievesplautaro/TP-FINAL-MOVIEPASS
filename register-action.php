<?php 

require_once("Config/Autoload.php");

use Repositories\UserRepository as UserRepository;
Use Models\User as User;


if($_POST){
	$userName = $_POST['email'];
	$password = $_POST['password'];
    
    $newUser = new User();

    $newUser->setEmail($userName);
    $newUser->setPassword($password);

    $newUserRepository = new UserRepository();
    $newUserRepository->Add($newUser);

    sleep(3);
	header ("location:index.php");

}else{
     header("location: index.php?error-data");
}
?>	