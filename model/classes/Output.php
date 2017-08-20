<?php

Class Output
{
    //Add red background to input which gived error (With clean other inputs)
    public static function error($class=false)
    {
        global $error;
        self::cleanRed();
        if($class == true){foreach($error as $e){echo '<script>$(".'.$e.'").addClass("checkError");</script>'.Lang::getLang('checkFailed')."<br />";}}
        else{foreach($error as $e){echo '<script>$("*[name='.$e.']").addClass("checkError");</script>'.Lang::getLang('checkFailed')."<br />";}}
    }
    
    //Add red background to input which gived error (Not clean other inputs)
    public static function addRed($name, $output)
    {
        echo "<script>$('*[name=".$name."]').addClass('checkError').focus();</script>".Lang::getLang($output);
    }
    
    //Clean red from inputs and textarea
    public static function cleanRed()
    {
        echo "<script>$('*').removeClass('checkError');</script>";
    }
    
    //Refresh posted div
    public static function refreshDiv($class)
    {
        echo "<script>$('.".$class."').load(location.href + ' .".$class."');</script>";
    }
    
}

?>