<?php
require_once(dirname(__FILE__).'/settings/settings.php'); // Get All Functions

$term = Get::post('term');
$id = Get::post('extraParams');

if($id == "addToCart"){
    if($term){
        if(preg_match('/^[^<>;=#{}]*$/ui', $term)){
            $getProduct = $dbase->get('*', 'products INNER JOIN sale_price ON sp_products_id = products_id', 'products_name LIKE "%'.$term.'%" OR SKU LIKE "%'.$term.'%" ORDER BY sp_id DESC LIMIT 1 ');
            if ( $getProduct )
            {
                $data = array();
                foreach ( $getProduct as $row ){
                    $data[] = array(
                        'value' => $row['products_name'],
                        'SKU' => $row['SKU'],
                        'prefix' => $row['products_prefix'],
                        'price' => $row['sp_price'],
                        );
                }
                echo json_encode($data);
            }//rowCount
        }
    }
}
if($id == "customers"){
    if($term){
        if(preg_match(Check::cleanUniCode('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/u'), stripslashes($term))){
            $getCustomers = $dbase->get('*', 'customers LEFT JOIN costumers_groups ON costumers_groups_id = customers_group', 'customers_name LIKE "%'.$term.'%" OR customers_surname LIKE "%'.$term.'%" ');
            if ( $getCustomers )
            {
                $data = array();
                foreach ( $getCustomers as $row ){
                    $data[] = array(
                        'value' => $row['customers_name'].' '.$row['customers_surname'],
                        'cId' => $row['customers_id'],
                        'group' => $row['costumers_groups_discount'],
                        );
                }
                echo json_encode($data);
            }//rowCount
        }
    }
}
if($id == "seller-name"){
    if($term){
        if(preg_match(Check::cleanUniCode('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/u'), stripslashes($term))){
            $getCustomers = $dbase->get('*', 'seller', 'seller_name LIKE "%'.$term.'%" OR seller_address LIKE "%'.$term.'%" ');
            if ( $getCustomers )
            {
                $data = array();
                foreach ( $getCustomers as $row ){
                    $data[] = array(
                        'value' => $row['seller_name'],
                        'sId' => $row['seller_id'],
                        );
                }
                echo json_encode($data);
            }//rowCount
        }
    }
}

//For search products for add to buy cart and cart
if($id == "products" OR $id == "buyCart"){
    if($term){
        
        if(preg_match('/^[^<>;=#{}]*$/ui', $term)){
            $getProduct = $dbase->get('*', 'products', 'products_name LIKE "%'.$term.'%" OR SKU LIKE "%'.$term.'%" ');
            if ( $getProduct )
            {
                $data = array();
                foreach ( $getProduct as $row ){
                    $data[] = array(
                        'value' => $row['products_name'],
                        'SKU' => $row['products_prefix'].$row['SKU'],
                        'prefix' => $row['products_prefix'],
                        'buy' => $row['products_id'],
                        );
                }
                echo json_encode($data);
            }//rowCount
        }
    }
}