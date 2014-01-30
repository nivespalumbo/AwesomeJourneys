<?php

class AccomodationTemplate implements Serializable {
    protected $idTemplate;
    protected $name;
    protected $description;
    protected $address;
    protected $location;
    protected $accomodationType;
    protected $category;
    protected $link;
    protected $photo;
    
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
    
    function serialize() {
        return serialize(
            array(
                'idTemplate' => $this->idTemplate,
                'address' => $this->address,
                'accomodationType' => $this->accomodationType,
                'description' => $this->description,
                'category' => $this->category,
                'name' => $this->name,
                'link' => $this->link,
                'photo' => $this->photo,
                'location' => $this->location,
            )
        );
    } 
    function unserialize($serialized) {
        $data = unserialize($serialized);
        
        $this->idTemplate = $data['idTemplate'];
        $this->address = $data['address'];
        $this->accomodationType = $data['accomodationType'];
        $this->description = $data['description'];
        $this->category = $data['category'];
        $this->name = $data['name'];
        $this->link = $data['link'];
        $this->photo = $data['photo'];
        $this->location = $data['location'];
    }

    public function getId() {
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
