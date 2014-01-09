<?php
include_once 'model/Journey/JourneySearchResult.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchController
 *
 * @author anto
 */
class SearchController {
    private $op;
    
    public function __construct($op) {
        $this->op = $op;
        
    }
    
    public function invoke(){
        if($this->op == ""){
            $this->home_sito();
        }
            
    }
    
    public function home_sito(){
        $model = new JourneySearchResult();
        $model->search(null);
        return $model;
    }
    
    public function form_login(){
        $this->model = new JourneySearchResult();
        $this->model->search(null);
    }
}

?>
