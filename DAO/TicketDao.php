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
     * create = add, agrega tickets a la base de datos, tabla tickets
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
 * Transformamos el listado de tickets en objetos de la clase ticket
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
 * Devuelve el ticket por el id
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

}
?>