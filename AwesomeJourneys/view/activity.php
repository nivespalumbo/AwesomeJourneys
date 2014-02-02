<?php

if($this->model){
    echo "<div>"
         . "<div class='title'><h2>".$this->model->getName()."</h2></div>"
         . "<div class='grid' style='padding:1%; width:35%;'><p>".$this->model->getDescription()."</p></div>"
         . "<div class='grid' style='padding:1%; width:35%;'>"
            . "<span><label>Address: </label>".$this->model->getAddress()."</span>"
            . "<span><label>Location: </label>".$this->model->getLocation()."</span>"
            . "<span><label>Disponibile dal: </label>".$this->model->getAvailableFrom()."</span>"
            . "<span><label>Al: </label>".$this->model->getAvailableTo()."</span>"
            . "<p><label>Durata: </label>".$this->model->getExpectedDuration()."</p>"
		. "</div>" 
       . "</div>";
}

?>