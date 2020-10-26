<?php
    namespace DAO;

    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO{

    private $userList = array();
    private $fileName;
    private $connection;
    private $tableName = "users";


    /**
     * create = add, agrega usuarios a la base de datos, tabla users
     */
    public function create($_user){

        $sql = "INSERT INTO users (username, pass, user_role, id_user) VALUES (:username, :pass, :user_role, :id_user)";

        $parameters['username'] = $_user->getEmail();
        $parameters['pass'] = $_user->getPassword();
        //predefinido rol USUARIO y no ADMIN
        $parameters['user_role'] = $_user->getUserRole();
        //indistinto el id de usuario porque es autoincremental, pero sino no lo sube por parametros
        $parameters['id_user'] = 0;

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
            $user = new User($p['username'], $p['pass']);
            $user->setUserRole($p['user_role']);
            return $user;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

/**
 * Devuelve el usuario por el username
 */

    public function read($username){

        $sql = "SELECT * FROM Users WHERE Users.username = :username";
        $parameters['username'] = $username;

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

}
?>