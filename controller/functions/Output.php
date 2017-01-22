<?php

Class Output
{
    //Add red background to input which gived error
    public static function checkError($name, $output)
    {
        echo "<script>$('*').removeClass('alert-danger');$('input[name=".$name."]').addClass('alert-danger');$('textarea[name=".$name."]').addClass('alert-danger');$('select[name=".$name."]').addClass('alert-danger');</script>".Lang::getLang($output);
    }
   
    //Clean red from all inputs and textarea
    public static function cleanRed()
    {
        echo "<script>$('*').removeClass('alert-danger');</script>";
    }
    
}

?>