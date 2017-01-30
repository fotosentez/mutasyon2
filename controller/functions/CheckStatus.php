<?php

Class CheckStatus
{
    //Add pagination with letter to template docs
    public static function addPage($link, $path, $status){
        if($status == 1){
            echo "case '".$link."' :
                include ('".$path."');
                break";
        }
        else{
            echo "case $link :
                include ('model/status/dontAllow.php');
                break";
        }
    }
    
}

?>