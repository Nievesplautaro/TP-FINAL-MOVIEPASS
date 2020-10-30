<?php 
    namespace Models;

    class Show{
        private $movie;
        private $roomId;
        private $start_time;
        private $id_show;

        public function getShowId()
        {
            return $this->id_show;
        }

        public function setShowId($id_show)
        {
            $this->id_show = $id_show;

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