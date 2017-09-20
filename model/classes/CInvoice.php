<?php

Class CInvoice{
    
    public $prefix;
    public $desc;
    public $adminId;
    public $customer;
    public $providers;
    public $providerPrice;
    public $discount;
    public $date;
    public $dueDate;
    public $invoiceType;
    public $status;
    public $newInvoiceId;
    public $amount;
    public $price;
    public $productsId;
    public $optionsId;
    
    
    /*--------------------------------ADD  NEW INVOICE-------------------------------------------------------------------------------
     $inv = new CInvoice();
     
     $inv->prefix               = $prefix;
     $inv->desc                 = $desc;
     $inv->customer             = $customer;
     $inv->providers            = $providers;
     $inv->providerPrice        = $providerPrice;
     $inv->date                 = $date;
     $inv->dueDate              = $dueDate;
     $inv->invoiceType          = $invoiceType;
     $inv->discount             = $discount;
     
     $inv->insert();
     
     */
    public function insert($infs, $amount){
        global $error;
        
        if(Check::control('numeric', $this->prefix, 'prefix', true)){
            if(Check::control('desc', $this->desc, 'desc')){
                if(Check::control('numeric', $this->customer, 'customer', true)){
                    if(Check::control('numeric', $this->providers, 'providers')){
                        if(Check::control('numeric', $this->providerPrice, 'providerPrice')){
                            if(Check::control('numeric', $this->discount, 'discount')){
                                if(Check::control('date', $this->date, 'date', true)){
                                    if(Check::control('date', $this->dueDate, 'dueDate', true)){
                                        if(Check::control('numeric', $this->status, 'status')){
                                            if($this->invoiceType == "s" OR $this->invoiceType == "p"){
                                                
                                                //Check products and its values------------------------------------------------
                                                foreach($infs as $i){
                                                    $a = explode('-', $i);
                                                    
                                                    $this->productsId         = $a[0];
                                                    $this->productsType       = $a[1];
                                                    $this->eachPrice          = $a[3];
                                                    $this->amountType         = $a[4];
                                                    $this->amount             = $amount.$a[0];
                                                    
                                                    if(Check::control('numeric', $this->productsId, $i, true)){
                                                        if(Check::control('numeric', $this->productsType, $i, true)){
                                                            if(Check::control('numeric', $this->eachPrice, $i, true)){
                                                                if(Check::control('numeric', $this->amountType, $i, true)){
                                                                    if(Check::control('numeric', $this->amount, $amount.$a[0], true)){
                                                                        echo $i;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    
                                                }
                                                //-------------------------------------------------------------------------------
                                                
                                            }
                                            else{
                                                array_push($error, 'invoiceType,validateText');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        
        if( empty($error) ){
            
            $getInvoicePrefixName   = Dbase::getRow('settings', 's_name = "prefix" AND s_id = '.$this->prefix, 's_value');
            $getLastInvoiceNo       = Invoice::getRow('lastNo', $this->prefix); //Get last invoice no of that prefix
            $newNo                  = Build::buildNewNo($getLastInvoiceNo); //Build new no
            
            $table = 'invoice';
            $values = array(
                'invoice_prefix_id'                 => $this->prefix,
                'invoice_no'                        => $newNo,
                'invoice_desc'                      => $this->desc,
                'invoice_superuser_id'              => $_SESSION["mutasyon_login"],
                'invoice_customer_id'               => $this->customer,
                'invoice_providers_id'              => $this->providers,                //Can NULL
                'invoice_providers_price'           => $this->providerPrice,            //Can NULL
                'invoice_discount'                  => $this->discount,
                'invoice_date'                      => $this->date,
                'invoice_due_date'                  => $this->dueDate,                  //Can NULL
                'invoice_type'                      => $this->invoiceType,              //p
                'invoice_status'                    => $this->status                    //1
                );
                $insertInvoice = Dbase::insert($table, $values );
                
                
                /*-----------Add products from invoice----------------------------------------------------
                 */
                if($insertInvoice){
                    foreach($infs AS $i){
                        $a = explode(',', $i);
                        
                        $this->productsId         = $a[0];
                        $this->productsType       = $a[1];
                        $this->eachPrice          = $a[3];
                        $this->amountType         = $a[4];
                        $this->amount             = $amount.$a[0];
                        $this->newInvoiceId     = $insertInvoice;
                        
                        if($this->productsType == 'options'){
                            $getProductsId              = Dbase::getRow('products_options', 'po_id = '.$getId, 'po_products_id');
                            $this->productsId           = $getProductsId;
                            $this->optionsId            = $getId;
                        }
                        else if($this->productsType == 'products'){
                            $this->productsId           = $getId;
                            $opId                       = NULL;
                        }
                        else{
                            exit();
                        }
                        
                        
                        $table = 'productsSold';
                        $values = array(
                            'ps_invoice_id'             => $this->newInvoiceId,
                            'ps_products_id'            => $this->productsId,
                            'ps_products_options_id'    => $this->optionsId,
                            'ps_amount'                 => $this->amount,
                            'ps_amount_type'            => $this->amountType,
                            'ps_price'                  => $this->eachPrice
                            );
                            $insertProducts = Dbase::insert($table, $values );
                        
                        
                    }
                }
                //-------------------------------------------------------------------------------------------
        }
        else{
            Output::error();
        }
        
    }
    //------------------------------------------------------------------------------------------------------------------------------------
    
    
    /*--------------------------------ADD  PRODUCTS TO INVOICE-------------------------------------------------------------------------------
     $inv->amount               = $amount;
     $inv->eachPrice            = $price;
     $inv->newInvoiceId         = $invoiceId;
     $inv->amountType           = $amountType;
     $inv->insertProducts( $productType, $getId, $invoiceId );
     
     */
    public function insertProducts( $productType, $getId, $invoiceId, $i ){
        global $error;
        $stepOne                = 0;
        $this->newInvoiceId     = $invoiceId;
        
        
        //Check values
        if(Check::control('numeric', $this->amount, 'amount'.$i, true)){
            if(Check::control('numeric', $this->eachPrice, 'eachPrice', true)){
                if(Check::control('numeric', $this->newInvoiceId, 'newInvoiceId', true)){
                    if(Check::control('numeric', $this->amountType, 'amountType', true)){
                        if(empty($error)){
                            $stepOne = 1;
                        }
                        else{
                            Output::error();
                        }
                    }
                }
            }
        }

        if($stepOne == 1){
            
            if($productType == 'options'){
                $getProductsId              = Dbase::getRow('products_options', 'po_id = '.$getId, 'po_products_id');
                $this->productsId           = $getProductsId;
                $this->optionsId            = $getId;
            }
            else if($productType == 'products'){
                $this->productsId           = $getId;
                $opId                       = NULL;
            }
            else{
                exit();
            }
            
            $table = 'productsSold';
            $values = array(
                'ps_invoice_id'             => $this->newInvoiceId,
                'ps_products_id'            => $this->productsId,
                'ps_products_options_id'    => $this->optionsId,
                'ps_amount'                 => $this->amount,
                'ps_amount_type'            => $this->amountType,
                'ps_price'                  => $this->eachPrice
                );
                return Dbase::insert($table, $values );
        }
    }
    //---------------------------------------------------------------------------------------------------------------------------------------
    
    
    /*--------------------------------REMOVE NULLED INVOICE-------------------------------------------------------------------------------
     $inv->newInvoiceId         = $invoiceId;
    
     $inv->removeNullInvoice( $inv->newInvoiceId );
     
     */
    public function removeNullInvoice( $invoiceId ){
        global $error;
        $stepOne                = 0;
        $this->newInvoiceId     = $invoiceId;
        
        
        //Check values
        if(Check::control('numeric', $this->newInvoiceId, 'newInvoiceId', true)){
            if(empty($error)){
                $stepOne = 1;
            }
            else{
                Output::error();
            }
        }

        if($stepOne == 1){
            
            return Dbase::delete('invoice', 'NOT EXISTS ( SELECT * FROM productsSold WHERE ps_invoice_id = invoice_id ) AND invoice_id = '.$this->newInvoiceId);
            
        }
    }
    //---------------------------------------------------------------------------------------------------------------------------------------
    
    
}

?>
