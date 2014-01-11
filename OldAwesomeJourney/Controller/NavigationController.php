<?php
include_once 'SearchController.php';
include_once 'LogRegisterController.php';
    
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
            case 'logout' :
                $this->logout();
                break;
        }
    }

    public function home_sito(){
        $c = new SearchController();
        
        $this->model = $c->home_sito();

        require_once("view/home_sito.php");
    }

    public function form_login(){
        $c = new SearchController();
        
        $this->model = $c->home_sito();

        require_once("view/form_login.php");
    }
    
    public function logout(){
        $c = new LogRegisterController();
        $c->logout();
        $this->home_sito();
    }

    public function form_register(){
       require_once("view/form_register.php"); 
    }

    public function gestionePOST(){
        switch ($_POST['op']){
            case 'login' :
                $this->login();
                break;
            case 'register' :
                $this->register();
                break;
        }
    }
    
    public function login(){
        $c = new LogRegisterController();
        $c->login($_POST['mail'], $_POST['pass']);
        
        require_once("view/area_riservata.php");
    }
    
    public function register(){
        $c = new LogRegisterController();
        $c->register($_POST['name'], $_POST['surname'], $_POST['address'], $_POST['telephone'], $_POST['mail'], $_POST['pass']);
        
        require_once("view/area_riservata.php");
    }
    
}
    
?>
