<?php
    namespace DAO;

    use Models\Cinema as Cinema;
    use Models\Show as Show;
    use Models\Ticket as Ticket;
    use Models\User as User;
    use DAO\Connection as Connection;

    class TicketDAO{

    private $TicketList = array();
    private $fileName;
    private $connection;
    private $tableName = "tickets";


    /**
     * create = add, add tickets to db (table tickets)
     */
    public function create($_ticket){

        $sql = "INSERT INTO tickets (id_ticket, id_show, id_user, price) VALUES (:id_ticket, :id_show, :id_user, :price)";

        $parameters['id_ticket'] = $_ticket->getIdTicket();
        $parameters['id_show'] = $_ticket->getIdShow();
        $parameters['id_user'] = $_ticket->getIdUser();
        $parameters['price'] = $_ticket->getPrice();

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }

    }


/**
 * Transform ticket list into objects from ticket class
 */
    protected function mapearTicket($value){

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $ticket = new Ticket();
            $ticket->setIdTicket($p['id_ticket']);
            $ticket->setIdShow($p['id_show']);
            $ticket->setIdUser($p['id_user']);    
            $ticket->setPrice($p['price']);        
	    return $ticket;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

    /**
 * return ticket by id
 */

public function read($id_ticket){

    $sql = "SELECT * FROM tickets WHERE Cinemas.id_ticket = :id_ticket";
    $parameters['id_ticket'] = $id_ticket;

    try{
        $this->connection = Connection::getInstance();
        $result = $this->connection->Execute($sql,$parameters);
    }catch(\PDOException $ex){
        throw $ex;
    }
    if(!empty($result)){
        return $this->mapearTicket($result);
    }else{
        return false;
    }

}

//return all tickets into a list

    public function readTickets(){

        $sql = "SELECT * FROM tickets";
        
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearTicket($result);
        }else{
            return false;
        }
    }

    public function getTicketByUserId($user_id){
        $sql = "SELECT * FROM tickets t where t.id_user = ".$user_id.";";
        
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearTicket($result);
        }else{
            return false;
        }
    }

//return ticket by id

    public function getTicketById($id){
        $sqlSelectId = "select * from tickets where id_ticket = '".$id."';";
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sqlSelectId);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearTicket($result);
        }else{
            return false;
        }
    }

    public function getRoomPriceByShowId($id_show){
        $sql = "select r.price
                from shows s
                inner join room_cinema r on r.id_room = s.id_room
                where s.id_show = ".$id_show.";";
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearRoomPrice($result);
        }else{
            return false;
        }
    }

    public function mapearRoomPrice($value){
        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $price = $p['price'];        
	        return $price;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
    
    public function getTicketsPurchaseByShowId($id_show){
        $sql = "select count(*) as ticket_purchase from tickets where id_show = ".$id_show.";";
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearTicketPurchase($result);
        }else{
            return false;
        }
    }

    public function getAmountCollectedByShowId($id_show){
        $sql = "select sum(price) as total_amount from tickets where id_show =".$id_show.";";
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearAmountCollected($result);
        }else{
            return false;
        }
    }

    public function mapearAmountCollected($value){
        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $total_amount = $p['total_amount'];        
	        return $total_amount;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }

    public function mapearTicketPurchase($value){
        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $ticket_purchase = $p['ticket_purchase'];        
	        return $ticket_purchase;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }


}
?>