<?php
    spl_autoload_register(function ($className)
    {
        $className = str_replace('\\', '/', $className);
        $fileName = $className.".php";
        echo $fileName;
        require_once($fileName);     
    });
?>