<?php
Class Seller{
    /*
     * Seller::getRow()                             For get all seller
     * Seller::getRow("seller_name")                For get name of seller
     * Seller::getRow("invoices")                   For get all buy invoices of this seller 
     * Seller::getRow("exist")                      For check that seller is exist or not
    */        
    
    
    function getRow($what = "", $gid = ""){
        
        if($what){
            
            ($gid ? $id = $gid : $id = Get::getValue('id'));
            
            if($what == "invoices"){
                return Dbase::getRows('*', 'buyInvoice', 'bi_seller_id = '.$id.' ');
            }
            else if($what == "exist"){
                return Dbase::isExist('seller', 'seller_id = '.$id.' AND seller_status = 1');
            }
            else{
                return Dbase::getRow('seller', 'seller_id =  '.$id.' ', $what);
            }
        }
        else{
            return Dbase::getRows('*', 'seller', 'seller_id <> 0 ');
        }
        
    }
    
    
    
    
    
    
    
    //Build page
    function build($page = "list"){
        
        if($page == "detail"){
            Page::build("sellers/sellerProfile", Lang::getLang("sellerProfile"));
        }
        else if($page == "list"){
            Page::build("sellers/sellers", Lang::getLang("sellers"));
        }
        
    }
}

?>