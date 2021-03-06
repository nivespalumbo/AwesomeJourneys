<?php
include_once 'model/AJConnection.php';

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
    abstract function complete();
    
    
    
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
        if(count($this->bricks, COUNT_NORMAL) == $index){
            return FALSE;
        }
        return $index;
    }
    
    
    
    
    public function setPhoto($photo) { $this->photo = $photo; }
    public function setStartLocation($startLocation) { $this->startLocation = $startLocation; }
    public function setEndLocation($endLocation) { $this->endLocation = $endLocation; }
    protected function setBricks($bricks){ $this->bricks = $bricks; }
 
 
    
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
            $brick = new Transfer(NULL, $brickTemplate->getStartLocation(), $brickTemplate->getEndLocation(), $brickTemplate);
            if($this->insertBrickInDB($brick)){
                $this->insertInOrder($brick);
            }
        }
        else {
            return;
        }
        return $brick;
    }
    
    public function removeBrick($idBrick){
        $index = $this->getBrickIndex($idBrick);
        if($index >= 0){
            if($this->removeBrickFromDb($idBrick)){
                if($index == 0){
                    array_shift($this->bricks);
                    return TRUE;
                }
                $upper = array_slice($this->bricks, 0, $index);
                $lower = array_slice($this->bricks, $index+1);
                $this->bricks = array_merge($upper, $lower);
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public function searchBricks(){
        $c = new AJConnection();
        if($c){
            $sql = "SELECT * FROM itinerary_brick WHERE id_itinerary=$this->id;";
            $table = $c->executeQuery($sql);
            $c->close();
            if($table){
                foreach($table as $row){
                    if($row->type == STAY){
                        $brick = Stay::getStay($row->ID);
                    }
                    else{
                        $brick = Transfer::getTransfer($row->ID);
                    }
                    $this->insertInOrder($brick);
                }
            }
        }
    }
    
    public function addActivityFromTemplate($idStay, ActivityTemplate $template){
        if($brick = $this->getBrick($idStay)){
            if(($brick->getStartLocation() == $template->getLocation()) || ($brick->getEndLocation() == $template->getLocation())){
                $activity = new Activity(NULL, $template->getId(), $template->getName(), $template->getAddress(), $template->getExpectedDuration(), $template->getLocation(), $template->getDescription(), $template->getAvailableFrom(), $template->getAvailableTo());
                $brick->addActivity($activity);
                return $activity;
            }
            else {
                return FALSE;
            }
        }
    }

    protected function insertInOrder(ItineraryBrick $brick){
        if(count($this->bricks, COUNT_NORMAL) == 0){
            array_push($this->bricks, $brick);
            return;
        }
        $endLocation = $brick->getEndLocation();
        
        $temp = array();
        while($b = array_shift($this->bricks)){
            if(($b->getStartLocation() == $endLocation) || count($this->bricks, COUNT_NORMAL) == 0){
                $this->bricks = array_merge($temp, array($brick), array($b), $this->bricks);
                return;
            }
            else {
                array_push($temp, $b);
            }
        }
    }
    
    public static function removeItinerary($id){
        $c = new AJConnection();
        try{
            $sql = "DELETE FROM itinerary WHERE ID=$id";
            $c->executeNonQuery($sql);
            $c->close();
            return TRUE;
        } catch (Exception $ex) {
            $c->close();
            return FALSE;
        }
    }
    
    protected function insertIntoDb(){
        $insert1 = "INSERT INTO itinerary(itinerary_creator, state, name, description, start_location";
        $insert2 = " VALUES('$this->creator', ".$this->getType().", '$this->name', '$this->description', '$this->startLocation'";
        if($this->photo != NULL){
            $insert1 .= ", photo";
            $insert2 .= ", '$this->photo'";
        }
        $insert1 .= ")";
        $insert2 .= ");";
        
        $c = new AJConnection();
        if($c){
            $c->beginTransaction();
            try{
                $c->executeNonQuery($insert1.$insert2);
                $this->id = $c->lastInsertedId();
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
    
    protected function updateInDb(){
        $c = new AJConnection();
        try{
            $sql = "UPDATE itinerary SET state = '".$this->getType()."' WHERE ID =$this->id;";
            $c->executeNonQuery($sql);
            $c->close();
            return TRUE;
        } catch (Exception $ex) {
            $c->close();
            return FALSE;
        }
    }

    protected function insertBrickInDB(ItineraryBrick $brick){
        $c = new AJConnection();
        if($c){
            $sql = "INSERT INTO itinerary_brick(start_location, end_location, type, id_itinerary) "
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
    
    protected function isContiguous(){
        $i = 0;
        $num_bricks = count($this->bricks, COUNT_NORMAL);
        
        while($i < $num_bricks-1 && $this->bricks[$i]->getEndLocation() == $this->bricks[$i+1]->getStartLocation()){
            $i++;
        }
        
        if($i < $num_bricks){
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
    
    protected function changeStateInDb($state){
        $c = new AJConnection();
        try{
            $sql = "UPDATE itinerary SET state=$state WHERE ID=$this->id";
            $c->executeNonQuery($sql);
            $c->close();
            return TRUE;
        } catch (Exception $ex) {
            $c->close();
            return FALSE;
        }
    }
}
