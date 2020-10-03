<?php
    namespace Repositories;

    use Models\Movie as Movie;

    class MovieRepository{
        $private movieList = array();
        $private genreList = array();
        //Cuando se crea el repositorio se carga el array movieList con las peliculas del nowPlaying y el array genres con los generos y sus id.
        public function __construct(){
            $this->movieList = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=d7de7eee1dd5c6bed7940903c861af62'),true);
            $this->genreList = json_decode(file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=d7de7eee1dd5c6bed7940903c861af62&language=en-US'),true);
        }
        
        public function GetAllMovies(){
            return $this->movieList;
        }
        
    }
?>