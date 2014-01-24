<?php

if($this->model){
    echo "<div>"
         . "<h2>".$this->model->getName()."</h2>"
         . "<p>".$this->model->getDescription()."</p>";
    if($this->model->getPhoto() != NULL){
        echo "<div><img src='accomodations/".$this->model->getPhoto()."' /></div>";
    }
    echo "<div>"
            . "<span><label>Address: </label>".$this->model->getAddress()."</span>"
            . "<span><label>Location: </label>".$this->model->getLocation()."</span>"
         . "</div>"
         . "<div>"
            . "<span><label>Disponibile dal: </label>".$this->model->getStartDate()."</span>"
            . "<span><label>Numero disponibilità: </label>".$this->model->getNumeroDisponibilita()."</span>"
         . "</div>"
         . "<div>"
            . "<span><label>Tipo </label>".$this->model->getAccomodationType()."</span>"
            . "<span><label>Categoria </label>".$this->model->getCategory()."</span>"
         . "</div>"
         . "<p>Sito web: <a href='".$this->model->getLink()."' >vai al sito</a>"
       . "</div>";
}

?>