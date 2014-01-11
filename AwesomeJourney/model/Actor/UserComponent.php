<?php
include_once 'model/connection.php';
include_once 'ConcreteUserComponent.php';
include_once 'TravelAgent.php';

abstract class UserComponent{   
    public static function login($mail, $pass){
        $conn = new Connection();
        $us = $conn->verifica_login($mail, sha1($pass));
        $conn->close();
        if($us != FALSE){
            session_start();
            if($us->role == 'customer')
                return self::concreteUserComponent(session_id (), $us->mail, $us->name, $us->surname, $us->address, $us->telephone);
            else
                return self::travelAgent(session_id (), $us->mail, $us->name, $us->surname, $us->address, $us->telephone);
        } 
    }
    
    public static function register($name, $surname, $address, $tel, $mail, $pass) {
        $conn = new Connection();
        $rx = $conn->registra($name, $surname, $address, $tel, sha1($mail));
        if($rx){
            $conn->newCreator ($mail, $pass);
            self::login ($mail, $pass);
        } else
            return FALSE;
    }
    
    private static function concreteUserComponent($id, $mail, $name, $surname, $address, $telephone){
        return new ConcreteUserComponent($id, $mail, $name, $surname, $address, $telephone);
    }
    
    private static function travelAgent($id, $mail, $name, $surname, $address, $telephone){
        return new TravelAgent(self::concreteUserComponent($id, $mail, $name, $surname, $address, $telephone));
    }
    
    public static function logout(){
        @session_destroy();
    }
    
    abstract function setStaySearchResult();
    abstract function getStaySearchResult();
    abstract function getRole();
    abstract function getName();
    abstract function getSurname();
    abstract function getAddress();
    abstract function getTelephone();
    abstract function getMail();
}
?>
