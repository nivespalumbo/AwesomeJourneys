<?php

include_once 'model/AJConnection.php';
/**
 * Description of UserComponent
 *
 * @author Nives
 */
abstract class UserComponent {
    public static function login($mail, $pass){
        $c = new AJConnection();
        
        $us = $c->verificaLogin($mail, sha1($pass));
        $c->close();
        if($us != FALSE){
            session_start();
            if($us->role == 'customer'){
                return new ConcreteUserComponent(session_id(), $us->name, $us->surname, $us->address, $us->telephone, $us->mail);
            } else {
                return new TravelAgent(new ConcreteUserComponent(session_id(), $us->name, $us->surname, $us->address, $us->telephone, $us->mail));
            }
        } 
        return FALSE;
    }
    
    public static function register($name, $surname, $address, $tel, $mail, $pass, $passBis) {
        $c = new AJConnection();
        
        if($pass === $passBis){
            if($c->registra($name, $surname, $address, $tel, $mail)){
                $c->newCreator ($mail, sha1($pass));
                return self::login ($mail, sha1($pass));
            }
        }
        return FALSE;
    }
    
    public static function logout(){
        session_start();
        unset($_SESSION['utente']);
        @session_destroy();
    }
}
