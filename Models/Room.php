<?php 
    namespace Models;

    Use Models\Cinema as Cinema;

    class Room{

        private $roomName;
        private $capacity;
        private $price;
        private $id_room;
        private $cinema;


        public function __construct(/*$roomName, $capacity, $price, $id_room*/){
            /*$this->roomName=$roomName;
            $this->capacity=$capacity;
            $this->price = $price;
            $this->id_room = $id_room;*/
        }

        public function getCinema()
        {
            return $this->cinema;
        }

        public function setCinema($cinema)
        {
            $this->cinema = $cinema;

            return $this;
        }

        public function getRoomId()
        {
            return $this->id_room;
        }

        public function setRoomId($id_room)
        {
            $this->id_room = $id_room;

            return $this;
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
