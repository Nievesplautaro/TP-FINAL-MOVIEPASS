<?php
    namespace Repositories;

    use Models\Movie as Movie;

    class ApiRepository{
        private $movieList = array();
        private  $genreList = array();
        //Cuando se crea el repositorio se carga el array movieList con las peliculas del nowPlaying y el array genres con los generos y sus id.
        public function __construct(){
            $jsonArray = json_decode(file_get_contents('http://api.themoviedb.org/3/movie/now_playing?api_key=d7de7eee1dd5c6bed7940903c861af62'),true);
            if($jsonArray && $jsonArray['results'] && count($jsonArray['results'])!=0){ 
                foreach($jsonArray['results'] as $jsonMovie){
                        if($jsonMovie){
                            $movie = new Movie();
                            $movie->setPopularity($jsonMovie['popularity']);
                            $movie->setVoteCount($jsonMovie['vote_count']);
                            $movie->setPosterPath($jsonMovie['poster_path']);
                            $movie->setId($jsonMovie['id']);
                            $movie->setBackdropPath($jsonMovie['backdrop_path']);
                            $movie->setOriginalLanguage($jsonMovie['original_language']);
                            $movie->setGenreIds($jsonMovie['genre_ids']);
                            $movie->setTitle($jsonMovie['title']);
                            $movie->setVoteAverage($jsonMovie['vote_average']);
                            $movie->setOverview($jsonMovie['overview']);
                            $movie->setReleaseDate($jsonMovie['release_date']);
                            array_push($this->movieList, $movie);
                        }
                    } 
                } 
            $this->genreList = json_decode(file_get_contents('http://api.themoviedb.org/3/genre/movie/list?api_key=d7de7eee1dd5c6bed7940903c861af62'),true);
        }
        private function SetMovies(){
            
        }

        
        public function GetAllMovies(){
            return $this->movieList;
        }
        
    }


?>