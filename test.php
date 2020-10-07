<?php
    require_once('Config/Autoload.php');
    
    
    use DAO\RequestDAO as RequestDAO;


    $apiRepository = new RequestDAO();
    $list = array();
    $list = $apiRepository->GetAllMovies();

    var_dump($list);
?>