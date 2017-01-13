<?php
require_once(dirname(__FILE__).'/database.php'); //Connect Database

//Functions
require_once(dirname(__FILE__).'/../../controller/functions/AddHtml.php');
require_once(dirname(__FILE__).'/../../controller/functions/Check.php');
require_once(dirname(__FILE__).'/../../controller/functions/Get.php');
require_once(dirname(__FILE__).'/../../controller/functions/Math.php');
require_once(dirname(__FILE__).'/../../controller/functions/Output.php');

require_once(dirname(__FILE__).'/../../controller/database_proccess.php'); // Process and Function
include(dirname(__FILE__).'/../languages/turkish.php'); // languages

$dbase 			= new DB();
$template 		= $dbase->config('Template');
$siteName 	        = $dbase->config('SiteName');
$siteDesc		= $dbase->config('SiteDesc');
$path 			= $dbase->config('Path');
$currencyID 		= $dbase->config('currency');
$currency               = $dbase->getRow('currency', 'currency_id = '.$currencyID.'', 'currency_code');

/** Site Link **/
$DOCUMENT_ROOT ='';
$PHP_SELF ='';
define('_THEME_REEL_DIR_', $path.'view/'.$template.'/');
define('_BASE_DIR_', str_replace($DOCUMENT_ROOT, "", dirname($PHP_SELF)));
define('_CONTROLLER_', _BASE_DIR_.'controller/');
define('_MODEL_', _BASE_DIR_.'model/');
define('_THEME_DIR_', _BASE_DIR_.'view/');
define('_THEME_BASE_DIR_', _THEME_DIR_.$template.'/');
define('_THEME_CSS_DIR_', _THEME_REEL_DIR_.'css/');
define('_THEME_JS_DIR_', _THEME_REEL_DIR_.'js/');
define('_THEME_IMG_DIR_', _THEME_BASE_DIR_.'img/');

/** Bismillahirrahmanirrahim **/
date_default_timezone_set('Europe/Istanbul');
$betik_zd = date_default_timezone_get();
require_once(dirname(__FILE__).'/../libs/Smarty.class.php');
$smarty = new Smarty;
//$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 0;


require_once(dirname(__FILE__).'/../../controller/page.php');
require_once(dirname(__FILE__).'/session.php');
$page = new Page();

/** Page **/
$smarty->assign(array(
    'base_dir' => $path,
    'controller_dir' => _CONTROLLER_,
    'model_dir' => _MODEL_,
    'theme_dir' => _THEME_DIR_,
    'template_dir' => _THEME_BASE_DIR_,
    'img_dir' => _THEME_IMG_DIR_,
    'js_dir' => _THEME_JS_DIR_,
    'css_dir' => _THEME_CSS_DIR_,
    'siteName' => $siteName,
    'siteDesc' => $siteDesc,
    'currency' => $currency,
    ));