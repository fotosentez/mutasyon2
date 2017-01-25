<?php

//Get page
$letter = Get::post("c");
$page = Get::post("page");
$showPerPage = Get::post("showPerPage");

//Show per page did not send
if(!$showPerPage){
    $showPerPage = 12;
}

//Pagination with number
$start = ($page-1)*$showPerPage;

//For special customers. If letter not post then show specaial customers
if(!$letter){
    $forLetter = "customers_group <> 0 AND";
    $forLetterT = "count(customers_id)";
}
else{
    $forLetter="";
    $forLetterT = '(SELECT count(customers_id) FROM customers WHERE customers_name LIKE "'.$letter.'%" OR customers_surname LIKE "'.$letter.'%")';
}

//Count customers
$customersCount = $dbase->get(' '.$forLetterT.' as total ', ' customers ', ' '.$forLetter.' customers_status = 1 ');
foreach ( $customersCount as $count ){
    $totalRow = $count['total'];
}
$totalPage = ceil(($totalRow)/$showPerPage);

//Pagination with letters
$customersLetters = $dbase->get('SUBSTR(customers_surname, 1, 1) AS lastname FROM customers UNION SELECT SUBSTR(customers_name, 1, 1) AS firstname', 'customers', 'customers_status = 1');

//If page exist show customers name or surmane with that letter. If not then show special customers
if($letter){ 
    $customers = $dbase->get("*", "customers LEFT JOIN costumers_groups ON costumers_groups_id = customers_group", ' customers_surname LIKE "'.$letter.'%" OR customers_name LIKE "'.$letter.'%" LIMIT '.$start.' , '.$showPerPage.''); 
}
else{
    $customers = $dbase->get("*", "customers LEFT JOIN costumers_groups ON costumers_groups_id = customers_group", ' customers_group <> 0 AND customers_status = 1 LIMIT '.$start.' , '.$showPerPage.' ');
}

//Smarty veriables
$smarty->assign ( array (
    "customers" => $customers,
    "letter" => $letter,
    "customersLetters" => $customersLetters,
    "totalPage" => $totalPage,
    ) );
    
    Page::create("customers/customers", "customers", "customers");