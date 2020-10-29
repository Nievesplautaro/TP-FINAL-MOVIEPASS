<?php 
    namespace Models;

    class Room{

        private $roomName;
        private $capacity;
        private $price;

        
        public function getCapacity()
        {
            return $this->capacity;
        }

        public function setCapacity($capacity)
        {
            $this->capacity = $capacity;

            return $this;
        }

        public function getRoomName()
        {
            return $this->roomName;
        }

        public function setRoomName($roomName)
        {
            $this->roomName = $roomName;

            return $this;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function setPrice($price)
        {
            $this->price = $price;

            return $this;
        }
    }
?>
