<?php

//Get products infs
$pr = Dbase::getRows('
    ps_invoice_id,
    ps_products_id,
    ps_price,
    ps_products_options_id, 
    (products_prefix||SKU)              AS psku,
    (products_prefix||SKU||po_sku)      AS osku
', 
'productsSold 
    LEFT JOIN products ON ps_products_id = products_id
    LEFT JOIN products_options ON ps_products_options_id = po_id
', 
'ps_id = '.$p);

//Add product ids to return array (id-type-amount-price-invoiceId)
foreach($pr as $products){
    
    //If products
    if(is_null($products['ps_products_options_id'])){
        
        array_push($returns, $products['ps_products_id'].'-products-'.$amount.'-'.$products['ps_price'].'-'.$solution);
        
        $newSKU = $products['psku'];
        
    }
    
    //If options
    else{
        
        array_push($returns, $products['ps_products_options_id'].'-options-'.$amount.'-'.$products['ps_price'].'-'.$solution);
        
        $newSKU = $products['osku'];
        
    }
    
    //Make desc
    array_push(
        
        $descArray, 
        Lang::getlang('sku').           ' :'.   $newSKU.' '.
        Lang::getlang('complaint').     ' :'.   Lang::getlang($reason).' '.
        Lang::getlang('returnTotal').   ' :'.   $refund.' '.
        Lang::getlang('proccess').      ' :'.   Lang::getlang($solution)
    
    );
}


?>
