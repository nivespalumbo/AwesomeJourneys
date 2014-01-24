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
            if($us->role == 'customer'){
                return self::concreteUserComponent(session_id (), $us->mail, $us->name, $us->surname, $us->address, $us->telephone);
            } else {
                return self::travelAgent(session_id (), $us->mail, $us->name, $us->surname, $us->address, $us->telephone);
            }
        } 
        return FALSE;
    }
    
    public static function register($name, $surname, $address, $tel, $mail, $pass, $passBis) {
        $conn = new Connection();
        if($pass === $passBis){
            $rx = $conn->registra($name, $surname, $address, $tel, $mail);
            if($rx){
                $conn->new_creator ($mail, sha1($pass));
                return self::login ($mail, sha1($pass));
            }
        }
        return FALSE;
    }
    
    private static function concreteUserComponent($id, $mail, $name, $surname, $address, $telephone){
        return new ConcreteUserComponent($id, $mail, $name, $surname, $address, $telephone);
    }
    
    private static function travelAgent($id, $mail, $name, $surname, $address, $telephone){
        return new TravelAgent(self::concreteUserComponent($id, $mail, $name, $surname, $address, $telephone));
    }
    
    public static function logout(){
        session_start();
        unset($_SESSION['utente']);
        @session_destroy();
    }
    
    abstract function getRole();
    abstract function getName();
    abstract function getSurname();
    abstract function getAddress();
    abstract function getTelephone();
    abstract function getMail();
    abstract function setAddress($address);
    abstract function setTelephone($telephone);
    
//    abstract function searchStay();
//    abstract function getStaySearchResult();
//    abstract function getStay($id);
//    abstract function searchActivity($query = NULL);
//    abstract function getActivitySearchResult();
//    abstract function getActivity($id);
//    abstract function createItinerary();
//    abstract function provideBasicInfo($itName, $itDesc);
//    abstract function searchItinerary($query = NULL);
//    abstract function getItinerarySearchResult();
//    abstract function getItinerary($id = NULL);
//    abstract function searchJourney($query = NULL);
//    abstract function getJourneySearchResult();
//    abstract function getJourney($id);
//    abstract function insertStay($id);
}
?>
