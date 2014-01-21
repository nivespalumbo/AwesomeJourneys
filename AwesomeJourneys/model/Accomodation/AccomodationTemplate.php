<?php

class AccomodationTemplate {
    private $idTemplate;
    private $address;
    private $accomodationType;
    private $description;
    private $category;
    private $name;
    private $link;
    private $photo;
    private $location;
    
    function __construct($id, $address, $type, $description, $category, $name, $link, $photo, $location) {
        $this->idTemplate = $id;
        $this->address = $address;
        $this->accomodationType = $type;
        $this->description = $description;
        $this->category = $category;
        $this->name = $name;
        $this->link = $link;
        $this->photo = $photo;
        $this->location = $location;
    }

    public function getIdTemplate() {
        return $this->idTemplate;
    }
    public function getAddress() {
        return $this->address;
    }
    public function getAccomodationType() {
        return $this->accomodationType;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getCategory() {
        return $this->category;
    }
    public function getName() {
        return $this->name;
    }
    public function getLink() {
        return $this->link;
    }
    public function getPhoto() {
        return $this->photo;
    }
    public function getLocation() {
        return $this->location;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
    public function setAccomodationType($type) {
        $this->accomodationType = $type;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setCategory($category) {
        $this->category = $category;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setLink($link) {
        $this->link = $link;
    }
    public function setPhoto($photo) {
        $this->photo = $photo;
    }
    public function setLocation($location) {
        $this->location = $location;
    }
    
    public function saveIntoDB(){
        
    }
}

?>
