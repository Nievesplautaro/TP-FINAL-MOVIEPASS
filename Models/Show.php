<?php 
    moviespace Models;

    class Show{
        private $movie;
        private $roomId;
        private $start_time;

        public function getMovie()
        {
            return $this->movie;
        }

        public function setMovie($movie)
        {
            $this->movie = $movie;

            return $this;
        }

        public function getRoomId()
        {
            return $this->roomId;
        }

        public function setRoomId($roomId)
        {
            $this->roomId = $roomId;

            return $this;
        }

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