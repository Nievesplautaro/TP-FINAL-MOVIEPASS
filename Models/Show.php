<?php 
    namespace Models;

    Use Models\Movie as Movie;
    Use Models\Room as Room;

    class Show{
        private $movie;
        /* private $roomId; */
        private $room;
        private $start_time;
        private $id_show;
        /* private $id_movie; */

        public function __construct($id_movie, $id_room, $start_time,$id_show){
            $this->movie = new Movie();
            $this->room = new Room();
            $this->movie->setMovieId($id_movie);
            $this->room->setRoomId($id_room);
            $this->start_time = $start_time;
            $this->id_show = $id_show;
        }

        


        public function getShowId()
        {
            return $this->id_show;
        }

        public function setShowId($id_show)
        {
            $this->id_show = $id_show;

            return $this;
        }

        public function getRoom()
        {
            return $this->room;
        }

        public function setRoom($room)
        {
            $this->room = $room;

            return $this;
        }

        public function getMovie()
        {
            return $this->movie;
        }

        public function setMovie($movie)
        {
            $this->movie = $movie;

            return $this;
        }

/*         public function getMovieId()
        {
            return $this->id_movie;
        }

        public function setMovieId($id_movie)
        {
            $this->id_movie = $id_movie;

            return $this;
        } */

 /*        public function getRoomId()
        {
            return $this->roomId;
        }

        public function setRoomId($roomId)
        {
            $this->roomId = $roomId;

            return $this;
        } */

        public function getStartTime()
        {
            return $this->startTime;
        }

        public function setStartTime($startTime)
        {
            $this->startTime = $startTime;

            return $this;
        }
    }
?>