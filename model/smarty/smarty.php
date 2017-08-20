<?php
require_once(dirname(__FILE__).'/libs/Smarty.class.php');

/** Bismillahirrahmanirrahim **/

$smarty = new Smarty;
$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 120;



?>