<?php
include_once 'Stay.php';
include_once 'Transfer.php';
/**
 * Description of ItineraryContext
 *
 * @author Antonio
 */
class ItineraryContext {
    private $itinerary;
    
    public function __construct(ItineraryState $itinerary) {
        $this->itinerary = $itinerary;
    }
    
    public function __sleep() {
        return array("itinerary");
    }
    public function __wakeup() { }
    
    public function getItinerary(){
        return $this->itinerary;
    }
    
    /**
     * Dato un template, inserisce una stay per ogni component=stay_template 
     * all'interno del template
     * @param StayTemplateComponent $template
     */
    public function addBrick(StayTemplateComponent $template){
        if($template->getType() == STAY_TEMPLATE){
            $brick = new Stay($template, $this->itinerary->getId());
            $this->itinerary->addBrick($brick);
        } else if($template->getType() == TRANSFER_TEMPLATE){
            $brick = new Transfer($template, $this->itinerary->getId());
            $this->itinerary->addBrick($brick);
        }
        $templates = $template->getCompositeTemplates();
        foreach($templates as $temp){
            $this->addBrick($temp);
        }
    }
    
    public function removeBrick($idBrick){
        $this->itinerary->removeBrick($idBrick);
    }
}
