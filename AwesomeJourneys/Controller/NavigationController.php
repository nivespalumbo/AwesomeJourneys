<?php
include_once 'SearchController.php';
include_once 'LogRegisterController.php';
include_once 'ManagementController.php';
    
class NavigationController {
    private $model;

    public function invoke(){
        if(isset($_GET['op']))
            $this->gestioneGET();
        else if(isset($_POST['op']))
            $this->gestionePOST();
        else
            $this->home_sito();
    }

    public function gestioneGET(){
        switch ($_GET['op']){
            case 'register' :
                $this->form_register();
                break;
            case 'login' :
                $this->form_login();
                break;
            case 'logout' :
                $this->logout();
                break;
            case 'newItiner' :
                $this->newItinerary();
                break;
            case 'personalData' :
                $this->getPersonalData();
                break;
            case 'myItiner':
                $this->myItineraries();
                break;
            case 'searchItiner':
                break;
        }
    }

    public function home_sito(){
        $c = new SearchController();
        
        $this->model = $c->home_sito();

        require_once("view/home_sito.php");
    }

    public function form_login(){
        $c = new SearchController();
        
        $this->model = $c->home_sito();

        require_once("view/form_login.php");
    }
    
    public function logout(){
        $c = new LogRegisterController();
        $c->logout();
        $this->home_sito();
    }

    public function form_register(){
       require_once("view/form_register.php"); 
    }

    public function gestionePOST(){
        switch ($_POST['op']){
            case 'login' :
                $this->login();
                break;
            case 'register' :
                $this->register();
                break;
        }
    }
    
    public function login(){
        $c = new LogRegisterController();
        //$this->model = $c->login($_POST['mail'], $_POST['pass']);
        $u = $c->login($_POST['mail'], $_POST['pass']);
        if($u){
            $_SESSION['utente'] = serialize($u);
        }
        require_once("view/area_riservata.php");
    }
    
    public function register(){
        $c = new LogRegisterController();
        
        if($c->register($_POST['name'], $_POST['surname'], $_POST['address'], $_POST['telephone'], $_POST['mail'], $_POST['pass'], $_POST['passBis'])){
            require_once("view/area_riservata.php");
        }
        else{
            $this->model = "REGISTRAZIONE FALLITA";
            require_once("view/error.php");
        }
    }
    
    public function newItinerary(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once("view/error.php");
        }else{
            $user = unserialize($_SESSION['utente']);
            $c = new ManagementController();
            $ris = $c->createItinerary($user);

            if($ris == FALSE){
                $this->model = "An error occured";
                require_once("view/error.php");
            }else{
                require_once("view/new_itinerary.php");
            }
        }
    }
    
    public function getPersonalData(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once("view/error.php");
        }else{
            require_once 'view/manage_account.php';
        }
    }
    
    public function myItineraries(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else{
            $user = unserialize($_SESSION['utente']);
            $user->setSearchResultItineraryOrJourney();
            $this->model = array();
            $this->model['journeys'] = $user->searchJourneys();
            $this->model['itineraries'] = $user->searchItineraries();
                
            require_once 'view/my_itineraries.php';
        }
    }
    
}
    
?>
