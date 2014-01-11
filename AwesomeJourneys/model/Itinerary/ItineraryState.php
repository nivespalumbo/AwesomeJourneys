<?php

abstract class ItineraryState{
    protected $id;
    protected $name;
    protected $description;
    protected $photo;
    protected $numBrick;
    protected $newBrick;
    protected $itineraryBrikc;
    protected $type;
    
    
    protected function insertInDB($creator){
        $insert1 = "INSERT INTO itinerary(creator, state";
        $insert2 = " VALUES(".$creator.", ".$this->type;
        
        if($this->name != NULL){
            $insert1 .= ", name";
            $insert2 .= ", ".$this->name;
        }
        
        if($this->description != NULL){
            $insert1 .= ", descrpiption";
            $insert2 .= ", ".$this->description;
        }
        
        $insert1 .= ")";
        $insert2 .= ");";
        
        $db = new Connection();
        $db->beginTrasaction();
        
        if($db->extecute_non_query($insert1.$insert2)){
            $this->id = $db->extecute_non_query("SELECT LAST_INSERT_ID();");
        }
        if($this->id != -1){
            $db->commit();
            $db->close();
            return TRUE;
        }
        
        $db->rollBack();
        $db->close();
        return FALSE;
    }
    
    public function provideBasicInfo($name, $description){
        $this->name = $name;
        $this->description = $description;
    }

    public function newItineraryBrick(ItineraryBrick $brick){
        $this->newBrick = $brick;
    }
    public function saveNewBrick(){
        if($this->newBrick->save()){
            $this->itineraryBrikc[] = $this->newBrick;
            $this->numBrick++;
        }
    }
    public function removeBrick($id){
        
    }
    public function getNumBrick(){
        return $this->numBrick;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setDesription($description){
        $this->description = $description;
    }
    
    public function getPhoto(){
        return $this->photo;
    }
    
    public function setPhoto($photo){
        $this->photo = $photo;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function getItineraryBrick(){
        return $this->itineraryBrikc;
    }

    public function setItineraryBrick($itineraryBrick){
        $this->itineraryBrikc = $itineraryBrick;
        $this->numBrick = count($this->itineraryBrikc);
    }

    protected function updateInDB(){
        $sql = "UPDATE itinerary SET state = ".$this->type;
        
        if($this->name != NULL){
            $sql .= ", name = ".$this->name;
        }
        
        if($this->descrpiption){
            $sql .= ", descrpiption = ".$this->description;
        }
        
        $sql .= " WHERE ID = ".$this->id.";";
        
        $db = new Connection();
        
        if(!$db->extecute_non_query($sql)){
            $db->close();
            return FALSE;
        }
        $db->close();
        return TRUE;
    }

    abstract function save(ItineraryContext $itineraryContext);
    
    abstract function newJourney();
}
