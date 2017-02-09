<?php

$getGroup = DB::get(' * ', ' costumers_groups ', ' costumers_groups_id <> 0 ');

//Smarty veriables
$smarty->assign ( array (
"getGroup" => $getGroup,
));


Page::create("customers/addCustomer", "addCustomer", "addCustomer", "");