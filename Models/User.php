<?php

namespace Models;

    class User {

    private $email;
    private $password;
    private $user_role;
    private $id_user;

    /* public function __construct($email, $password){
        $this->email=$email;
        $this->password=$password;
        $this->user_role = 0;
    } */

    public function setUserId($id_user){
        $this->id_user = $id_user;
    }

    public function getUserId(){
        return $this->id_user;
    }

    public function setUserRole($user_role){
        $this->user_role = $user_role;
    }

    public function getUserRole(){
        return $this->user_role;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    }
?>