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
     * create = add, agrega cines a la base de datos, tabla cinemas
     */
    public function create($_cinema){

        $sql = "INSERT INTO cinemas (cinema_name, address, phone_number, id_cinema) VALUES (:cinema_name, :address, :phone_number, :id_cinema)";

        $parameters['cinema_name'] = $_cinema->getName();
        $parameters['address'] = $_cinema->getAddress();
        $parameters['phone_number'] = $_cinema->getPhoneNumber();
        //indistinto el id de usuario porque es autoincremental, pero sino no lo sube por parametros
        $parameters['id_cinema'] = 0;

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }

    }


/**
 * Transformamos el listado de usuarios en objetos de la clase usuario
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
 * Devuelve el cine por el nombre
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


    public function editCinema($id_cinema,$editCinema){
        $parameters['cinema_name'] = $editCinema->getName();
        $parameters['address'] = $editCinema->getAddress();
        $parameters['phone_number'] = $editCinema->getPhoneNumber();
        //indistinto el id de usuario porque es autoincremental, pero sino no lo sube por parametros
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