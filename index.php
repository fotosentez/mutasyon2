<?php
require_once(dirname(__FILE__).'/model/settings/settings.php');

/** Create Page **/
include 'model/top.php';
if (isset ( $_SESSION ["mutasyon_session"] )) {
    switch ($url) {
        case "invoices" :
            include ("model/invoice/invoices.php");
            break;
        case "invoices/add" :
            include ("model/invoice/addInvoice.php");
            break;
        case "customers" :
            include ("model/customers/customers.php");
            break;
        case "customers/add" :
            include ("model/customers/addCustomer.php");
            break;
        case "products" :
            include ("model/products/products.php");
            break;
        case "products/detail" :
            include ("model/products/productDetail.php");
            break;
        case "products/add" :
            include ("model/products/productAdd.php");
            break;
        case "categories/add" :
            include ("model/categories/addCategory.php");
            break;
        case "providers" :
        include ("model/providers/providers.php");
            break;
        case "providers/add" :
        include ("model/providers/addProviders.php");
            break;
        case "sellers" :
        include ("model/sellers/sellers.php");
            break;
        case "sellers/add" :
        include ("model/sellers/addSeller.php");
            break;
        case "cash" :
        include ("model/cash/cash.php");
            break;
        case "cash/add" :
        include ("model/cash/addCash.php");
            break;
        case "settings" :
        include ("model/settings.php");
            break;
        default:
            include ("model/mainPage.php");
    }
} else
    $smarty->display ( 'view/login/login.html' );
