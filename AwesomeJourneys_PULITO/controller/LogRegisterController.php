<?php

/**
 * Description of LogRegisterController
 *
 * @author Nives
 */
class LogRegisterController {
    public function login($mail, $password){
        if($user = UserComponent::login($mail, $password)){
            $_SESSION['utente'] = serialize($user);
            return TRUE;
        }
        return FALSE;
    }
    
    public function logout(){
        UserComponent::logout();
    }
    
    public function register($name, $surname, $address, $tel, $mail, $pass, $passBis){
        if($user = UserComponent::register($name, $surname, $address, $tel, $mail, $pass, $passBis)){
            $_SESSION['utente'] = serialize($user);
            return TRUE;
        }
        return FALSE;
    }
}
