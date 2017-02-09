<?php

$url = Get::post ( "url" );
if (! $url or $url == "") {
    header('Location: index.php?url=index');
}
//Get company info
$getCompany = $dbase->get('*', 'company', 'company_id = 1');
// if($getCompany){
//     foreach($getCompany as $g){
//         $companyName = $g["company_name"];
//         $companyAddress = $g["company_address"];
//         $companyWeb = $g["company_web"];
//         $companyMail = $g["company_mail"];
//         $companyTel = $g["company_tel"];
//     }
//     
//     
//     //Smarty veriables
//     $smarty->assign ( array (
//         "companyName" => $companyName,
//         "companyAddress" => $companyAddress,
//         "companyWeb" => $companyWeb,
//         "companyMail" => $companyMail,
//         "companyTel" => $companyTel,
//         ) );
// }

if(@$_SESSION['buyCart']){
    $buyCart = $_SESSION['buyCart'];
    
    $buyProductsID = 0;
    foreach ($buyCart as $c)
    {
        $buyProductsID.= ', '.$c;
    }
    $buy = $dbase->get('*, (SELECT products_images_id FROM products_images WHERE products_images_product = products_id AND products_images_cover = 1 ) AS cover', 'products', 'products_id IN('.$buyProductsID.')');
    $getBuyProducts = array();
    foreach($buy as $c){$getBuyProducts[] = $c;}
}
//Smarty veriables
$smarty->assign ( array (
"getBuyProducts" => @$getBuyProducts,
));