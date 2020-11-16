<?php
    namespace DAO;

    use Models\Room as Room;
    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\Connection as Connection;

    class RoomDAO{

    private $showList = array();
    private $fileName;
    private $connection;
    private $tableName = "room_cinema";

    public function __construct(){
        $this->cinemaDAO = new CinemaDAO();
    }

    /**
     * create = add, add room to db (table room_cinema)
     */
    public function create($_room){

        $sql = "INSERT INTO room_cinema ( room_name , price,  id_room, capacity, id_cinema) VALUES (:room_name , :price,  :id_room, :capacity, :id_cinema)";

        $parameters['room_name'] =  $_room->getRoomName();
        $parameters['capacity'] =  $_room->getCapacity();
        $parameters['id_cinema'] = $_room->getCinema()->getCinemaId();
        $parameters['price'] = $_room->getPrice();
        //autoincrement id_room in db
        $parameters['id_room'] = 0;
/* 
        ACA DEBERIA CARGARSE A LA TABLA SEATS LA CANTIDAD DE ASIENTOS ESPECIFICADOS EN capacity  */

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }

    }

/**
 * Transform room list into objects from room class
 */
    protected function mapear ($value){

        $value = is_array($value) ? $value : [];

        $cinema = new Cinema();
        
        $resp = array_map(function($p){
            $room = new Room();
            $room->setRoomName($p['room_name']);
            $room->setCapacity($p['capacity']);
            $room->setPrice($p['price']);
            $room->setRoomId($p['id_room']);
            $room->setCinema($this->cinemaDAO->getCinemaById($p['id_cinema']));

	        return $room;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

/**
 * return room by id
 */

    public function read($id_room){

        $sql = "SELECT * FROM room_cinema WHERE room_cinema.id_room = :id_room";
        $parameters['id_room'] = $id_room;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapear($result);
        }else{
            return false;
        }

    }

//return all rooms by cinema id

    public function readRooms($id_cinema){

        $sql = "SELECT * FROM room_cinema where room_cinema.id_cinema = ".$id_cinema."";
        
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapear($result);
        }else{
            return false;
        }

    }

    

//edit room by id

    public function EditRoom($id_room, $room){
        $parameters['capacity'] = $room->getCapacity();
        $parameters['price'] = $room->getPrice();
        $parameters['room_name'] = $room->getRoomName();
        $parameters['id_room'] = $id_room;

        $sql = "update room_cinema 
                    set 
                        capacity = :capacity, 
                        price = :price, 
                        room_name = :room_name 
                    where id_room = :id_room;";

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }

    }

//read room by name and cinema id

    public function readByName($id_cinema,$room_name){
        $sql = "SELECT EXISTS(SELECT room_name FROM room_cinema  WHERE room_name = :room_name and id_cinema =".$id_cinema." ) as exist;";
        $parameters['room_name'] = $room_name;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearRoomExists($result);
        }else{
            return false;
        }
    }

    public function mapearRoomExists($value){
        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $exist = $p['exist'];        
	        return $exist;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }

    public function getRoomByShowId($id_show){
        $sql = "select r.*
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
            return $this->mapear($result);
        }else{
            return false;
        }

    }

//delete room by id

    public function Delete($id_room){
        $sql="DELETE FROM room_cinema WHERE room_cinema.id_room=:id_room";
        $values['id_room'] = $id_room;

        try{
            $this->connection= Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql,$values);
        }catch(\PDOException $ex){
            throw $ex;
        }
    }

}
?>