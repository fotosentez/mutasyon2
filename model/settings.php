<?php
$configs = $dbase->get('*', 'configs INNER JOIN currency ON currency_default = currency_id ', 'id_config <> 0');
$customersGroups = $dbase->get('*', 'costumers_groups', 'costumers_groups_id <> 0');
$paytype = $dbase->get('*', 'paytype', 'paytype_id <> 0');
$currency = $dbase->get('*', 'currency', 'currency_id <> 0');
$prefix = $dbase->get('*', 'prefix', 'prefix_status = 1');
$company = $dbase->get('*', 'company', 'company_id = 1');
$superuser = $dbase->get('*', 'superuser', 'superuser_email = "'.$_SESSION ["email"].'" ');


//Smarty veriables
$smarty->assign ( array (
"configs" => $configs,
"customersGroups" => $customersGroups,
"paytype" => $paytype,
"currency" => $currency,
"prefix" => $prefix,
"superuser" => $superuser,
"company" => $company,
));
Page::create("settings/settings", "settings", "settings", "settings", false);