<?php
Class CheckUrl{
    private $_url;
    
    public static function url(){
        $_url = Get::getValue("u");
        
        if($_url == "" OR !$_url){
            return header("Location: index.php?u=index");
        }
    }
}

?>