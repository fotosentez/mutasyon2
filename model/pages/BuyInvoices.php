<?php
Class BuyInvoices{
    /*
     * BuyInvoices::getRow()                             For get all buyinvoices
     * BuyInvoices::getRow("bi_detail")                  For get detail of buyinvoices
     * BuyInvoices::getRow("bi_no")                      For get invoice no of this buyinvoices 
     * BuyInvoices::getRow("bi_date")                      For get invoice date of this buyinvoices 
     * BuyInvoices::getRow("lastId")                      For get last id of inserted buy invoices
     * BuyInvoices::getRow("lastNo")                      For get last no of inserted buy invoices
     * BuyInvoices::getRow("exist")                      For check buy invoices exist or not
     */        
    
    
    function getRow($what = "", $gid = ""){
        
        if($what){
            
            ($gid ? $id = $gid : $id = Get::getValue('id'));
            
            
            if($what == "lastId"){
                return Dbase::getRow('buyInvoice', 'bi_superuser_id = '.Superuser::getRow('superuser_id').' ORDER BY bi_id DESC', 'bi_id');
            }
            else if($what == "lastNo"){
                return Dbase::getRow('buyInvoice', 'bi_id <> 0 ORDER BY bi_id DESC', 'bi_no');
            }
            else{
                return Dbase::getRow('buyInvoice', 'bi_id =  '.$id.' ', $what);
            }
        }
        else{
            return Dbase::getRows('*', 'buyInvoice', 'bi_id <> 0 ');
        }
        
    }
    
    
    //Build page
    function build($page = "list"){
        
        if($page == "detail"){
            Page::build("invoices/buyInvoicesDetail", self::getRow("products_name"));
        }
        else if($page == "list"){
            Page::build("invoices/buyInvoices", Lang::getLang("buyInvoices"));
        }
        
    }
}


?>