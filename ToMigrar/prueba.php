<?php
    require_once('Config/Autoload.php');

    require_once('Repositories/ApiRepository.php');
    use Repositories\ApiRepository as ApiRepository;


    $apiRepository = new ApiRepository();
    $list = array();
    $list = $apiRepository->GetAllMovies();

    var_dump($list);
?>