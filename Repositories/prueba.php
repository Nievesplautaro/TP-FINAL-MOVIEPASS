<?php
    namespace Repositories;
    require_once('../Config/Autoload.php');
    
    include ('ApiRepository.php');
    use Repositories\ApiRepository as ApiRepository;


    $MovieRepository = new MovieRepository;
    $list = array();
    $list = $MovieRepository->GetAllMovies();

    var_dump($list);
?>