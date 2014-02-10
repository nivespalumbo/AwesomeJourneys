<?php
include_once 'model/Enumerations/ItineraryState.php';
include_once 'ItineraryState.php';
include_once 'ItineraryBrick.php';

class PartialItinerary extends ItineraryState{
    function __construct($creator, $name, $description, $id = NULL) {
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->description = $description;

        $this->bricks = array();
        
        if($id == NULL){
            parent::insertIntoDb();
        }
    }
    
    public function __sleep() {
        return array("id", "name", "description", 'startLocation', 'endLocation', "photo", "bricks", 'creator');
    }
    public function __wakeup() { }
    
    public function getType() {
        return PARTIAL;
    }

    public function complete(){
        if($this->isContiguous()){
            if($this->changeStateInDb(COMPLETE)){
                $itin = new PartialItinerary($this->creator, $this->name, $this->description, $this->id);
                $itin->setStartLocation($this->startLocation);
                $itin->setEndLocation($this->endLocation);
                $itin->setPhoto($this->photo);
                $itin->setBricks($this->bricks);
                return $itin;
            }
            else {
                return FALSE;
            }
        }
        return $this;
    }
//    public function manageActivityInStay($stayId) {
//        if(!array_key_exists($stayId, $this->itineraryBricks)){
//            return FALSE;
//        }
//        return $this->itineraryBricks[$stayId]->getActivity();
//    }

//    public function selectActivity($activityIdList, $stayId) {
//        
//    }

//    public function getStay($stayId) {
//        if(!isset($this->itineraryBricks[$stayId])){
//            return FALSE;
//        }else{
//            return $this->itineraryBricks[$stayId]->getStay($stayId);
//        }
//    }
    
    //DA MODIFICARE
//    public function save(ItineraryContext $itineraryContext) {
//        if(count($this->itineraryBricks) == 0){
//            return $this->stateChangeAndSave($itineraryContext, $creatorUserName, PARTIAL);
//        }
//        
//        $locationOfBrick = NULL;
//        $dateOfBrick = NULL;
//        
//        foreach($this->itineraryBricks as $brick){
//            if(!$brick->isContiguous($locationOfBrick, $dateOfBrick)){
//                return $this->stateChangeAndSave($itineraryContext, $creatorUserName, PARTIAL);
//            }
//            $locationOfBrick = $brick->getEndLocation();
//            $dateOfBrick = $brick->getEndDate();
//        }
//        return $this->updateInDB($creatorUserName);
//    }
//
//    //DA MODIFICARE
//    private function stateChangeAndSave($itineraryContext, $creatorUserName, $state) {
//            $partialItinerary = new PartialItinerary($this->id, $this->name, $this->description);
//            $partialItinerary->insertItineraryBrick($this->itineraryBricks);
//            if($partialItinerary->updateInDB($creatorUserName)){
//                $itineraryContext->setItineraty($partialItinerary);
//                return TRUE;
//            }
//            return FALSE;
//    }
//
//    public function newJourney() {
//        return FALSE;
//    }

}
