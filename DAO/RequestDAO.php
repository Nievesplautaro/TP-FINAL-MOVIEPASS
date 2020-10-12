<?php
    namespace DAO;

    use Models\Movie as Movie;
    use Models\Genre as Genre;

    class RequestDAO{
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
            
            $genreArray = json_decode(file_get_contents('http://api.themoviedb.org/3/genre/movie/list?api_key=d7de7eee1dd5c6bed7940903c861af62'),true);
            if($genreArray && $genreArray['genres'] && count($genreArray['genres'])!=0){
                foreach($genreArray['genres'] as $genre){
                    if($genre){
                        $newGenre = new Genre();
                        $newGenre->setGenreId($genre['id']);
                        $newGenre->setGenreName($genre['name']);
                        array_push($this->genreList, $newGenre);
                    }
                }
            }
            
        }
        private function SetMovies(){
            
        }
        
        public function GetAllMovies(){
            return $this->movieList;
        }

        public function GetMoviesByGenre($id){
            $movieGenreList = array();
            foreach ($this->movieList as $movie){
                if (in_array($id,$movie->getGenreIds())){
                    array_push($this->movieGenreList, $movie);
                }
            }
            return $this->movieGenreList;
        }

        public function GetMovieByTitle($title){
            foreach ($this->movieList as $movie){
                if ($movie->getTitle() == $title){
                    return $movie;
                }
            }
            return $this->movieList;
        }


        public function GetGenres(){
            return $this->genreList;
        }

        public function GetGenreById($id){
            foreach($this->genreList as $genre){
                if($genre->getGenreId() == $id){
                     return $genre->getGenreName();
                }
           }
        }

        
        
    }


?>