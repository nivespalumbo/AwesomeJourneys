<?php

class ManagementController {
    public function getPersonalData(){
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
        if(isset($_SESSION['utente'])){
            return TRUE;
        }
        return FALSE;
    }
    
    public function createItinerary($name, $description){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->createItinerary($name, $description);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
    
    
    public function manageItinerary($id){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $model = $user->getItinerary($id);
        $_SESSION['utente'] = serialize($user);
        return $model;
    }
    
    public function removeItinerary($id){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->removeItinerary($id);
    }
    
    public function getStay($id){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->getStay($id);
    }
    
    public function getActivity($id){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        if(isset($_GET['idStay'])){
            return $user->getActivity($id, $_GET['idStay']);
        }
        return $user->getActivity($id);
    }
    
    public function getAccomodation($idStay, $idAccomodation){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->getAccomodation($idStay, $idAccomodation);
    }
    
    public function getBrick($id){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->getBrick($id);
    }
    
    public function getBrickActivity($idBrick, $idActivity){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->getBrickActivity($idBrick, $idActivity);
    }
    
    public function getBrickAccomodation($idBrick){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        return $user->getBrickAccomodation($idBrick);
    }
    
    
    public function addStay($id){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $model = $user->addBrick($id);
        $_SESSION['utente'] = serialize($user);
        return $model;
    }
    
    public function addTransport($id){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->addBrick($id);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
    public function modifyStay($idStay, $startDate, $endDate){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->modifyStay($idStay, $startDate, $endDate);
        $_SESSION['utente'] = serialize($user);
        return $user->getBrick($idStay);
    }
    
    public function removeStay($id){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->removeBrick($id);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
    public function addActivity($idStay, $idActivity){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $model = $user->addActivity($idStay, $idActivity);
        $_SESSION['utente'] = serialize($user);
        return $model;
    }
    
    public function addActivityFromTemplate($idStay, $idActivityTemplate){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $model = $user->addActivityFromTemplate($idStay, $idActivityTemplate);
        $_SESSION['utente'] = serialize($user);
        return $model;
    }
    
    public function modifyActivity($idStay, $idActivity){
        
    }
    
    public function removeActivity($idStay, $idActivity){
        if(!isset($_SESSION['utente'])){
            return FALSE;
        }
        $user = unserialize($_SESSION['utente']);
        $user->removeActivity($idStay, $idActivity);
        $_SESSION['utente'] = serialize($user);
        return $user->getItinerary();
    }
    
    public function addAccomodation($idStay, $idAccomodation){
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
