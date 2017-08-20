<?php
Class Services{
    
    function getRow($what, $gid = ""){
        //Check gid
        if($gid){$id = $gid;}else{$id = Get::getValue('id');}
        
        
        
        /*----------GET SERVICE PRODUCT TYPE-------------------------------
         */
        if($what == 'serviceProductType'){
            $getTable = Dbase::getRows('*', 'subcategory', 'subcategory_id <> 0');
        }
        //-----------------------------------------------------------------
        
        
        
        /*----------GET SERVICE PRODUCTS-------------------------------
         */
        else if($what == 'servicesSold'){
            $getTable = Dbase::getRows('*, (ss_amount*ss_price) AS total', 'servicesSold LEFT JOIN services ON ss_services_id = services_id', 'ss_invoice_id = '.$id);
        }
        //-----------------------------------------------------------------
        
        
        
        /*----------GET SERVICES------------------------------------------
         */
        else if($what == 'services'){
            $getTable = Dbase::getRows('*', 'services', 'services_id <> 0 AND services_status = 1');
        }
        //-----------------------------------------------------------------
        
        
        
        /*----------GET SERVICE ROWS-------------------------------
         */
        else{
            $getTable = Dbase::getRow('invoiceView', 'invoice_id ='.$id.' AND '.$what.' IS NOT NULL ', $what);
        }
        //-----------------------------------------------------------------
        
        return $getTable;
    }
    
    
    
    /*-----------------------------------------------------------------------------------------------
     * Find invoice subtotal, discount or total. For all invoices total please not write id.
     * Sub total means total but not include discount.
     * Total means all total include discount too.
     * E.g. Invoice::findTotal('total', 1);
     */
    function findTotal($what, $gid = ""){
        
        //Check gid
        if($gid){$id = $gid;}else{$id = Get::getValue('id');}
        
        /*------------------------------------------------------------
         */
        $total = 0;
        $invoiceTotal = self::getRow('serviceTotal', $id);
        $discount = self::getRow('invoice_discount', $id);
        $discountType = self::getRow('invoice_discount_type', $id);
        //------------------------------------------------------------
        
        
        
        /*---------TOTAL (INCLUDE DISCOUNT)-----------------------------
         */
        if($what == 'total'){
            if($discountType == 'percent'){$total = $invoiceTotal - $invoiceTotal*$discount/100;}
            else if($discountType == 'amount'){$total = $invoiceTotal - $discount;}
            else{$total = 0;}
        }
        //------------------------------------------------------------
        
        
        
        /*-----------DISCOUNT-----------------------------------------
         */
        if($what == 'discount'){
            if($discountType == 'percent'){$total = $invoiceTotal*$discount/100;}
            else if($discountType == 'amount'){$total = $discount;}
            else{$total = 0;}
        }
        //-----------------------------------------------------------
        
        
        
        /*-------TOTAL NOT INCLUDE DISCOUNT--------------------------
         */
        if($what == 'subTotal'){$total = $invoiceTotal;}
        //-----------------------------------------------------------
        
        
        
        /*-------REMAIN FEE OF PROVIDER OF INVOICE-------------------
         */
        if($what == 'providerRemain'){
            $providerTotal = self::getRow('invoice_providers_price', $id);
            $providerPaid = self::getRow('providersPaid', $id);
            
            $total = $providerTotal-$providerPaid;
        }
        //-----------------------------------------------------------
        
        return sprintf("%.2f", $total);
    }
    //-----------------------------------------------------------------------------------------------
    
    
    
    
    //Build page
    function build($page = "addServiceInvoice"){
        
        if($page == "addServiceInvoice"){
            Page::build("invoice/addServiceInvoice", Lang::getLang("serviceFirstStep"));
        }
        
    }
}

?>