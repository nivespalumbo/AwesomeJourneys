<?php

include_once 'model/Enumerations/ItineraryState.php';
include_once 'model/AJConnection.php';
include_once 'model/StayTemplate/StayTemplateComposite.php';

/**
 * Description of ItineraryState
 *
 * @author Nives
 */
abstract class ItineraryState {
    protected $id;
    protected $name;
    protected $description;
    protected $photo;
    protected $creator;
    
    protected $bricks;
    
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
    
    public function addBrick(StayTemplateComposite $brickTemplate){
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
        else {
            return;
        }
    }
    
    public function removeBrick($key){
        if($index = $this->getBrickIndex($key)){
            if($this->removeBrickFromDb($key)){
                $upper = array_slice($this->itineraryBricks, 0, $index);
                $lower = array_slice($this->itineraryBricks, $index+1);
                $this->itineraryBricks = array_merge($upper, $lower);
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }
    
    public function getPhoto(){
        return $this->photo;
    }
    
    public function setBricks($bricks){
        $this->bricks = $bricks;
    }
    
    public function setPhoto($photo){
        $this->photo = $photo;
    }
    
    abstract function getType();
    
    protected function insertInOrder(ItineraryBrick $brick){
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
