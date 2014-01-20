<?php
include_once 'StayTemplateComponent.php';

/**
 * Description of TransferTemplate
 *
 * @author anto
 */
class TransferTemplateComposite extends StayTemplateComponent{
    function __construct($id) {
        $this->id = $id;
        $this->type = TRANSFER_TEMPLATE;
        $this->components = array();
    }
    
    public function addComponent(StayTemplateComponent $component) {
        if($component->getType() == TRANSFER || $component->getType() == TRANSFER_TEMPLATE){
            $this->components[$component->getId()] = $component;
        }
    }

    public function getAccomodation() {
        return FALSE;
    }

    public function getActivities() {
        return FALSE;
    }

    public function getComposite() {
        return FALSE;
    }
    
    private function getTransportInArray($transports){
        foreach($this->components as $component){
            if($component->getType() == TRANSFER){
                $transports[$component->getId()] = $component;
            }else if($component->getType() == TRANSFER_TEMPLATE){
                $component->getTransportInArray($transports);
            }
        }
        return $transports;
    }

    public function getTransports() {
        $ris = array();
        return $this->getTransportInArray($ris);
    }
    
    public function newItineraryBick() {
        return new Transfer(-1, $this);
    }

}
