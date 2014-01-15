<?php
include_once 'model/Actor/UserComponent.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogRegisterController
 *
 * @author anto
 */
class LogRegisterController {
    
    public function login($mail, $password){
        return UserComponent::login($mail, $password);
    }
    
    public function logout(){
        UserComponent::logout();
    }
    
    public function register($name, $surname, $address, $tel, $mail, $pass, $passBis){
        return UserComponent::register($name, $surname, $address, $tel, $mail, $pass, $passBis);
    }
}

?>
