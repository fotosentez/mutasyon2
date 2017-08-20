<?php
require_once(dirname(__FILE__).'/../classes/Session.php'); // Get session

session_start();
Session::destroy();
header("location: ../../");
?>