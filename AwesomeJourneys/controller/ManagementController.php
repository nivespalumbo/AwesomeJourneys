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
    
    /*
     * MANAGE ITINERARY BASE
     */
    
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
    
    
    
    public function manageItinerary($id){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $model = $user->getItinerary($id);
        $_SESSION['utente'] = serialize($user);
        return $model;
    }
    
    public function getStay($id){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->getStay($id);
    }
    
    public function getActivity($idStay, $idActivity){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->getActivity($idStay, $idActivity);
    }
    
    public function getAccomodation($idStay, $idAccomodation){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->getAccomodation($idStay, $idAccomodation);
    }
    
    
    
    public function addStay($id){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->addBrick($id);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
    public function modifyStay($id){
        
    }
    
    public function removeStay($id){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->removeBrick($id);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
    public function addActivity($idStay, $idActivity){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $model = $user->addActivity($idStay, $idActivity);
        $_SESSION['utente'] = serialize($user);
        return $model;
    }
    
    public function modifyActivity($idStay, $idActivity){
        
    }
    
    public function removeActivity($idStay, $idActivity){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->removeActivity($idStay, $idActivity);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
    public function addAccomodation($idStay, $idAccomodation){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $model = $user->addAccomodation($idStay, $idAccomodation);
        $_SESSION['utente'] = serialize($user);
        return $model;
    }
    
    public function modifyAccomodation($idStay, $idAccomodation){
        
    }
    
    public function removeAccomodation($idStay){
        session_start();
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->removeAccomodation($idStay);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
//    public function selectStay($id){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        return $user->addBrick($id);
//        return TRUE;
//    }
    
//    public function configureStayParameter($optId, $valId){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        $user->configureStayParameter($optId, $valId);
//        return TRUE;
//    }
//    
//    public function manageActivityInStay($stayId){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        return $user->manageActivityInStay($stayId);
//    }
//    
//    
//    
//    public function saveStay(){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        $user->saveStay();
//        return TRUE;
//    }

//    
//    public function removeActivity($idList){
//        if(!isset($_SESSION['utente']))
//            return FALSE;
//        $user = unserialize($_SESSION['utente']);
//        $user->removeActivity($idList);
//        return TRUE;
//    }
}

?>
