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
            case 'openLogin' :
                $this->openLogin();
                break;
            case 'openRegister' :
                $this->openRegister();
                break;
            case 'logout' :
                $this->logout();
                break;
            
            case 'openNewItinerary' :
                $this->openFormNewItinerary();
                break;
            case 'provideBasicInfo':
                $this->provideBasicInfo();
                break;
            
            case 'getPersonalData' :
                $this->getPersonalData();
                break;
            
            case 'searchStays' :
                $this->searchStays();
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
            case 'addActivity' :
                $this->addActivity();
                break;
            case 'modifyActivity' :
                $this->modifyActivity();
                break;
            case 'deleteActivity' :
                $this->deleteActivity();
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
        }
    }
    
    private function error($message){
        $this->model = $message;
        require_once 'view/error.php';
    }
    
    private function home(){
        $c = new SearchController();
        $this->model = $c->searchJourneys();
        require_once("view/home.php");
    }
    
    
    
    /*
     * LOG
     */

    private function openLogin(){
        require_once("view/form_login.php");
    }
    
    private function login(){
        $c = new LogRegisterController();
        if($c->login($_POST['mail'], $_POST['pass'])){
            require_once("view/area_riservata.php");
        }
        else {
            $this->error("Login fallito");
        }
    }
    
    private function openRegister(){
       require_once("view/form_register.php"); 
    }
    
    private function register(){
        $c = new LogRegisterController();
        
        if($c->register($_POST['name'], $_POST['surname'], $_POST['address'], $_POST['telephone'], $_POST['mail'], $_POST['pass'], $_POST['passBis'])){
            require_once("view/area_riservata.php");
        }
        else{
            $this->error("Registrazione fallita");
        }
    }
    
    private function logout(){
        $c = new LogRegisterController();
        $c->logout();
        $this->home();
    }
    
    
    
    /*
     * ITINERARY
     */
    
    private function openFormNewItinerary(){
        $c = new ManagementController();
        if($this->model = $c->newItinerary()){
            require_once 'view/new_itinerary.php';
        }
        else{
            $this->error("Sessione inesistente.");
        }
    }
    
    private function provideBasicInfo(){
        $c = new ManagementController();
        if($this->model = $c->createItinerary($_GET['name'], $_GET['description'])){
            require_once 'view/itinerary.php';
        }
        else{
            $this->error("Errore");
        }
    }
    
    private function searchStays(){
        $c = new SearchController();
        if($this->model = $c->searchStays()){
            require_once 'view/stay_list.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function getPersonalData(){
        $c = new ManagementController();
        if($this->model = $c->getPersonalData()){
            require_once 'view/manage_account.php';
        }
        else {
            $this->error("Sessione inesistente");
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
    
    public function addActivity(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else {
            $user = unserialize($_SESSION['utente']);
            $this->model = $user->getActivity($_GET['id']);
        }
    }
    
    public function modifyActivity(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else {
            $user = unserialize($_SESSION['utente']);
            
        }
    }
    
    public function deleteActivity(){
        session_start();
        if(!isset($_SESSION['utente'])){
            $this->model = "SESSIONE INESISTENTE";
            require_once 'view/error.php';
        }
        else {
            $c = new ManagementController();
        }
    }
    
}
    
?>
