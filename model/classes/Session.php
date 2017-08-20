<?php
    Class Session{
        
        //Build new session
        public function build($name, $value = null){
            if($name != null){
                return $_SESSION[$name] = $value;
            }
        }
        
        //Build new session
        public function arrayPush($name, $value){
            if($name != null AND $value != NULL){
                if(!$_SESSION[$name]){self::build($name, array());}
                array_push($_SESSION[$name], $value);
                
                if($name == "buyCart"){echo Lang::getLang('productAddedToBuyCart');}
                else if($name == "cart"){echo Lang::getLang('productAddedToCart');}
                else{echo Lang::getLang('proccessSuccess');}
            }
        }
        
        //Change products view session
        public function products($key, $value){
	    $_SESSION['products'][$key] = $value;	    
        }
        
        //Remove sessions
        public function destroy(){
            session_destroy();
        }
    }

?>