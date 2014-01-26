<?php

/**
 * Description of NavigationController
 *
 * @author Nives
 */
class NavigationController {
    private $model;
    
    function invoke(){
        if(isset($_GET['op'])){
            $this->gestioneGet($_GET['op']);
        }
        else if (isset($_POST['op'])) {
            $this->gestionePost($_POST['op']);
        }
        else {
            $this->home();
        }
    }
    
    private function gestioneGet($op){
        switch ($op) {
            case 'login' :
                break;
            case 'register' :
                break;
            case 'logout':
                break;
            
            
            case 'openSearch':
                break;
            
            
            case 'selectJourney':
                break;
            case 'selectItinerary' :
                break;
            case 'selectStay' :
                break;
            case 'selectActivity' :
                break;
            case 'selectAccomodation' :
                break;
            
            
        }
    }
    
    private function gestionePost($op){
        
    }
    
    private function home(){
        
    }
    
    private function error($message){
        
    }
}
