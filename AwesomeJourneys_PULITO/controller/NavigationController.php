<?php

include_once 'SearchController.php';
include_once 'ManagementController.php';
include_once 'LogRegisterController.php';

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
            case 'areaRiservata' :
                $this->openLogin();
                break;
            case 'register' :
                $this->openRegister();
                break;
            case 'logout':
                $this->logout();
                break;
            
            
            case 'openSearch':
                $this->openSearch();
                break;
            case 'search':
                $this->search();
                break;
            
            
            case 'selectJourney':
                $this->selectJourney();
                break;
            case 'selectItinerary' :
                $this->selectItinerary();
                break;
            case 'selectStay' :
                $this->selectStay();
                break;
            case 'selectActivity' :
                $this->selectActivity();
                break;
            case 'selectAccomodation' :
                $this->selectAccomodation();
                break;
            
            
            case 'getPersonalData':
                $this->getPersonalData();
                break;
            case 'searchMyItinerariesOrJourneys' :
                $this->searchMyItinerariesOrJourneys();
                break;
            
            
            case 'createItinerary':
                break;
            case 'modifyItinerary':
                break;
            case 'removeItinerary':
                break;
            
            
            case 'addBrick':
                break;
            case 'modifyBrick':
                break;
            case 'removeBrick':
                break;
            
            case 'addActivity':
                break;
            case 'addActivityFromTemplate':
                break;
            case 'modifyActivity':
                break;
            case 'removeActivity':
                break;
            
            case 'addAccomodation':
                break;
            case 'modifyAccomodation':
                break;
            case 'removeAccomodation':
                break;
            
            case 'addTransport':
                break;
            case 'modifyTransport':
                break;
            case 'removeTransport':
                break;
        }
    }
    
    private function gestionePost($op){
        switch ($op){
            case 'login':
                $this->login();
                break;
            case 'register':
                $this->register();
                break;
        }
    }
    
    private function home(){
        $c = new SearchController();
        $this->model = $c->searchJourneys();
        require_once 'view/home.php';
    }
    
    private function error($message){
        $this->model = $message;
        require_once 'view/error.php';
    }
    
    
    
    // LOG
    
    private function openLogin(){
        $c = new LogRegisterController();
        if($c->isAuthenticated()){
            require_once 'view/area_riservata.php';
        }
        else {
            require_once 'view/form_login.php';
        }
    }
    
    private function openRegister(){
        require_once 'view/form_register.php';
    }
    
    private function logout(){
        $c = new LogRegisterController();
        $c->logout();
        $this->home();
    }
    
    private function login(){
        $c = new LogRegisterController();
        if($c->login($_POST['mail'], $_POST['pass'])){
            require_once 'view/area_riservata.php';
        }
        else{
            $this->error("Login fallito. Riprovare.");
        }
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
    
    // SEARCHES
    
    private function openSearch(){
        require_once 'view/search.php';
    }
    
    private function search(){
        $c = new SearchController();
        $this->model = $c->search($_GET['startDate'], $_GET['location']);
        require_once 'view/search.php';
    }
    
    // SELECT OBJECTS (VISUALIZZAZIONE PAGINE INFORMATIVE
    
    private function selectJourney(){
        $c = new SearchController();
        $this->model = $c->getJourney($_GET['id']);
        require_once 'view/journey.php';
    }
    
    private function selectItinerary(){
        $c = new SearchController();
        $this->model = $c->getItinerary($_GET['id']);
        require_once 'view/itinerary.php';
    }
    
    private function selectStay(){
        $c = new ManagementController();
        if($this->model = $c->getStay($_GET['id'])){
            require_once 'view/stay.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function selectActivity(){
        $c = new ManagementController();
        if($this->model = $c->getActivity($_GET['id'])){
            require_once 'view/activity.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function selectAccomodation(){
        $c = new ManagementController();
        if($this->model = $c->getAccomodation($_GET['idStay'], $_GET['idAccomodation'])){
            require_once 'view/accomodation.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    // DATI PERSONALI
    
    private function getPersonalData(){
        $c = new ManagementController();
        if($this->model = $c->getPersonalData()){
            require_once 'view/manage_account.php';
        }
        else {
            $this->error("Sessione inesistente");
        }
    }
    private function searchMyItinerariesOrJourneys(){
        session_start();
        if(isset($_SESSION['utente'])){
            $user = unserialize($_SESSION['utente']);
            $c = new SearchController();
            $this->model = array();
            $this->model['itineraries'] = $c->searchMyItineraries($user);
            $this->model['journeys'] = $c->searchMyJourneys($user);
            require_once 'view/my_itineraries.php';
        }
        else {
            $this->error("Sessione inesistente.");
        }
    }
    
    // MANAGE ITINERARY
    
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
        if($this->model = $c->createItinerary($_POST['name'], $_POST['description'], $_POST['location'])){
            require_once 'view/itinerary.php';
        }
        else{
            $this->error("Errore");
        }
    }
    
    private function manageItinerary(){
        $c = new ManagementController();
        if($this->model = $c->manageItinerary($_GET['id'])){
            require_once 'view/manage_itinerary.php';
        }
        else {
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
    
    private function searchActivities(){
        $c = new SearchController();
        if($this->model['activities'] = $c->searchActivities()){
            $this->model['stay'] = $_GET['idStay'];
            require_once 'view/activity_list.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function addStay(){
        $c = new ManagementController();
        if($this->model = $c->addStay($_GET['id'])){
            require_once 'view/personalize_stay.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function openFormStay(){
        $c = new ManagementController();
        if($this->model = $c->getBrick($_GET['id'])){
            require_once 'view/personalize_stay.php';
        }
        else {
            $this->error("Sessione inesistente.");
        }
    }
    
    private function modifyStay(){
        $c = new ManagementController();
        if($this->model = $c->modifyStay($_POST['id'])){
            require_once 'view/personalize_stay.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function removeStay(){
        $c = new ManagementController();
        if($this->model = $c->removeStay($_GET['id'])){
            require_once 'view/manage_itinerary.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function addActivity(){
        $c = new ManagementController();
        if($this->model = $c->addActivity($_GET['idStay'], $_GET['id'])){
            require_once 'view/personalize_activity.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function openFormActivity(){
        $c = new ManagementController();
        if($this->model = $c->getBrickActivity($_GET['idStay'], $_GET['idActivity'])){
            require_once 'view/personalize_activity.php';
        }
        else {
            $this->error("Sessione inesistente.");
        }
    }
    
    private function modifyActivity(){
        $c = new ManagementController();
        if($this->model = $c->modifyActivity($_POST['idStay'], $_POST['idActivity'])){
            require_once 'view/personalize_activity.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function removeActivity(){
        $c = new ManagementController();
        if($this->model = $c->removeActivity($_GET['idStay'], $_GET['idActivity'])){
            require_once 'view/manage_itinerary.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function addAccomodation(){
        $c = new ManagementController();
        if($this->model = $c->addAccomodation($_GET['idStay'], $_GET['idAccomodation'])){
            require_once 'view/personalize_accomodation.php';
        }
        else {
            $this->error("Errore");
        }
    } 
    
    private function openFormAccomodation(){
        $c = new ManagementController();
        if($this->model = $c->getBrickAccomodation($_GET['id'])){
            require_once 'view/personalize_accomodation.php';
        }
        else {
            $this->error("Sessione inesistente.");
        }
    }
    
    private function modifyAccomodation(){
        $c = new ManagementController();
        if($this->model = $c->modifyAccomodation($_POST['idStay'], $_POST['idAccomodation'])){
            require_once 'view/personalize_accomodation.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function removeAccomodation(){
        $c = new ManagementController();
        if($this->model = $c->removeAccomodation($_GET['id'])){
            require_once 'view/manage_itinerary.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
}
