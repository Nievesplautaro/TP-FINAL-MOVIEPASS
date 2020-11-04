<?php
namespace Model;

class Ticket{

    private $idTicket;
    private $idShow;
    private $idUser;
    private $price;
    //private $QR; ver si se implementa
    

    /**
     * Get the value of idTicket
     */ 
    public function getIdTicket()
    {
        return $this->idTicket;
    }

    /**
     * Set the value of idTicket
     *
     * @return  self
     */ 
    public function setIdTicket($idTicket)
    {
        $this->idTicket = $idTicket;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of idShow
     */ 
    public function getIdShow()
    {
        return $this->idShow;
    }

    /**
     * Set the value of idShow
     *
     * @return  self
     */ 
    public function setIdShow($idShow)
    {
        $this->idShow = $idShow;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
}

?>