<?php
include_once 'ItineraryState.php';
include_once 'ItineraryBrickLeaf.php';
/* COVENZIONE:
 * 
 * La classe può rappresentare un itinerario incompleto, può essere utilizzata 
 * per inserire una stay (tappa) con il transfer (tappa di spostamento) per 
 * raggiungerla in un itinerario, oppure per inserire un transfer in un itinerario.
 * 
 *   CASO UTILIZZO PER UNA TAPPA\TRANSFER:
 * 
 *   - id è l'identificativo della stay o del transfer contenuta/o.
 * 
 *   - Se presente la tappa di spostamento che rappresenta il viaggio per raggiungere
 *      la destinazione rappresentata da id, deve essere inserita nella posizione
 *      itineraryComponents[0], la tappa rappresentata da id deve essere contenuta
 *      in itineraryComponents[1].
 * 
 *   - Se non è presente il transfer rappresentante il viaggio per raggiungere la tappa
 *      id, allora la tappa è nella posizione itineraryComponents[0].
 * 
 *   - Tutte le tappe transfer effettuate a partire dalla tappa rappresentata da id,
 *      e che hanno come meta la stessa tappa devono essere inserite successivamente
 *      alla tappa interessata, ovvero a partire dalla posizione itineraryComponents[2].
 *  
 *   - Non deve essere presente il transfer rappresentante lo spostamento che porta alla 
 *      tappa successiva.
 * 
 *   - La tappa rappresentata da id può essere un transfer contenuto nella posizione 
 *     itineraryComponents[0].
 * 
 *   CASO UTILIZZO PER RAPPRESENTARE UN ITINERARIO NON COMPLETO:
 * 
 *   - id è l'identificativo dell'itineriario.
 * 
 *   - itineraryComponents rappresenta una lista di stay o transfer incapsulate in
 *      ConcreteStatePartialItinerary
 *   
 */

class ConcreteStatePartialItinerary implements ItineraryState{
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
    
    public function getStartLocation(){
        if($this->numTappe == 0){
            return NULL;
        }
        $startLocation = $this->itineraryComponents[0]->getStartLocation();
        
        if($startLocation == NULL){
            return $this->itineraryComponents[0]->getLocation();
        }
        
        return $startLocation;
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
            return NULL;
        return $this->itineraryComponents[$stayId]->ricercaTappa($stayId);
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

    public function getNumTappe() {
        return $this->numTappe;
    }
    
    public function setItineraryComponents($itineraryComponents){
        $this->itineraryComponents = $itineraryComponents;
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
