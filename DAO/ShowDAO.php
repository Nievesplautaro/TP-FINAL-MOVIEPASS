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
     * create = add, agrega shows a la base de datos, tabla shows
     */
    public function create($_show){

        $sql = "INSERT INTO shows ( id_movie, id_room, start_time) VALUES (:id_movie, :id_room, :start_time)";

        $parameters['id_movie'] = $_show->getMovie()->getMovieId();
        $parameters['id_room'] = $_show->getRoom()->getRoomId();
        $parameters['start_time'] = $_show->getStartTime();
        //$parameters['id_show'] = 0;

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
    protected function mapear ($value){

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $movie = $this->movieDAO->getMovieById($p['id_movie']);
            $room = $this->roomDAO->read($p['id_room']);
            echo $p['id_room'];

            $show = new Show();            
            $show->setMovie($movie);
            $show->setRoom($room);
            $show->setStartTime($p['start_time']);
            
            //$p['id_movie'],$p['id_room'],$p['start_time'],$p['id_show']
            
            return $show;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

/**
 * Devuelve el cine por el nombre
 */

    public function read($id_cinema){

        $sql = "SELECT
                id_show,
                id_movie,
                s.id_room,
                start_time
                FROM
                    room_cinema r 
                inner JOIN shows s on r.id_room = s.id_room
                where r.id_cinema = ".$id_cinema."
                order by id_room;";

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


}
?>