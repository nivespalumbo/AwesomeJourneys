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
            $this->home();
    }

    public function gestioneGET(){
        switch ($_GET['op']){
            case 'register' :
                $this->openFormRegister();
                break;
            case 'login' :
                $this->openFormLogin();
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
            case 'myItinerariesOrJourneys':
                $this->searchMyItinerariesOrJourneys();
                break;
            case 'searchItineraryOrJourney':
                $this->openSearch();
                break;
            case 'search' :
                $this->search();
                break;
        }
    }

    public function home(){
        $c = new SearchController();
        
        $this->model = $c->home();

        require_once("view/home_sito.php");
    }

    public function openFormLogin(){
        require_once("view/form_login.php");
    }
    
    public function logout(){
        $c = new LogRegisterController();
        $c->logout();
        $this->home();
    }

    public function openFormRegister(){
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
        $user = $c->login($_POST['mail'], $_POST['pass']);
        if($user){
            $_SESSION['utente'] = serialize($user);
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
    
    public function searchMyItinerariesOrJourneys(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else{
            $c = new SearchController();
            $this->model = array();
            $this->model['itineraries'] = $c->searchMyItineraries();
            $this->model['journeys'] = $c->searchMyJourneys();
            
            require_once 'view/my_itineraries.php';
        }
    }
    
    public function openSearch(){
        require_once 'view/search.php';
    }
    
    public function search(){
        $c = new SearchController();
        $this->model = $c->search();
        require_once 'view/search.php';
    }
    
}
    
?>
