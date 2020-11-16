<?php
    namespace DAO;

    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;

    class CinemaDAO{

    private $CinemaList = array();
    private $fileName;
    private $connection;
    private $tableName = "cinemas";


    /**
     * create = add, add cinemas to db (table cinemas)
     */
    public function create($_cinema){

        $sql = "INSERT INTO cinemas (cinema_name, address, phone_number, id_cinema) VALUES (:cinema_name, :address, :phone_number, :id_cinema)";

        $parameters['cinema_name'] = $_cinema->getName();
        $parameters['address'] = $_cinema->getAddress();
        $parameters['phone_number'] = $_cinema->getPhoneNumber();
        //autoincremental id in DB
        $parameters['id_cinema'] = 0;

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }

    }


/**
 * Transform cinema list into objects form cinema class
 */
    protected function mapearCine($value){

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $cinema = new Cinema();
            $cinema->setName($p['cinema_name']);
            $cinema->setAddress($p['address']);
            $cinema->setPhoneNumber($p['phone_number']);    
            $cinema->setCinemaId($p['id_cinema']);        
	    return $cinema;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

/**
 * return cinema by adress
 */

public function readByAddress($id_cinema,$address){


    $sql = "SELECT EXISTS(SELECT id_cinema FROM cinemas WHERE address = :address and id_cinema <> ".$id_cinema.") as exist;";
    $parameters['address'] = $address;

    try{
        $this->connection = Connection::getInstance();
        $result = $this->connection->Execute($sql,$parameters);
    }catch(\PDOException $ex){
        throw $ex;
    }
    if(!empty($result)){
        return $this->mapearCinemaExists($result);
    }else{
        return false;
    }

}

/**
 * return cinema by name
 */

    public function readByName($id_cinema,$cinema_name){

        $sql = "SELECT EXISTS(SELECT id_cinema FROM cinemas WHERE cinema_name = :cinema_name and id_cinema <> ".$id_cinema.") as exist;";
        $parameters['cinema_name'] = $cinema_name;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearCinemaExists($result);
        }else{
            return false;
        }
    }

    public function mapearCinemaExists($value){
        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $exist = $p['exist'];        
	        return $exist;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }

    /**
 * return cinema by Id
 */

public function read($id_cinema){

    $sql = "SELECT * FROM Cinemas WHERE Cinemas.id_cinema = :id_cinema";
    $parameters['id_cinema'] = $id_cinema;

    try{
        $this->connection = Connection::getInstance();
        $result = $this->connection->Execute($sql,$parameters);
    }catch(\PDOException $ex){
        throw $ex;
    }
    if(!empty($result)){
        return $this->mapearCine($result);
    }else{
        return false;
    }

}

//return cinemaId by room id

public function readCinemaIdByRoomId($id_room){

    $sql = "SELECT room_cinema.id_cinema FROM room_cinema where room_cinema.id_room = ".$id_room."";
    
    try{
        $this->connection = Connection::getInstance();
        $result = $this->connection->Execute($sql);
    }catch(\PDOException $ex){
        throw $ex;
    }
    if(!empty($result)){
        return $this->mapearCinemaId($result);
    }else{
        return false;
    }

}

//read all the cinemas

    public function readCinemas(){

        $sql = "SELECT * FROM cinemas";
        
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearCine($result);
        }else{
            return false;
        }
    }

//return the cinema by id

    public function getCinemaById($id){
        $sqlSelectId = "select * from cinemas where id_cinema = '".$id."';";
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sqlSelectId);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearCinema($result);
        }else{
            return false;
        }
    }

    public function mapearCinema($value){
        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $cinema = new Cinema();
            $cinema->setCinemaId($p['id_cinema']);
            $cinema->setName($p['cinema_name']);
            $cinema->setAddress($p['address']);
            $cinema->setPhoneNumber($p['phone_number']);
            
            return $cinema;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }


    public function getCinemaIdByName($cinemaName){
        $sqlSelectId = "select id_cinema from cinemas where cinema_name = '".$cinemaName."' order by id_cinema desc limit 1;";

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sqlSelectId);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearCinemaId($result);
        }else{
            return false;
        }
    }

    private function mapearCinemaId($value){
        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            return $p['id_cinema'];
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

    //edit cinema by id

    public function editCinema($id_cinema,$editCinema){
        $parameters['cinema_name'] = $editCinema->getName();
        $parameters['address'] = $editCinema->getAddress();
        $parameters['phone_number'] = $editCinema->getPhoneNumber();
        $parameters['id_cinema'] = $id_cinema;
        $sql = "update cinemas 
                    set 
                        cinema_name = :cinema_name, 
                        address = :address, 
                        phone_number = :phone_number 
                    where id_cinema = :id_cinema;";

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }
    }

    public function getCinemaByShowId($id_show){
        $sql = "select c.*
                from shows s
                inner join room_cinema r on r.id_room = s.id_room
                inner join cinemas c on c.id_cinema = r.id_cinema
                where s.id_show = ".$id_show.";";

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearCine($result);
        }else{
            return false;
        }

    }

    public function getCinemaByRoomId($id_room){
        $sql = 'select c.*
                from  room_cinema r 
                inner join cinemas c on c.id_cinema = r.id_cinema
                where r.id_room = '.$id_room.';';
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearCine($result);
        }else{
            return false;
        }

    }

//delete cinema by id

    public function deleteCinema($id){
        $sql="DELETE FROM Cinemas WHERE Cinemas.id_Cinema=:id_Cinema";
        $values['id_Cinema'] = $id;

        try{
            $this->connection= Connection::getInstance();
            $this->connection->connect();
            return $this->connection->ExecuteNonQuery($sql,$values);
        }catch(\PDOException $ex){
            throw $ex;
        }
    }

}
?>