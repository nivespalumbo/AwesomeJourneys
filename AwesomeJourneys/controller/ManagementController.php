<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManagementController
 *
 * @author anto
 */
class ManagementController {
    public function createItinerary($user){
        $user->createItinerary();
        return TRUE;
    }
    
    public function provideBasicInfo($itName, $itDesc, $itTagList, $itCategory){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        $user->provideBasicInfo($itName, $itDesc, $itTagList, $itCategory);
        return TRUE;
    }
    
    public function selectStay($id){
        if(!isset($_SESSION['utente']))
            return FALSE;
        $user = unserialize($_SESSION['utente']);
        return $user->selectStay($id);
        return TRUE;
    }
    
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
