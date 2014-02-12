<?php
include_once 'SearchController.php';
include_once 'LogRegisterController.php';
include_once 'ManagementController.php';
    
class NavigationController {
    private $model;

    public function invoke(){
        if(isset($_GET['op']))
            $this->gestioneGET($_GET['op']);
        else if(isset($_POST['op']))
            $this->gestionePOST($_POST['op']);
        else
            $this->home();
    }

    public function gestioneGET($op){
        switch ($op){
            // LOG
            case 'openLogin' :
                $this->openLogin();
                break;
            case 'openRegister' :
                $this->openRegister();
                break;
            case 'logout' :
                $this->logout();
                break;
            
            // DATI PERSONALI
            case 'getPersonalData' :
                $this->getPersonalData();
                break;
            case 'myItinerariesOrJourneys':
                $this->searchMyItinerariesOrJourneys();
                break;

            // SEARCH ITINERARY OR JOURNEY
            case 'openSearch':
                $this->openSearch();
                break;
            case 'search' :
                $this->search();
                break;
            
            // VISUALIZZAZIONE OGGETTI
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
            
            // MANAGE ITINERARY BASE
            case 'openNewItinerary' :
                $this->openFormNewItinerary(); //per aprire form di inserimento basic info
                break;
            case 'manageItinerary' :
                $this->manageItinerary();
                break;
            case 'searchStays' :
                $this->searchStays(); // cerca stays inerenti all'itinerario
                break;
            case 'searchActivities':
                $this->searchActivities();
                break;
            case 'searchTransport':
                $this->searchTransport();
                break;
            case 'removeItinerary':
                $this->removeItinerary();
                break;
            case 'saveItinerary':
                $this->saveItinerary();
                break;
            
            case 'addStay' :
                $this->addStay();
                break;
            case 'setOptionStay':
                $this->openFormStay();
                break;
            case 'removeStay':
                $this->removeStay();
                break;
            
            case 'openFormTransport':
                $this->openFormTransport();
                break;
            case 'addTransport':
                $this->addTransport();
                break;
            
            case 'addActivity' :
                $this->addActivity();
                break;
            case 'addActivityFromTemplate' :
                $this->addActivityFromTemplate();
                break;
            case 'setOptionActivity' :
                $this->openFormActivity();
                break;
            case 'removeActivity' :
                $this->removeActivity();
                break;
            
            case 'addAccomodation' :
                $this->addAccomodation();
                break;
            case 'setOptionAccomodation':
                $this->openFormAccomodation();
                break;
            case 'removeAccomodation' :
                $this->removeAccomodatio();
                break;
        }
    }

    public function gestionePOST($op){
        switch ($op){
            case 'login' :
                $this->login();
                break;
            case 'register' :
                $this->register();
                break;
            case 'provideBasicInfo':
                $this->provideBasicInfo(); //l'utente ha inserito le info base, si crea l'itinerario e viene visualizzato
                break;
            case 'modifyStay':
                $this->modifyStay();
                break;
            case 'modifyActivity' :
                $this->modifyActivity();
                break;
            case 'modifyAccomodation' :
                $this->modifyAccomodation();
                break;
            case 'modifyTransport' :
                $this->modifyTransport();
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
     * DATI PERSONALI
     */
    
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
    
    
    
    /*
     * RICERCA GENERICA
     */
    
    private function openSearch(){
        require_once 'view/search.php';
    }
    
    private function search(){
        $c = new SearchController();
        $this->model = $c->search($_GET['startDate'], $_GET['location']);
        require_once 'view/search.php';
    }
    
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
        if($this->model = $c->createItinerary($_POST['name'], $_POST['description'])){
            require_once 'view/manage_itinerary.php';
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
    
    private function removeItinerary(){
        $c = new ManagementController();
        if($this->model = $c->removeItinerary($_GET['id'])){
            require_once 'view/area_riservata.php';
        }
        else {
            $this->error("Impossibile eliminare l'itinerario.");
        }
    }
    
    private function saveItinerary(){
        $c = new ManagementController();
        if($this->model = $c->saveItinerary()){
            require_once 'view/my_itineraries.php';
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
    
    private function searchTransport(){
        $c = new SearchController();
        if($this->model = $c->searchTransport($_GET['from'])){
            require_once 'view/transport_list.php';
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
    
    private function addTransport(){
        $c = new ManagementController();
        if($this->model = $c->addTransport($_GET['id'])){
            require_once 'view/personalize_transport.php';
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
    
    private function openFormTransport(){
        $c = new ManagementController();
        if($this->model = $c->getBrick($_GET['id'])){
            require_once 'view/personalize_transport.php';
        }
        else {
            $this->error("Sessione inesistente.");
        }
    }
    
    private function modifyStay(){
        $c = new ManagementController();
        if($this->model = $c->modifyStay($_POST['idStay'], $_POST['startDate'], $_POST['endDate'])){
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
        if($this->model['activity'] = $c->addActivity($_GET['idStay'], $_GET['id'])){
            $this->model['idStay'] = $_GET['idStay'];
            require_once 'view/personalize_activity.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function addActivityFromTemplate(){
        $c = new ManagementController();
        if($this->model['activity'] = $c->addActivityFromTemplate($_GET['idStay'], $_GET['id'])){
            $this->model['idStay'] = $_GET['idStay'];
            require_once 'view/personalize_activity.php';
        }
        else {
            $this->error("Errore");
        }
    }
    
    private function openFormActivity(){
        $c = new ManagementController();
        if($this->model['activity'] = $c->getBrickActivity($_GET['idStay'], $_GET['idActivity'])){
            $this->model['idStay'] = $_GET['idStay'];
            require_once 'view/personalize_activity.php';
        }
        else {
            $this->error("Sessione inesistente.");
        }
    }
    
    private function modifyActivity(){
        $c = new ManagementController();
        if($this->model['activity'] = $c->modifyActivity($_POST['idStay'], $_POST['idActivity'])){
            $this->model['idStay'] = $_POST['idStay'];
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
        if($this->model['accomodation'] = $c->addAccomodation($_GET['idStay'], $_GET['id'])){
            $this->model['idStay'] = $_GET['idStay'];
            require_once 'view/personalize_accomodation.php';
        }
        else {
            $this->error("Errore");
        }
    } 
    
    private function openFormAccomodation(){
        $c = new ManagementController();
        if($this->model['accomodation'] = $c->getBrickAccomodation($_GET['id'])){
            $this->model['idStay'] = $_GET['id'];
            require_once 'view/personalize_accomodation.php';
        }
        else {
            $this->error("Sessione inesistente.");
        }
    }
    
    private function modifyAccomodation(){
        $c = new ManagementController();
        if($this->model['accomodation'] = $c->modifyAccomodation($_POST['idStay'])){
            $this->model['idStay'] = $_POST['idStay'];
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
    
    private function modifyTransport(){
        $this->error("Funzionalità non implementata.");
    }
    
    
    
    /*
     * VISUALIZZAZIONE SCHEDA INFO OGGETTI
     */
    
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
}
    
?>
