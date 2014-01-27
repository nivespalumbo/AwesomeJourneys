<?php

include_once 'ActivityTemplate.php';
include_once 'model/StayTemplate/StayTemplateLeaf.php';
include_once 'model/AJConnection.php';
/**
 * Description of Activity
 *
 * @author Nives
 */
class Activity extends ActivityTemplate implements StayTemplateLeaf{
    private $id;
    private $start;
    private $end;
    
    public function __construct($id, $start, $end, $idTemplate, $name, $description, $location, $address, $availableFrom, $availableTo) {
        parent::__construct($idTemplate, $name, $description, $location, $address, $availableFrom, $availableTo);
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
    }

    public function addComponent($key, \StayTemplateComponent $object) {
        return FALSE;
    }

    public function getComponent($key) {
        return FALSE;
    }

    public function getComponentsOfType($type) {
        return FALSE;
    }

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return ACTIVITY;
    }

    public function removeComponent($key) {
        return FALSE;
    }
    
    public function saveIntoDb(){
        $c = new AJConnection();
        try{
            $c->beginTransaction();
            $sql = "INSERT INTO stay_template_component(type, is_composite) "
                 . "VALUES (".ACTIVITY.", 0);";
            $c->executeNonQuery($sql);
            $this->id = $c->lastInsertedId();
            $sql = "INSERT INTO activity(ID, template, start_date, end_date) "
                 . "VALUES ($this->id, $this->idTemplate, '$this->start', '$this->end');";
            $c->executeNonQuery($sql);
            $c->commit();
            $c->close();
            return TRUE;
        } catch (Exception $ex) {
            $c->rollback();
            $c->close();
            return FALSE;
        }
        return FALSE;
    }

    public function serialize() {
        return serialize(
            array(
                'id' => $this->id,
                'start' => $this->start,
                'end' => $this->end,
                'idTemplate' => $this->idTemplate,
                'name' => $this->name,
                'description' => $this->description,
                'location' => $this->location,
                'address' => $this->address,
                'availableFrom' => $this->availableFrom,
                'availableTo' => $this->availableTo
            )
        );
    }

    public function unserialize($data) {
        $data = unserialize($data);
        
        $this->id = $data['id'];
        $this->start = $data['start'];
        $this->end = $data['end'];
        $this->idTemplate = $data['idTemplate'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->location = $data['location'];
        $this->address = $data['address'];
        $this->availableFrom = $data['availableFrom'];
        $this->availableTo = $data['availableTo'];
    }


}
