<?php
include_once 'model/AJConnection.php';
include_once 'ConcreteUserComponent.php';
include_once 'TravelAgent.php';

abstract class UserComponent{   
    public static function login($mail, $pass){
        $conn = new AJConnection();
        $us = $conn->verificaLogin($mail, sha1($pass));
        $conn->close();
        if($us != FALSE){
            session_start();
            if($us->role == 'customer'){
                return new ConcreteUserComponent(session_id (), $us->mail, $us->name, $us->surname, $us->address, $us->telephone);
            } else {
                return new TravelAgent(new ConcreteUserComponent(session_id (), $us->mail, $us->name, $us->surname, $us->address, $us->telephone));
            }
        } 
        return FALSE;
    }
    
    public static function register($name, $surname, $address, $tel, $mail, $pass, $passBis) {
        $conn = new AJConnection();
        if($pass === $passBis){
            $rx = $conn->registra($name, $surname, $address, $tel, $mail);
            if($rx){
                $conn->newCreator ($mail, sha1($pass));
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
    
    abstract function getRole();
    abstract function getName();
    abstract function getSurname();
    abstract function getAddress();
    abstract function getTelephone();
    abstract function getMail();
    
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
