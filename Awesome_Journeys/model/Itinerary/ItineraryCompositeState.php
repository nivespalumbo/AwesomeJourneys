<?php

include_once 'ItineraryComponent.php';

interface ItineraryCompositeState extends ItineraryComponent {    
    public function aggiungiTappa($itineraryComponent);
    public function eliminaTappa();
    public function getNumTappe();
    public function aggiungiTappaSpostamento($tappa);
    
}

?>
