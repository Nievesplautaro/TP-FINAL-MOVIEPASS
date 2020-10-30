<?php
    namespace DAO;

    use Models\Room as Room;
    use DAO\Connection as Connection;

    class RoomDAO{

    private $showList = array();
    private $fileName;
    private $connection;
    private $tableName = "room_cinema";


    /**
     * create = add, agrega room a la base de datos, tabla room
     */
    public function create($id_cinema,$_room){

        $sql = "INSERT INTO room_cinema ( room_name , price,  id_room, capacity, id_cinema) VALUES (:room_name , :price,  :id_room, :capacity, :id_cinema)";

        $parameters['room_name'] =  $_room->getRoomName();
        $parameters['capacity'] =  $_room->getCapacity();
        $parameters['id_cinema'] = $id_cinema;
        $parameters['price'] = $_room->getPrice();
        //indistinto el id de room porque es autoincremental, pero sino no lo sube por parametros
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
 * Transformamos el listado de salas en objetos de la clase sala
 */
    protected function mapear ($value){

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $room = new Room($p['room_name'], $p['capacity'], $p['price']);
	        return $room;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

/**
 * Devuelve el cine por el nombre
 */

    public function read($room_name){

        $sql = "SELECT * FROM room_cinema WHERE room_cinema.room_name = :room_name";
        $parameters['room_name'] = $room_name;

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

    public function readRooms(){

        $sql = "SELECT * FROM room_cinema";
        
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

    public function Delete($room){
        $sql="DELETE FROM Rooms WHERE Rooms.room_name=:room_name";
        $values['room_name'] = $room->getRoomName();

        try{
            $this->connection= Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql,$values);
        }catch(\PDOException $ex){
            throw $ex;
        }
    }

}
?>