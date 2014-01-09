<?php
include_once 'model/Actor/UserComponent.php';
include_once 'model/Journey/JourneySearchResult.php';

class ManagementController {
    private $user;
    
    public function __construct() {
       session_start();
       if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE)
         $this->setUser();
    }
    
    private function setUser(){
       $object = unserialize($_SESSION['user']);
      if($object->role == "customer")
         $this->user = new ConcreteUserComponent(session_id (), $object->mail, $object->name, $object->surname, $object->address, $object->telephone);
      else
         $this->user = new TravelAgent(new ConcreteUserComponent(session_id (), $object->mail, $object->name, $object->surname, $object->address, $object->telephone));
    }
    
    public function login($mail, $pass){
       $this->user = UserComponent::login($mail, $pass);
    }
    
    public function register($name, $surname, $address, $telephone, $mail, $pass){
       $this->user = UserComponent::register($name, $surname, $address, $telephone, $mail, $pass);
    }
    
    public function printRole(){
        if($this->user)
            return $this->user->getRole();
    }
    
    public function printNome() {
       if($this->user){
          return $this->user->getName()." ".$this->user->getSurname();
       }
    }
    
    public function logout(){
        $this->user->logout();
        session_destroy();
    }
    
    public function getMyItineraries(){
        echo 'ciao';
    }
    
    public function apriRicerca(){
        return new JourneySearchResult();
    }
}
?>