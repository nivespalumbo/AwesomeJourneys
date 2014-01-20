<?php
include_once 'model/connection.php';
include_once 'model/Activity/Activity.php';
include_once 'ConcreteStateCompleteItinerary.php';
include_once 'ConcreteStatePartialItinerary.php';
include_once 'Stay.php';
include_once 'Transfer.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItineraryContext
 *
 * @author anto
 */
class ItineraryContext {
    private $itineray;
    private $stay;
    
    
    public function nuovoItinerario(){
        $this->itineray = new ConcreteStatePartialItinerary();
    }
    
    public function nuovaTappa($stayTemplate){
        $c = new Connection();
        if($c){
            $table = $c->fetch_query("SELECT ID FROM stay INNER JOIN itinerary ON journey.itinerary = itinerary.ID WHERE published=1 ORDER BY start_date;");
            $id = $this->idStay($table);
            $this->stay = new Stay($id, $stayTemplate->location(), $stayTemplate->getActivity(), $stayTemplate->getAccomodations(), $stayTemplate->getTransport());
        }
        $c->close();
    } 
    
    public function privideBasicInfo($itName, $itDesc, $itTagList, $itCategory){
        $this->itinerary->setName($itName);
        $this->itinerary->setDescription($itDesc);
        $this->itinerary->setTag($itTagList);
        $this->itinerary->setCategory($itCategory);
    }
    
    public function configureStayParameter($optId, $valId){
        $this->stay->configureStayParameter($optId, $valId);
    }
    
    private function idStay($table){
        if($table){
            $numRows = count($table,COUNT_NORMAL);
            $ris = 1;
            for($i=0; $i<$numRows; $i++){
               $idAssegnato = $table[$i]->ID;
               if($ris < $idAssegnato)
                   return $ris;
               $ris++;
            }
            return $ris;
        }
    }
    
    public function selectActivity($activityIdList, $stayId){
        $stay = $this->stay->selectActivity($activityIdList);
        if(!$stay)
            $stay = $this->stay->selectActivity($activityIdList, $stayId);
        return $stay;
    }
    
    public function manageActivityInStay($stayId){
        $activitys = $this->stay->manageActivityInStay($stayId);
        if(!$activitys || !$tappa = $this->itineray->ricercaTappa($stayId)){
            return FALSE;
        }else{
            $this->stay = $tappa;
            $activitys = $tappa->getActivity();
        }
        return $activitys;
    }
    
    public function saveStay(){
        $c = new Connection();
        if($c){
            $c->newStay($this->stay);////da ricontrollare
            $c->close();
            $compositeStay = new ConcreteStatePartialItinerary($id);
            $this->itinerary->addStay($compositeStay);
        }
    }
    
    /*
     * Restituisce TRUE se $tappe è un elenco di tappe che forma un itinerario completo,
     * FALSE altrimenti.
     * $startLocation rappresenta la località di partenza dell'itinerario.
     */
    private function completo($tappe, $startLocation){
        $location = $startLocation;
        $stLocation;
        $endLocation;
        
        foreach($tappe as $tappa){
            $nextLocation = $tappa->getLocation();
            if($nextLocation == NULL){//la tappa considerata non ha un location perchè è di spostamento
                $stLocation = $tappa->getStartLocation();
                $endLocation = $tappa->getEndLocation();
                if($stLocation != $endLocation && $stLocation != $location){
                    return FALSE;
                }
            }else{
                if($endLocation != $nextLocation){
                    return FALSE;
                }
                $location = $nextLocation;    
            }
        }
        
        return TRUE;
    }
    
    public function saveItinerary(){
        $tappe = $this->itineray->visualizza_tappe();
        $numTappe = $this->itineray->getNumTappe();
        $ris;
        if($numTappe == 1){
            foreach($tappe as $tappa){
                $location = $tappa->getLocation();
                if($location == NULL && $tappa->getStartLocation() != $tappa->getEndLocation()){//caso di un itinerario composto esclusivamente da una tappa di spostamento che ha uguale
                                                                                                //luogo di partenza e di destinazione
                    $ris = new CompleteItinerary();
                }else{
                    $ris = new ConcreteStatePartialItinerary();
                }
            }  
        }
        
        if($numTappe > 1 && completo($tappe, $this->itineray->getStartLocation())){
            $ris = new CompleteItinerary();
        }else{
            $ris = new ConcreteStatePartialItinerary();
        }
        
        $ris->setCategory($this->itineray->get_category());
        $ris->setCreator($this->itineray->get_craetor());
        $ris->setDescription($this->itinerary->getDescription());
        $ris->setId($this->itinerary->get_id());
        $ris->setName($this->itinerary->getName());
        $ris->setPhoto($this->itinerary->get-Photo());
        $ris->setTag($this->itinerary->getTag());
        $ris->setItineraryComponents($this->itineray->getItineraryComponents());

        return $ris;
                
    }
    
    private function newActivity($table, $idStay){
        return new Activity($table[$i]->ID, $idStay, $table[$i]->duration, $table[$i]->location, $table[$i]->description);
    }
    
    public function addActivity($idActivityList){
        $c = new Connection();
        if($c){
            foreach($idActivityList as $idActivity){
                $table = $c->fetch_query("SELECT * FROM activity INNER JOIN accomodation_template ON activity.template = accomodation_template.ID WHERE activity.ID=".$idActivity.";");
                $this->stay->selectActivities($this->newActivity($table[$i]->ID, $this->stay->getId()));
            }
            $c->close();
        }
    }
    
    public function removeActivity($idList){
        $this->stay->removeActivity($idList);
    }
}

?>
