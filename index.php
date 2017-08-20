<?php
require_once(dirname(__FILE__).'/model/settings/include.php');CheckUrl::url();

if(isset($_SESSION["mutasyon_login"])){

    switch (Get::getValue("u")) {
        case "products" :
            Products::build();
            break;
        case "products/detail" :
            Products::build("detail");
            break;
        case "cart" :
            Cart::build();
            break;
        case "buyCart" :
            Cart::build("buyCart");
            break;
        case "customers" :
            Customers::build();
            break;
        case "customers/detail" :
            Customers::build("detail");
            break;
        case "providers" :
            Providers::build();
            break;
        case "providers/detail" :
            Providers::build('detail');
            break;
        case "sellers" :
            Seller::build();
            break;
        case "seller/detail" :
            Seller::build('detail');
            break;
        case "invoices" :
            Invoice::build('list');
            break;
        case "invoices/detail" :
            Invoice::build('detail');
            break;
        case "addServiceInvoice" :
            Services::build('addServiceInvoice');
            break;
        case "service/detail" :
            Services::build('service/detail');
            break;
        case "settings" :
            Settings::build();
            break;
        default:
            Mainpage::build();
    }
}
else{
    if(@$_SESSION["loginKey"]){$key = @$_SESSION["loginKey"];}else{$key = Key::loginKey();}
    $smarty->assign(array('loginKey' => $key)); 
    $smarty->display ( 'view/login/login.html' );
}

?>