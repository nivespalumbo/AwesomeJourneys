<?php
include_once 'model/connection.php';

abstract class ItineraryState{
    protected $id;
    protected $name;
    protected $description;
    protected $startLocation;
    protected $endLocation;
    protected $photo;
    protected $creator;
    
    protected $staySearchResult;
    protected $itineraryBricks;
    
    
    
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getStartLocation() { return $this->startLocation; }
    public function getEndLocation() { return $this->endLocation; }
    public function getPhoto() { return $this->photo; }
    public function getItineraryBricks() { return $this->itineraryBricks; }
    public function getBrick($idBrick){
        if(array_key_exists($idBrick, $this->itineraryBricks)){
            return $this->itineraryBricks[$idBrick];
        }
        return NULL;
    }
    abstract function getType();
    public function getStaySearchResult(){
        if($this->staySearchResult == NULL){
            $this->staySearchResult = new StaySearchResult();
            $this->staySearchResult->searchStay("SELECT * "
                                              . "FROM stay_template "
                                              . "WHERE start_location='$this->startLocation' "
                                                    . "OR end_location='$this->startLocation';");
        }
        return $this->staySearchResult; 
    }
    
    
    
    public function setPhoto($photo) { $this->photo = $photo; }
    public function setStartLocation($startLocation) { $this->startLocation = $startLocation; }
    public function setEndLocation($endLocation) { $this->endLocation = $endLocation; }

 
 
    
    public function addBrick($idTemplate){
        $brickTemplate = $this->staySearchResult->getObject($idTemplate);
        if($brickTemplate->getType() == STAY_TEMPLATE){
            $brick = new Stay($brickTemplate, $this->id);
        }
        else {
            $brick = new Transfer(0, $brickTemplate);
        }
        if($this->saveBrickInDb($brick)){
            $this->itineraryBricks[$brick->getId()] = $brick;
            return TRUE;
        }
        return FALSE;
    }
    
    public function insertBrick(ItineraryBrick $brick){
        $this->itineraryBricks[$brick->getId()] = $brick;
    }
    
    public function removeBrick($idBrick){
        if(!array_key_exists($idBrick, $this->itineraryBricks)){
            return TRUE;
        }
        if($this->removeBrickFromDb($idBrick)){
            unset($this->itineraryBricks[$idBrick]);
            return TRUE;
        }
        return FALSE;
    }
    
    public function searchBricks(){
        $c = new Connection();
        if($c){
            $sql = "SELECT * FROM itinerary_brick WHERE id_itinerary=$this->id;";
            $table = $c->execute_query($sql);
            $c->close();
            if($table){
                foreach($table as $row){
                    if($row->type == STAY){
                        $brick = Stay::getStay($row->ID, $this->id);
                    }
                    else{
                        $brick = Transfer::getTransfer($row->ID, $this->id);
                    }
                    $this->insertBrick($brick);
                }
            }
        }
    }
    
    protected function saveInDb(){
        $insert1 = "INSERT INTO itinerary(itinerary_creator, state, name, description, start_location";
        $insert2 = " VALUES('$this->creator', ".$this->getType().", '$this->name', '$this->description', '$this->startLocation'";
        if($this->photo != NULL){
            $insert1 .= ", photo";
            $insert2 .= ", '$this->photo'";
        }
        $insert1 .= ")";
        $insert2 .= ");";
        
        $c = new Connection();
        if($c){
            $c->begin_transaction();
            try{
                $c->execute_non_query($insert1.$insert2);
                $this->id = $c->last_inserted_id();
                $c->commit();
                $c->close();
                return TRUE;
            } catch (Exception $ex) {
                $c->rollback();
                $c->close();
                return FALSE;
            }
        }
        return FALSE;
    }
    
    protected function saveBrickInDb(ItineraryBrick $brick){
        $c = new Connection();
        if($c){
            $sql = "INSERT INTO itinerary_brick(start_location, end_location, start_date, end_date, type, id_itinerary) "
                 . "VALUES ('".$brick->getStartLocation()."', "
                    . "'".$brick->getEndLocation()."', "
                    . "'".$brick->getStartDate()."', "
                    . "'".$brick->getEndDate()."', "
                    . "".$brick->getType().", "
                    . "".$brick->getItineraryId().");";
            $c->begin_transaction();
            try{
                if($c->execute_non_query($sql)){
                    $brick->setId($c->last_inserted_id());
                    $brick->saveInDb($c);
                }
                $c->commit();
                $c->close();
                return TRUE;
            } catch (Exception $ex) {
                $c->rollback();
                $c->close();
                return FALSE;
            }
        }   
        return FALSE;
    }
    
    protected function removeBrickFromDb($idBrick){
        $c = new Connection();
        if($c){
            $sql = "DELETE FROM itinerary_brick WHERE ID=$idBrick";
            if($c->execute_non_query($sql)){
                return TRUE;
            }
        }
        return FALSE;
    }


//    protected function updateInDB(){
//        $sql = "UPDATE itinerary SET state = '".$this->type."'";
//        
//        if($this->name != NULL){
//            $sql .= ", name = '".$this->name."'";
//        }
//        
//        if($this->descrpiption){
//            $sql .= ", description = '".$this->description."'";
//        }
//        
//        $sql .= " WHERE ID = ".$this->id.";";
//        
//        $db = new Connection();
//        
//        if(!$db->execute_non_query($sql)){
//            $db->close();
//            return FALSE;
//        }
//        $db->close();
//        return TRUE;
//    }
//
//    abstract function save(ItineraryContext $itineraryContext);
//    
//    abstract function newJourney();
}
