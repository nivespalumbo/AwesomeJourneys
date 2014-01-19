<?php
interface JourneyIterator {
    public function hasNext();
    public function next();
    public function replay();
}
?>
