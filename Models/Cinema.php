<?php

namespace Models;

    class Cinema{

    private $name;
    private $phoneNumber;
    private $ticketPrice;
    private $address;
    private $capacity;
    private $show;
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getTicketPrice()
    {
        return $this->ticketPrice;
    }

    public function setTicketPrice($ticketPrice)
    {
        $this->ticketPrice = $ticketPrice;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;

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

    public function getShow()
    {
        return $this->show;
    }

    public function setShow($show)
    {
        $this->show = $show;

        return $this;
    }
    }
?>