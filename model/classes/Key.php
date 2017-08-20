<?php
Class Key{
    
    public function loginKey(){
        $session = new Session();
        return $session->build("loginKey", uniqid("loginKey", true));
    }
}
?>