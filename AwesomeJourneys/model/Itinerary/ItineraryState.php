<?php
include_once 'model/connection.php';

abstract class ItineraryState{
    protected $id;
    protected $name;
    protected $description;
    protected $photo;
    protected $creator;
    protected $itineraryBricks;
    
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getPhoto() { return $this->photo; }
    public function getItineraryBricks() { return $this->itineraryBricks; }
    public function getBrick($idBrick) {
        if(array_key_exists($idBrick, $this->itineraryBricks)){
            return $this->itineraryBricks[$idBrick];
        }
        return NULL;
    }
    abstract function getType();
    
    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
    public function setPhoto($photo) { $this->photo = $photo; }

    public function addBrick(ItineraryBrick $brick){
        $this->itineraryBricks[$brick->getId()] = $brick;
    }
    
    protected function saveInDb(){
        $insert1 = "INSERT INTO itinerary(itinerary_creator, state, name, description";
        $insert2 = " VALUES('$this->creator', ".$this->getType().", '$this->name', '$this->description'";
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
            $sql = "INSERT INTO itinerary_brick(start_location, end_location, start_date, end_date, type) "
                 . "VALUES ('".$brick->getStartLocation()."', "
                    . "'".$brick->getEndLocation()."', "
                    . "'".$brick->getStartDate()."', "
                    . "'".$brick->getEndDate()."', "
                    . "'".$brick->getType()."');";
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
//    protected function insertInDB($creator){
//        $insert1 = "INSERT INTO itinerary(creator, state";
//        $insert2 = " VALUES('".$creator."', '".$this->getType()."'";
//        
//        if($this->name != NULL){
//            $insert1 .= ", name";
//            $insert2 .= ", '".$this->name."'";
//        }
//        
//        if($this->description != NULL){
//            $insert1 .= ", description";
//            $insert2 .= ", '".$this->description."'";
//        }
//        
//        $insert1 .= ")";
//        $insert2 .= ");";
//        
//        $db = new Connection();
//        $db->begin_transaction();
//        
//        if($db->execute_non_query($insert1.$insert2)){
//            $this->id = $db->last_inserted_id();
//        }
//        if($this->id != -1){
//            $db->commit();
//            $db->close();
//            return TRUE;
//        }
//        
//        $db->rollback();
//        $db->close();
//        return FALSE;
//    }
//    
//    public function provideBasicInfo($name, $description){
//        $this->name = $name;
//        $this->description = $description;
//    }
//
//    public function insertBrick(ItineraryBrick $brick){
//        
//    }
//    
//    public function saveNewBrick(){
//        if($this->newBrick->save()){
//            $this->itineraryBrick[] = $this->newBrick;
//        }
//    }
//    public function removeBrick($id){
//        
//    }
//    
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
