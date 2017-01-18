<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

$customerName = Get::post('customer-name');
$date = Get::post('date');
$prefix = Get::post('prefix');
$invoiceType = Get::post('invoiceType');
$desc = Get::post('desc');
$getProductInf = Get::post('term');

$table = 'product';
$values = array(
    'id_customer' => 1,
    'customer_name' => "Eylül BENEK",
    'customer_britday' => "15.09.2014",
    'customer_active' => 1
    );
    $insert = $dbase->autocomplete($table, $values );
    
    ?>