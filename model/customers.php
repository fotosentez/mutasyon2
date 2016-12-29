<?php

//Get page
$letter = Get::post("c");
$page = Get::post("page");

//Pagination with letters
$customersLetters = DB::get('SUBSTR(customers_surname, 1, 1) AS lastname FROM customers UNION SELECT SUBSTR(customers_name, 1, 1) AS firstname', 'customers', 'customers_status = 1');

//Pagination with letters
$customers = DB::get('*', 'customers', 'customers_status = 1');

//Smarty veriables
$smarty->assign ( array (
"customersLetters" => $customersLetters,
"customers" => $customers,
) );

Page::create("customers", Lang::getLang('customers'), "customers");