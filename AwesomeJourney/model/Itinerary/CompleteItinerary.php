<?php
include_once 'model/Enumerations/ItineraryState.php';
include_once 'ItineraryState.php';
include_once 'ItineraryBrick.php';



class CompleteItinerary extends ItineraryState{
    function __construct($creator, $id = NULL, $name = NULL, $description = NULL) {
        $this->name = $name;
        $this->description = $description;
        $this->photo = NULL;
        $this->numBrick = 0;
        $this->itineraryBrick = array();
        $this->type = COMPLETE;
        if($id == NULL){
            $this->id = -1;
            $this->insertInDB($creator);
        }else{
            $this->id = $id;
        }
    }

    public function manageActivityInStay($stayId) {
        if(!isset($this->itineraryBrick[$stayId])){
            return FALSE;
        }
        return $this->itineraryBrick[$stayId]->getActivity();
    }

    public function selectActivity($activityIdList, $stayId) {
        
    }

    public function getStay($stayId) {
        if(!isset($this->itineraryBrick[$stayId])){
            return FALSE;
        }else{
            return $this->itineraryBrick[$stayId]->getStay($stayId);
        }
    }

    public function newJourney() {
        
    }
    
    public function save(ItineraryContext $itineraryContext) {
        if(count($this->itineraryBrikc) == 0){
            return $this->stateChangeAndSave($itineraryContext, $creatorUserName, PARTIAL);
        }
        
        $locationOfBrick = NULL;
        $dateOfBrick = NULL;
        
        foreach($this->itineraryBrick as $brick){
            if(!$brick->isContiguous($locationOfBrick, $dateOfBrick)){
                return $this->stateChangeAndSave($itineraryContext, $creatorUserName, PARTIAL);
            }
            $locationOfBrick = $brick->getEndLocation();
            $dateOfBrick = $brick->getEndDate();
        }
        return $this->updateInDB($creatorUserName);
    }

    private function stateChangeAndSave($itineraryContext, $creatorUserName, $state) {
            $partialItinerary = new PartialItinerary($this->id, $this->name, $this->description);
            $partialItinerary->setItineraryBrick($this->itineraryBrick);
            if($partialItinerary->updateInDB($creatorUserName)){
                $itineraryContext->setItineraty($partialItinerary);
                return TRUE;
            }
            return FALSE;
    }

}

