<?php
    namespace DAO;

    use Models\Show as Show;
    use DAO\Connection as Connection;
    use DAO\RequestDAO as RequestDAO;
    use DAO\RoomDAO as RoomDAO;

    class ShowDAO{

    private $showList = array();
    private $fileName;
    private $connection;
    private $tableName = "shows";
    private $movieDAO;
    private $roomDAO;

    public function __construct(){
        $this->movieDAO = new RequestDAO();
        $this->roomDAO = new RoomDAO();
    }



    /**
     * create = add, add shows to db (table shows)
     */
    public function create($_show){

        $sql = "INSERT INTO shows ( id_movie, id_room, start_time) VALUES (:id_movie, :id_room, :start_time)";

        $parameters['id_movie'] = $_show->getMovie()->getMovieId();
        $parameters['id_room'] = $_show->getRoom()->getRoomId();
        $parameters['start_time'] = $_show->getStartTime();

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }

    }


/**
 * Transform show list into objects from show class
 */
    protected function mapear ($value){

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $movie = $this->movieDAO->getMovieById($p['id_movie']);
            $room = $this->roomDAO->read($p['id_room']);

            $show = new Show();            
            $show->setMovie($movie);
            $show->setRoom($room);
            $show->setStartTime($p['start_time']);
            $show->setShowId($p['id_show']);
            
            return $show;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

/**
 * return show by cinemaId
 */

    public function read($id_cinema){

        $sql = "SELECT
                shows.*
                FROM
                    shows 
                inner JOIN room_cinema r on r.id_room = shows.id_room
                and r.id_cinema = :id_cinema";

        $parameters['id_cinema'] = $id_cinema;
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

/**
 * return all shows into a list
 */

    public function GetAll(){
        $sql = "SELECT * FROM shows";
 
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result))
            return $this->mapear($result);
        else
            return false;
    }

    public function showInfoToGetTicket($id_movie){
        echo $id_movie;
        $sql = "select c.cinema_name,s.id_show, s.start_time
                from shows s
                inner join room_cinema rc on s.id_room = rc.id_room
                inner join cinemas c on rc.id_cinema = c.id_cinema
                inner join movies m on s.id_movie = m.id_movie
                where m.id = ".$id_movie."
                order by c.cinema_name;";

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearShowInfo($result);
        }else{
            return false;
        }
        
    }

    protected function mapearShowInfo($value){
        $value = is_array($value) ? $value : [];
        $a = array();
        $resp = array_map(function($p){
            $showInfo = array(
                            "cinema_name" => $p["cinema_name"],
                            "start_time"  => $p["start_time"],
                            "id_show"     => $p["id_show"]
                        );
            return $showInfo ;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

//delete show by id

    public function deleteShow($id_show){
        $sql="DELETE FROM shows WHERE shows.id_show=:id_show";
        $values['id_show'] = $id_show;

        try{
            $this->connection= Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql,$values);
        }catch(\PDOException $ex){
            throw $ex;
        }
    }

}
?>