<?php
include_once 'ItineraryState.php';
include_once 'ItineraryBrickLeaf.php';



class CompleteItinerary implements ItineraryState{
    private $id;
    private $name;
    private $description;
    private $category;
    private $tag;
    private $photo;
    private $creator;
    private $numTappe;
    private $itineraryComponents;
    
    function __construct($id = NULL, $name = NULL, $description = NULL, $category = NULL, $tag = NULL, $photo = NULL, $creator = NULL) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->tag = $tag;
        $this->photo = $photo;
        $this->creator = $creator;
        $this->numTappe = 0;
        $this->itineraryComponents = array();
    }
    
    /*
     * Restituisce un array contenete tutte le tappe ed i trasporti
     */
    public function visualizza_tappe(){
        $ris = array();
        foreach ($this->itineraryComponents as $elemento) {
            $tappe = $elemento->visualizza_tappe();
            foreach($tappe as $tappa){
                $ris[$tappa->getId()] = $tappa;
            }
        }
       return $ris;                     
    }
    
    public function get_name(){
        return $this->name;
    }
    
    public function get_description(){
        return $this->description;
    }
    
    public function get_category(){
        return$this->category;
    }
    
    public function get_tag(){
        return $this->tag;
    }
    
    public function get_photo(){
        return $this->photo;
    }
    
    public function get_creator(){
        return $this->creator;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getItineraryComponents(){
        return $this->itineraryComponents;
    }
    
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function setDescription($description){
        $this->name = $description;
    }
    
    public function setCategory($category){
        $this->name = $category;
    }
    
    public function setTag($tag){
        $this->name = $tag;
    }
    
    public function setPhoto($photo){
        $this->name = $photo;
    }
    
    public function setCreator($creator){
        $this->creator = $creator;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getStartLocation(){
        if($this->numTappe == 0){
            return NULL;
        }
        $startLocation = $this->itineraryComponents[0]->getStartLocation();
        
        if($startLocation == FALSE){
            return $this->itineraryComponents[0]->getLocation();
        }
        
        return $startLocation;
    }
    
    public function getEndLocation(){
        if($this->numTappe == 0){
            return NULL;
        }
        $endLocation = $this->itineraryComponents[0]->getStartLocation();
        
        if($endLocation == FALSE){
            return $this->itineraryComponents[0]->getLocation();
        }
        
        return $endLocation;
    }
    
    /*Inserisce una tappa oppure una composizione di tappe all'interno
     * della composizione.
     */
    public function aggiungiTappa($itineraryComponent) {
       $idTappa = $itineraryComponent->getId();
        if(isset($this->itineraryComponents[$idTappa])){
            $this->itineraryComponents[$idTappa]->aggiungiTappaSpostamento($itineraryComponent);
        }
        else{
            $this->itineraryComponents[$idTappa]= $itineraryComponent;
        }
       $this->numTappe++;
    }
    
    public function aggiungiTappaSpostamento($tappa){
        $idTappa = $tappa->getId();
        if(isset($this->itineraryComponents[$idTappa])){
            $this->itineraryComponents[$idTappa]->aggiungiTappaSpostamento($tappa);
        }
        else{
            $this->itineraryComponents[$idTappa]= $tappa;
        }
        $this->numTappe++;
    }
    
    public function eliminaTappa() {
       
    }
    
    public function ricercaTappa($stayId) {
        if(!isset($this->itineraryComponents[$stayId]))
            return FALSE;
        return $this->itineraryComponents[$stayId]->ricercaTappa($stayId);
    }

    public function getNumTappe() {
        return $this->numTappe;
    }

    public function manageActivityInStay($stayId) {
        if(!isset($this->itineraryComponents[stayId]))
            return FALSE;
        return $this->itineraryComponents[stayId]->getActivity();
    }

    public function selectActivity($activityIdList, $stayId) {
        
    }

    public function getStay($stayId) {
        if(!isset($this->itineraryComponents[$stayId])){
            return FALSE;
        }else{
            return $this->itineraryComponents[$stayId]->getStay($stayId);
        }
    }
    
}

?>
