<?php 
    namespace Models;

    class Room{

        private $roomName;
        private $capacity;
        private $price;

        public function __construct($roomName, $capacity, $price){
            $this->roomName=$roomName;
            $this->capacity=$capacity;
            $this->price = $price;
        }

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
