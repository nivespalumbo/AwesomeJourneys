<?php
include_once 'model/AJConcreteAggregator.php';
include_once 'ActivityTemplate.php';
include_once 'model/AJConnection.php';

/**
 * Description of ActivitySearchResult
 *
 * @author anto
 */
class ActivitySearchResult {
    private $aggregator;
    private $iterator;
    
    public function __construct() {
        $this->aggregator = new AJConcreteAggregator();
    }
    
    public function __sleep() {
        return array("aggregator", "iterator");
    }

    public function __wakeup() {
        
    }

    public function search($query = NULL){
        $c = new AJConnection();
        
        if($query == NULL){
            $query = "SELECT * "
                   . "FROM activity_template;";
        }
        
        if($c){
            $table = $c->executeQuery($query);
            $c->close();
            if($table){
                foreach($table as $row){
                    $activity = new ActivityTemplate($row->ID, $row->name, $row->address, $row->expected_duration, $row->location, $row->description, $row->available_from, $row->available_to);
                    $this->aggregator->add($activity->getId(), $activity);
                }
            }
        }
        
        $this->iterator = $this->aggregator->getIterator(); 
    }
    
    public function fetchObject() {
        if ($this->iterator->hasNext())
            return $this->iterator->next();
        else
            return NULL;
    }
    
    public function getObject($id){
        return $this->aggregator->getObject($id);
    }
}

?>
