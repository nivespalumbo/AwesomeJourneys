<?php

class ManagementController {
    public function getPersonalData(){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user;
    }
    
    public function newItinerary(){
        session_start();
        if(isset($_SESSION['utente'])){
            return TRUE;
        }
        return FALSE;
    }
    
    public function createItinerary($name, $description, $location){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->createItinerary($name, $description, $location);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
    public function insertStay($id){
        $user = unserialize($_SESSION['utente']);
        $user->addBrick($id);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
//    public function provideBasicInfo($itName, $itDesc, $itTagList, $itCategory){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        $user->provideBasicInfo($itName, $itDesc, $itTagList, $itCategory);
//        return TRUE;
//    }
    
//    public function selectStay($id){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        return $user->addBrick($id);
//        return TRUE;
//    }
    
    public function configureStayParameter($optId, $valId){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->configureStayParameter($optId, $valId);
        return TRUE;
    }
    
    public function manageActivityInStay($stayId){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        return $user->manageActivityInStay($stayId);
    }
    
    public function searchActivity(){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        return $user->searchActivity();
    }
    
    public function saveStay(){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->saveStay();
        return TRUE;
    }
    
    public function searchStay(){
        $searchController = new SearchController();
        return $searchController->searchStay();
    }
    
    public function removeActivity($idList){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->removeActivity($idList);
        return TRUE;
    }
}

?>
