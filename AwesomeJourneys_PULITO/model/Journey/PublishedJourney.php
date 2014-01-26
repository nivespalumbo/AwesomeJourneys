<?php

/**
 * Description of PublishedJourney
 *
 * @author Nives
 */
class PublishedJourney extends Journey{
    function __construct($id, $startDate, $endDate, $itineraryId, $creator) {
        parent::__construct($id, $startDate, $endDate, $itineraryId, $creator);
    }
}
