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
                $this->openFormNewItinerary();
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
            case 'searchStay' :
                $this->searchStay();
                break;
            case 'selectItinerary' :
                $this->selectItinerary();
                break;
            case 'selectStay' :
                $this->selectStay();
                break;
            case 'insertStay' :
                $this->insertStay();
                break;
            case 'selectActivity' :
                $this->selectActivity();
                break;
            case 'selectAccomodation' :
                $this->selectAccomodation();
                break;
        }
    }

    public function gestionePOST(){
        switch ($_POST['op']){
            case 'login' :
                $this->login();
                break;
            case 'register' :
                $this->register();
                break;
            case 'basicInfoItinerary' :
                $this->provideBasicInfo();
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
    
    public function openFormRegister(){
       require_once("view/form_register.php"); 
    }
    
    public function login(){
        $c = new LogRegisterController();
        $user = $c->login($_POST['mail'], $_POST['pass']);
        if($user){
            $_SESSION['utente'] = serialize($user);
        }
        require_once("view/area_riservata.php");
    }
    
    public function logout(){
        $c = new LogRegisterController();
        $c->logout();
        $this->home();
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
    
    public function openFormNewItinerary(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once("view/error.php");
        } else {
            require_once("view/new_itinerary.php");
        }
    }
    
    public function provideBasicInfo(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once("view/error.php");
        }else{
            $user = unserialize($_SESSION['utente']);
            $c = new ManagementController();
            $c->createItinerary($user);
                
            $this->model = $user->getItinerary();
            require_once("view/itinerary.php");
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
    
    public function searchStay(){
        $c = new SearchController();
        $this->model = $c->searchStay();
        require_once 'view/stay_list.php';
    }
    
    public function selectItinerary(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else {
            $user = unserialize($_SESSION['utente']);;
            $this->model = $user->getItinerary($_GET['id']);
            $_SESSION['utente'] = serialize($user);
            require_once 'view/itinerary.php';
        }
    }
    
    public function selectStay(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else {
            $user = unserialize($_SESSION['utente']);
            $this->model = $user->getStay($_GET['id']);
            $_SESSION['utente'] = serialize($user);
            require_once 'view/stay.php';
        }
    }
    
    public function insertStay(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else {
            $c = new ManagementController();
            $this->model = $c->insertStay($_GET['id']);
            require_once 'view/itinerary.php';
        }
    }
    
    public function selectActivity(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else {
            $user = unserialize($_SESSION['utente']);
            $this->model = $user->selectActivity($_GET['idStay'], $_GET['idActivity']);
            require_once 'view/activity.php';
        }
    }
    
    public function selectAccomodation(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else {
            $user = unserialize($_SESSION['utente']);
            $this->model = $user->selectAccomodation($_GET['idStay'], $_GET['idAccomodation']);
            require_once 'view/accomodation.php';
        }
    }
    
}
    
?>
