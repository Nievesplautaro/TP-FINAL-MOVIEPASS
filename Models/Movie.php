<?php

namespace Models;

    class Movie{

    private $name;
    private $director;
    private $genre;
    private $lenght;

    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    public function getLenght()
    {
        return $this->lenght;
    }

    public function setLenght($lenght)
    {
        $this->lenght = $lenght;

        return $this;
    }
    }
?>