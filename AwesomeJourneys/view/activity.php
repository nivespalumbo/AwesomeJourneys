<?php

if($this->model){
    echo "<div>"
         . "<h2>".$this->model->getName()."</h2>"
         . "<p>".$this->model->getDescription()."</p>"
         . "<div>"
            . "<span><label>Address: </label>".$this->model->getAddress()."</span>"
            . "<span><label>Location: </label>".$this->model->getLocation()."</span>"
         . "</div>"
         . "<div>"
            . "<span><label>Disponibile dal: </label>".$this->model->getStartDate()."</span>"
            . "<span><label>Al: </label>".$this->model->getEndDate()."</span>"
         . "</div>"
         . "<p><label>Durata: </label>".$this->model->getExpectedDuration()."</p>" 
       . "</div>";
}

?>