<?php
include_once 'SearchController.php';
include_once 'model/Journey/JourneySearchResult.php';
    
class NavigationController {
    private $model;

    public function invoke(){
        if(isset($_GET['op']))
            $this->gestioneGET();
        else if(isset($_POST['op']))
            $this->gestionePOST();
        else
            $this->home_sito();
    }

    public function gestioneGET(){
        switch ($_GET['op']){
            case 'register' :
                $this->form_register();
                break;
            case 'login' :
                $this->form_login();
                break;
        }
    }

    public function home_sito(){
        //$this->model = new JourneySearchResult();
        //$this->model->search(null);
        $c = new SearchController("home");
        
        $this->model = $c->home_sito();

        require_once("/opt/lampp/htdocs/AwesomeJourney/view/home_sito.php");
    }

    public function form_login(){
        $this->model = new JourneySearchResult();
        $this->model->search(null);

        require_once("/opt/lampp/htdocs/AwesomeJourney/view/form_login.php");
    }

    public function form_register(){
       require_once("/opt/lampp/htdocs/AwesomeJourney/view/form_register.php"); 
    }

    public function gestionePOST(){

    }
    
}
    
?>
