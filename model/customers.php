<?php

//Get page
$letter = Get::post("c");
$page = Get::post("page");

//Pagination with letters
$customersLetters = $dbase->get('SUBSTR(customers_surname, 1, 1) AS lastname FROM customers UNION SELECT SUBSTR(customers_name, 1, 1) AS firstname', 'customers', 'customers_status = 1');

//Pagination with number
$customersCount = $dbase->get(' count(customers_id) as total ', ' customers ', ' customers_status = 1 ');
foreach ( $customersCount as $count ){
    $totalRow = $count['total'];
}

$totalPage = ceil($totalRow)/12;

if($page){
    $start = ($page-1)*$totalPage;
}
else{
    $start = 0;
}

//If page exist show customers name or surmane with that letter. If not then show special customers
if($letter){
    $customers = $dbase->get("*", "customers LEFT JOIN costumers_groups ON costumers_groups_id = customers_group", ' customers_surname LIKE "'.$letter.'%" OR customers_name LIKE "'.$letter.'%"'); 
}
else{
    $customers = $dbase->get("*", "customers LEFT JOIN costumers_groups ON costumers_groups_id = customers_group", ' customers_group <> 0 AND customers_status = 1 LIMIT '.$start.' , 12 ');
}

//Smarty veriables
$smarty->assign ( array (
    "customers" => $customers,
    "letter" => $letter,
    "customersLetters" => $customersLetters,
    "totalPage" => $totalPage,
    ) );
    
    Page::create("customers", Lang::getLang('customers'), "customers");