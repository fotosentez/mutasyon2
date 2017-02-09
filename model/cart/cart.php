<?php

$cart = $_SESSION['cart'];


$productJoins = "
INNER JOIN sale_price ON sp_products_id = products_id
INNER JOIN tax ON sp_tax_id = tax_id
";

$extras = "
(SELECT products_images_id FROM products_images WHERE products_images_product = products_id AND products_images_cover = 1 ) AS cover

";
$productsID = 0;
foreach ($cart as $c)
{
    $productsID.= ', '.$c;
}
$getProducts = $dbase->get('*, '.$extras.' ', 'products '.$productJoins.' ', 'products_id IN('.$productsID.') GROUP BY sp_products_id ');

//Smarty veriables
$smarty->assign ( array (
    "getProduct" => $getProducts,
    ));
Page::create("cart/cart", "cart", "", "cart");