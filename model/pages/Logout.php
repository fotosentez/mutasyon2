<?php
require_once(dirname(__FILE__).'/../functions/Session.php'); // Get session

session_start();
Session::destroy();
header("location: ../../");
?>
