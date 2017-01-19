<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions
$view = Get::post("view");
echo $view;

if($view)
{
    if($view == "grid")
    {
        $_SESSION["view"] = "grid";
    }
    if($view == "list")
    {
        $_SESSION["view"] = "list";
    }
}

?>