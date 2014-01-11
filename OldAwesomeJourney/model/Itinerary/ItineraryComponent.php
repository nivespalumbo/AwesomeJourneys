<?php
include_once 'ItineraryComponent.php';

interface ItineraryComponent {
    public function visualizza_tappe();
    public function get_name();
    public function get_description();
    public function get_category();
    public function get_tag();
    public function get_photo();
    public function get_creator();
    public function ricercaTappa($stayId);
    public function selectActivity($activityIdList, $stayId);
    public function manageActivityInStay($stayId);
    public function getStay($stayId);
}

?>
