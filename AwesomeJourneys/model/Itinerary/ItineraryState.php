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
    
    protected $bricks;
    
    
    
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getStartLocation() { return $this->startLocation; }
    public function getEndLocation() { return $this->endLocation; }
    public function getPhoto() { return $this->photo; }
    public function getBricks() { return $this->bricks; }
    abstract function getType();
    
    
    
    public function getBrick($id){
        foreach($this->bricks as $brick){
            if($brick->getId() == $id){
                return $brick;
            }
        }
        return NULL;
    }
    
    public function getBrickIndex($id){
        $index = -1;
        while($this->bricks[++$index]->getId() != $id){}
        if(array_count($this->bricks, COUNT_NORMAL) == $index){
            return FALSE;
        }
        return $index;
    }
    
    
    
    
    public function setPhoto($photo) { $this->photo = $photo; }
    public function setStartLocation($startLocation) { $this->startLocation = $startLocation; }
    public function setEndLocation($endLocation) { $this->endLocation = $endLocation; }

 
 
    
    public function addBrick(StayTemplateComponent $brickTemplate){
        if($brickTemplate->getType() == STAY_TEMPLATE){
            $brick = new Stay(NULL, $brickTemplate->getStartLocation(), $brickTemplate->getEndLocation(), $brickTemplate);
            if($this->insertBrickInDb($brick)){
                $this->insertInOrder($brick);
            }
            
            $temp = $brickTemplate->getComponentsOfType(STAY_TEMPLATE);
            foreach ($temp as $sottoTemplate){
                $this->addBrick($sottoTemplate);
            }
        }
        else if($brickTemplate->getType() == TRANSPORT) {
            $brick = new Transfer();
            if($this->insertBrickInDB($brick)){
                $this->insertInOrder($brick);
            }
        }
        else {
            return;
        }
    }
    
    public function addActivityFromTemplate($idStay, ActivityTemplate $template){
        if($brick = $this->getBrick($idStay)){
            $brick->addActivity();
        }
    }

    public function insertInOrder(ItineraryBrick $brick){
        $endLocation = $brick->getEndLocation();
        
        $temp = array();
        while($b = array_shift($this->bricks)){
            if(($b->getStartLocation() == $endLocation) || array_count($this->bricks, COUNT_NORMAL) == 0){
                array_merge($temp, array($brick), $this->bricks);
                break;
            }
            else {
                array_push($temp, $b);
            }
        }
        $this->bricks = $temp;
    }
    
    public function removeBrick($idBrick){
        if($index = $this->getBrickIndex($idBrick)){
            if($this->removeBrickFromDb($index)){
                $upper = array_slice($this->bricks, 0, $index);
                $lower = array_slice($this->bricks, $index+1);
                $this->bricks = array_merge($upper, $lower);
                return TRUE;
            }
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
                    $this->insertInOrder($brick);
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
    
    protected function insertBrickInDB(ItineraryBrick $brick){
        $c = new AJConnection();
        if($c){
            $sql = "INSERT INTO itinerary_brick(start_location, end_location, start_date, end_date, type, id_itinerary) "
                 . "VALUES ('".$brick->getStartLocation()."', "
                    . "'".$brick->getEndLocation()."', "
                    . "".$brick->getType().", "
                    . "".$this->id.");";
            $c->beginTransaction();
            try{
                if($c->executeNonQuery($sql)){
                    $brick->setId($c->lastInsertedId());
                    $brick->insertInDb($c);
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
    
    protected function removeBrickFromDb($brickId){
        $c = new AJConnection();
        if($c){
            $sql = "DELETE FROM itinerary_brick WHERE ID=$brickId";
            if($c->executeNonQuery($sql)){
                return TRUE;
            }
        }
        return FALSE;
    }
    
    protected function saveIntoDb(){
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
}
