<?php
include_once 'model/StayTemplate/StayTemplateLeaf.php';
include_once 'ActivityTemplate.php';
include_once 'model/AJConnection.php';

class Activity extends ActivityTemplate implements StayTemplateLeaf{
    private $id;
    
    private $date;
    private $persons;
    
    function __construct($idActivity, $idTemplate, $name, $address, $expectedDuration, $location, $description, $availableFrom, $availableTo) {
        parent::__construct($idTemplate, $name, $address, $expectedDuration, $location, $description, $availableFrom, $availableTo);
        $this->id = $idActivity;
        
        if($this->id == NULL){
            $this->saveIntoDB();
        }
    }
    
    function serialize(){
        return serialize(
            array(
                'id' => $this->id,
                'date' => $this->date,
                'persons' => $this->persons,
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'address' => $this->address,
                'expectedDuration' => $this->expectedDuration,
                'location' => $this->location,
                'description' => $this->description
            )
        );
    }   
    function unserialize($data) {
        $data = unserialize($data);
        
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->description = $data['description'];
        $this->expectedDuration = $data['expectedDuration'];
        $this->location = $data['location'];
        $this->id = $data['id'];
        $this->date = $data['date'];
        $this->persons = $data['persons'];
    }
        
    public function getId() {
        return $this->id;
    }
    public function getDate() {
        return $this->date;
    }
    public function getPersons() {
        return $this->persons;
    }
    public function getStartLocation() {
        return $this->location;
    }
    public function getEndLocation() {
        return $this->location;
    }
    public function getType() {
        return ACTIVITY;
    }
    public function getDuration() {
        return $this->expectedDuration;
    }
    
    public function setDate($date) {
        $this->date = $date;
    }
    public function setPersons($n){
        $this->persons = $n;
    }
    
    
    
    public function save(){
        return $this->saveIntoDB();
    }
    
    protected function saveIntoDB() {
        $c = new AJConnection();
        
        try{
            $c->beginTransaction();
            $sql = "INSERT INTO stay_template_component (type, is_composite) VALUES (".ACTIVITY.", 0);";
            $c->executeNonQuery($sql);
            $this->id = $c->lastInsertedId();
            $sql = "INSERT INTO activity(ID, template) "
                 . "VALUES ($this->id, $this->idTemplate);";
            $c->executeNonQuery($sql);
            $c->commit();
            $c->close();
            return TRUE;
        } catch (Exception $ex) {
            $c->close();
            return FALSE;
        }
        return FALSE;
    }
    
    public function delete(){
        return $this->deleteFromDb();
    }
    
    private function deleteFromDb(){
        
    }
    
    public function addComponent(StayTemplateComponent $component) {
        return FALSE;
    }
    
    public function getComponentsOfType($type) {
        if($type == ACTIVITY){
            return $this;
        }
        else {
            return NULL;
        }
    }

    public function isComposite() {
        return FALSE;
    }

    public function removeComponent($id) {
        return FALSE;
    }
}