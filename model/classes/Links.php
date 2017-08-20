<?php
Class Links{
    function getLinks($link, $one = ''){
        if($one){
            return "?u=".$link."&".$one;
        }
        else{
            return "?u=".$link;
        }
    }
}

?>