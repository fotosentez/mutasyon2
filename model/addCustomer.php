<?php

$getGroup = DB::get(' * ', ' costumers_groups ', ' costumers_groups_status = 1 ');

//Smarty veriables
$smarty->assign ( array (
"getGroup" => $getGroup,
) );


Page::create("addCustomer", "addCustomer", "addCustomer", "addCustomer");