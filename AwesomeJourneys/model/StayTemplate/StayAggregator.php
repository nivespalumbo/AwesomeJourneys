<?php
include_once 'StayTemplateComponent.php';

interface StayAggregator {
    function getIterator();
    function add(StayTemplateComponent $component);
    function getObject($id);
}

?>
