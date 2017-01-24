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
