<?php
    namespace DAO;

    use Models\Movie as Movie;
    use Models\Genre as Genre;

    class RequestDAO{
        private $movieList = array();
        private  $genreList = array();
        private $movieTitle;
        //Cuando se crea el repositorio se carga el array movieList con las peliculas del nowPlaying y el array genres con los generos y sus id.
        public function __construct(){}
        
        public function GetAllMovies(){
            return $this->movieList;
        }

        public function SaveMoviesFromApi(){ // funcion para actualizar la db de movies
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
                            $details = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/". $jsonMovie['id'] ."?api_key=d7de7eee1dd5c6bed7940903c861af62"),true);
                            $movie->setDuration($details['runtime']);
                            $youtube = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/". $jsonMovie['id'] ."/videos?api_key=d7de7eee1dd5c6bed7940903c861af62"),true);
                            foreach($youtube['results'] as $results){
                                if($results){
                                    $movie->setTrailer("https://www.youtube.com/watch?v=".$results['key']);
                                }
                            }
                            $this->createMovie($movie);
                            $movieId = $this->getMovieIdByInternId($movie->getId());
                            $genreArray = $movie->getGenreIds();
                            foreach($genreArray as $genreId){
                                //Guarda en db los generos correspondientes a la pelicula
                                $this->insertGenresIntoMovies($genreId, $movieId);
                            }     
                        }
                    } 
                } 
        }

        public function SaveGenresFromApi(){
            $genreArray = json_decode(file_get_contents('http://api.themoviedb.org/3/genre/movie/list?api_key=d7de7eee1dd5c6bed7940903c861af62'),true);
            if($genreArray && $genreArray['genres'] && count($genreArray['genres'])!=0){
                foreach($genreArray['genres'] as $genre){
                    if($genre){
                        $newGenre = new Genre();
                        $newGenre->setGenreId($genre['id']);
                        $newGenre->setGenreName($genre['name']);
                        $this->createGenre($newGenre);
                        //array_push($this->genreList, $newGenre);
                    }
                }
            }
            return $this->genreList;
        }

        public function GetGenreByMovieId($idMovie){
            $sql = 'select distinct g.id_genre, g.genre_name
                    from movies_x_genres mxg
                    inner join genres g on mxg.id_genre = g.id_genre
                    where id_movie = '.$idMovie.';';
            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearGenreByMovieId($result);
            }else{
                return false;
            }
        }

        private function mapearGenreByMovieId($value){
            $value = is_array($value) ? $value : [];
            
            $resp = array_map(function($p){
                $genre = new Genre();
                $genre->setGenreId($p['id_genre']);
                $genre->setGenreName($p['genre_name']);
                
                return $genre;
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp['0'];

        }



        public function createMovie($_movie){

            /*$sql = "INSERT INTO movies (title, original_language, release_date, popularity, vote_count, poster_path, id, backdrop_path,  vote_average, overview, trailer, duration) VALUES (:title, :original_language, :release_date, :popularity, :vote_count, :poster_path, :id, :backdrop_path,  :vote_average, :overview, :trailer, :duration);";*/

            $sql = "INSERT INTO movies (title, original_language, release_date, popularity, vote_count, poster_path, id, backdrop_path,  vote_average, overview, trailer, duration)
            SELECT * FROM (SELECT :title, :original_language, :release_date, :popularity, :vote_count, :poster_path, :id, :backdrop_path,  :vote_average, :overview, :trailer, :duration) AS movie
            WHERE NOT EXISTS (
                SELECT * FROM movies WHERE id = :id
            );";
            
            $parameters['title'] = $_movie->getTitle();
            $parameters['original_language'] = $_movie->getOriginalLanguage();
            $parameters['release_date'] = $_movie->getReleaseDate();
            $parameters['popularity'] = $_movie->getPopularity();
            $parameters['vote_count'] = $_movie->getVoteCount();
            $parameters['poster_path'] = $_movie->getPosterPath();
            $parameters['id'] = $_movie->getId();
            $parameters['backdrop_path'] = $_movie->getBackdropPath();
            $parameters['vote_average'] = $_movie->getVoteAverage();
            $parameters['overview'] = $_movie->getOverview();
            $parameters['trailer'] = $_movie->getTrailer();
            $parameters['duration'] = $_movie->getDuration();

            
            
                                                  

            try{
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
            }catch(\PDOException $ex){
                throw $ex;
            }
    
        }
        
        public function getMovieIdByInternId($id){ //id from MovieDB api
            $sqlSelectIdMovie = "select id_movie from movies where id = ".$id." order by id_movie desc limit 1;";

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sqlSelectIdMovie);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearMovieIdByInternId($result);
            }else{
                return false;
            }
        }

        private function mapearMovieIdByInternId($value){
            $value = is_array($value) ? $value : [];
            
            $resp = array_map(function($p){
                return $p['id_movie'];
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp['0'];
        }

        public function getMovieById($id){ //id from our database
            $sqlSelectIdMovie = "select * from movies where id_movie = :id_movie ;";
            $parameters["id_movie"] = $id;

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sqlSelectIdMovie, $parameters);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearMovieId($result);
            }else{
                return false;
            }
        }

        private function mapearMovieId($value){
            $value = is_array($value) ? $value : [];
            
            $resp = array_map(function($p){
                $movie = new Movie();
                $movie->setMovieId($p['id_movie']);
                $movie->setTitle($p['title']);
                $movie->setPopularity($p['popularity']);
                $movie->setVoteCount($p['vote_count']);
                $movie->setPosterPath($p['poster_path']);
                $movie->setId($p['id']);
                $movie->setBackdropPath($p['backdrop_path']);
                $movie->setOriginalLanguage($p['original_language']);
                $movie->setVoteAverage($p['vote_average']);
                $movie->setOverview($p['overview']);
                $movie->setReleaseDate($p['release_date']);
                $movie->setTrailer($p['trailer']);
                $movie->setDuration($p['duration']);
                $movie->setGenreIds($this->getGenreIdByMovieInternId($movie->getId()));

                return $movie;
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp['0'];
        }

        public function getGenreIdByMovieInternId($movieId){
            $sqlSelectIdMovie = "select distinct mxr.id_genre
                                from movies_x_genres mxr
                                inner join movies m on mxr.id_movie = m.id_movie
                                where m.id=".$movieId.";";

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sqlSelectIdMovie);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearGenreId($result);
            }else{
                return false;
            }
        }

        public function mapearGenreId($value){
            $value = is_array($value) ? $value : [];

            $resp = array_map(function($p){
                return $p['id_genre'];
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp['0'];
        }


        public function insertGenresIntoMovies($id_genre, $id_movie){
            $sql = "INSERT INTO movies_x_genres (id_genre, id_movie) values (:id_genre, :id_movie)";
            
            $parameters['id_genre'] = $id_genre;
            $parameters['id_movie'] = $id_movie;

            try{
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
            }catch(\PDOException $ex){
                throw $ex;
            }
        }


        protected function mapearMovies ($value){

            $value = is_array($value) ? $value : [];
            
            $resp = array_map(function($p){
                $movie = new Movie();
                $movie->setMovieId($p['id_movie']);
                $movie->setTitle($p['title']);
                $movie->setPopularity($p['popularity']);
                $movie->setVoteCount($p['vote_count']);
                $movie->setPosterPath($p['poster_path']);
                $movie->setId($p['id']);
                $movie->setBackdropPath($p['backdrop_path']);
                $movie->setOriginalLanguage($p['original_language']);
                $movie->setVoteAverage($p['vote_average']);
                $movie->setOverview($p['overview']);
                $movie->setReleaseDate($p['release_date']);
                $movie->setTrailer($p['trailer']);
                $movie->setDuration($p['duration']);

                return $movie;
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp['0'];
    
        }

        public function readMovies(){

            $sql = "SELECT * FROM Movies";
            
            
    
            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearMovies($result);
            }else{
                return false;
            }
    
        }

        public function readMoviesShow(){
            $sql = "SELECT m.*
                    FROM shows s
                    inner join movies m on s.id_movie = m.id_movie 
                    group by m.id_movie;";
            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearMovies($result);
            }else{
                return false;
            }
        }


        public function createGenre($_genre){
            //$sql = "INSERT INTO genres (id_genre, genre_name) VALUES (:id_genre, :genre_name);";
            
            $sql = "INSERT INTO genres (id_genre, genre_name)
            SELECT * FROM (SELECT :id_genre, :genre_name) AS genre
            WHERE NOT EXISTS (
                SELECT * FROM genres WHERE id_genre = :id_genre
            );";
    
            $parameters['id_genre'] = $_genre->getGenreId();
            $parameters['genre_name'] = $_genre->getGenreName();
    
            try{
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
            }catch(\PDOException $ex){
                throw $ex;
            }
        }

        public function mapearGenres($value){
            $value = is_array($value) ? $value : [];
            
            $resp = array_map(function($p){
                $genre = new Genre();
                $genre->setGenreId($p['id_genre']);
                $genre->setGenreName($p['genre_name']);
                return $genre;
            }, $value);
    
            return count($resp) > 1 ? $resp : $resp['0'];
    
        }



        public function readGenres(){
            $sql = "SELECT * FROM Genres";
            
    
            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearGenres($result);
            }else{
                return false;
            }
        }


        public function mapearMovieDateShow($value){
                $value = is_array($value) ? $value : [];
                $a = array();
                $resp = array_map(function($p){
                    $idMovies = array(
                                    "id_movie" => $p["id_movie"]
                                );
                    
                    
                    return $idMovies ;
                }, $value);
        
                return count($resp) > 1 ? $resp : $resp['0'];
        
            }
        

        public function readMovieIdDateShow($date){
            $sql = "select distinct id_movie from shows
                    where cast(start_time as date) = '".$date."';";

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearMovieDateShow($result);
            }else{
                return false;
            }
        }

        public function moviesExistsInDB(){
            $sql = "SELECT EXISTS(
                        SELECT *
                        from movies
                    ) movie_exist;";
            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearMoviesExists($result);
            }else{
                return false;
            }
        }

        public function mapearMoviesExists($value){
            $value = is_array($value) ? $value : [];
        
            $resp = array_map(function($p){
                return $p['movie_exist'];
            }, $value);

            return count($resp) > 1 ? $resp : $resp['0'];
        }

   /*      public function getMoviesByIdList($idList){
            $sqlSelectIdMovie = "select * from movies where id_movie in ("foreach($idList as $id){
                echo "
            };
            $parameters["id_movie"] = $id;

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($sqlSelectIdMovie, $parameters);
            }catch(\PDOException $ex){
                throw $ex;
            }
            if(!empty($result)){
                return $this->mapearMovieId($result);
            }else{
                return false;
            }
        } */

    }


?>