<?php
    namespace Repositories;

    use Models\Movie as Movie;

    class MovieRepository{
        private $movieList = array();
        private  $genreList = array();
        //Cuando se crea el repositorio se carga el array movieList con las peliculas del nowPlaying y el array genres con los generos y sus id.
        public function __construct(){
            $jsonArray = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=d7de7eee1dd5c6bed7940903c861af62'),true);
            if($jsonArray && $jsonArray['results'] && count($jsonArray['results'])!=0){ 
                foreach($jsonArray['results'] as $jsonMovie){
                        if($jsonMovie){
                                $movie = new Movie(
                                    $jsonMovie['popularity'],
                                    $jsonMovie['vote_count'],
                                    $jsonMovie['poster_path'],
                                    $jsonMovie['id'],
                                    $jsonMovie['backdrop_path'],
                                    $jsonMovie['original_language'],
                                    $jsonMovie['genre_ids'],
                                    $jsonMovie['title'],
                                    $jsonMovie['vote_average'],
                                    $jsonMovie['overview'],
                                    $jsonMovie['release_date']
                                );
                            array_push($this->movieList, $movie);
                        }
                    } 
                } 
            $this->genreList = json_decode(file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=d7de7eee1dd5c6bed7940903c861af62'),true);
        }
        private function SetMovies(){
            
        }

        
        public function GetAllMovies(){
            return $this->movieList;
        }
        
    }


?>