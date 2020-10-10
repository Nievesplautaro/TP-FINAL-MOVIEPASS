<?php
     namespace Models;

     class Genre{
          private $genreId;
          private $genreName;

          
          public function getGenreId()
          {
                    return $this->genreId;
          }

          public function setGenreId($genreId)
          {
                    $this->genreId = $genreId;

                    return $this;
          }

          public function getGenreName()
          {
                    return $this->genreName;
          }


          public function setGenreName($genreName)
          {
                    $this->genreName = $genreName;

                    return $this;
          }
     }


?>