<?php

Class CBuyInvoice{
    public $sellerId;//For buy invoice
    public $customer;//For return invoice
    public $desc;
    public $no;
    public $date;
    public $adminId;
    public $isVirtual;//For pay to customer or seller
    public $buyPayment;//Pay amount of seller or customer
    public $cashId;
    public $payType;//payment type like cash or credit card
    public $productsId;
    public $amount;
    public $amountType;//Amount type like piece or golon
    public $profit;
    public $profitType;//Profit type like percent or amount
    public $eachPrice;//Buy pay
    public $newInvoiceId;//New invoice id
    public $invoiceId;//Old invoice id
    public $stepOne = 0;
    
    
    /*-------------------------------------------------------------------------------------
    $buy                = new CBuyInvoice();
    $buy->desc          = $desc;
    $buy->adminId       = $adminId;
    $buy->sellerId      = $sellerId;
    $buy->customer      = $customer;
    $buy->date          = $date;
    $buy->cashId        = $cashId;
    $buy->payType       = $payType;
    $buy->buyPayment    = $buyPayment;
    $buy->isVirtual     = $isVirtual;
    
    
    $buy->newInvoiceId = $buy->insert();
    
    //If invoice was made
    if($buy->newInvoiceId){
        foreach($productID as $pn){
            $buy->amount            = $amount[$i];
            $buy->amountType        = $amountType[$i];
            $buy->eachPrice         = $eachPrice[$i];
            $buy->profit            = $profit[$i];
            $buy->profitType        = $profitType[$i];
            
            $buy->insertProducts($what[$i], $pn);
            
            $i++;
        }
        
        //Add payment if not virtual products
        if($buy->isVirtual != "on"){
            $buy->insertPayments($buy->newInvoiceId);
        }
    */
    
    
    /*--------------INSERT BUY INVOICE-------------------------------------------------------------------------------------------------------
     */
    public function insert(){
        global $error;
       
        if(Check::control('desc', $this->desc, 'desc', true)){
            if(Check::control('numeric', $this->adminId, 'adminId', true)){
                if(Check::control('date', $this->date, 'date', true)){
                    if(Check::control('numeric', $this->customer, 'customer')){
                        if(Check::control('numeric', $this->sellerId, 'sellerId')){
                            if(empty($error)){
                                //If customer id posted it means this is a return invoice
                                if($this->customer){
                                    $sId                        = NULL;
                                    $cId                        = $this->customer;
                                    $type                       = "r";
                                    $this->stepOne              = 1;
                                }
                                
                                //For buy invoice
                                else if($this->sellerId){
                                    $sId                        = $this->sellerId;
                                    $cId                        = NULL;
                                    $type                       = "b";
                                    $this->stepOne              = 1;
                                }
                                else{
                                    exit();
                                }
                            }
                            else{
                                return Output::error();
                            }
                        }
                    }
                }
            }
        }
        
        
        if($this->stepOne == 1){
            $getLastNo = Dbase::getRow('buyInvoice', 'bi_id <> 0 ORDER BY bi_id DESC', 'bi_no');
            $newNo = Build::buildNewNo($getLastNo);
            
            $table = 'buyInvoice';
            $values = array(
                'bi_detail'             => $this->desc,     //Not NULL
                'bi_superuser_id'       => $this->adminId,  //Not NULL
                'bi_no'                 => $newNo,          //Not NULL
                'bi_seller_id'          => $sId,            //Can NULL
                'bi_customers_id'       => $cId,            //Can NULL
                'bi_date'               => $this->date,     //Not NULL
                'bi_type'               => $type,           //Not NULL
                );
                $getId = Dbase::insert($table, $values );
                if($getId){
                    return $getId;
                }
                else{
                    echo "Fatura oluşturma hatası";
                    exit();
                }
        }
    }
    //---------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    /*----------------------INSERT PRODUCTS TO BUY INVOICE-----------------------------------------------------------------------------------
     */
    public function insertProducts($what, $id){
        global $error;
        
        //Check values
        if(Check::control('numeric', $this->amount, 'amount', true)){
            if(Check::control('numeric', $this->eachPrice, 'eachPrice')){
                if(Check::control('numeric', $this->newInvoiceId, 'newInvoiceId', true)){
                    if(Check::control('numeric', $this->amountType, 'amountType')){
                        if(Check::control('numeric', $this->profit, 'profit')){
                            if(Check::control('numeric', $this->profitType, 'profitType')){
                                if(Check::control('numeric', $id, '', true)){
                                    if(empty($error)){
                                        $this->stepOne = 1;
                                    }
                                    else{
                                        Output::error();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        
        //If values are validate
        if($this->stepOne == 1){
            if($what == 'options'){
                $getProductsId              = Dbase::getRow('products_options', 'po_id = '.$id, 'po_products_id');
                $this->productsId           = $getProductsId;
                $opId                       = $id;
            }
            else if($what == 'products'){
                $this->productsId           = $id;
                $opId                       = NULL;
            }
            else{
                exit();
            }
            
            
            $table = 'purchasedProducts';
            $values = array(
                'pp_products_id'                => $this->productsId,   //Not NULL
                'pp_products_options_id'        => $opId,               //Can NULL
                'pp_amount'                     => $this->amount,       //Not NULL
                'pp_amount_type'                => $this->amountType,   //Can NULL
                'pp_price'                      => $this->eachPrice,    //Not NULL
                'pp_profit'                     => $this->profit,       //Can NULL
                'pp_profit_method'              => $this->profitType,   //Can NULL
                'pp_bi_id'                      => $this->newInvoiceId, //Not NULL
                );
                $insert = Dbase::insert($table, $values );
                if($insert){
                    return $insert;
                }
                else{
                    echo "Ürün ekleme hatası";
                    exit();
                }
        }
    }
    //---------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    /*--------------------------ADD PAYMENTS-------------------------------------------------------------------------------------------------
     */
    public function insertPayments($newInvoiceId){
        
        $this->newInvoiceId = $newInvoiceId;
        
        global $error;
        
        //Check values
        if(Check::control('numeric', $this->newInvoiceId, 'newInvoiceId', true)){
            if(Check::control('numeric', $this->adminId, 'adminId', true)){
                if(Check::control('numeric', $this->newInvoiceId, 'newInvoiceId', true)){
                    if(Check::control('numeric', $this->payType, 'payType', true)){
                        if(Check::control('numeric', $this->buyPayment, 'buyPayment')){
                            if(Check::control('numeric', $this->customer, 'customer')){
                                if(Check::control('numeric', $this->sellerId, 'sellerId')){
                                    if(Check::control('date', $this->date, 'date', true)){
                                        if(Check::control('numeric', $this->cashId, 'cashId', true)){
                                            $checkPayType = Dbase::isExist('settings', 's_name = "payType" AND s_id = '.$this->payType);
                                            if($checkPayType){
                                                $checkCash = Dbase::isExist('settings', 's_name = "cash" AND s_id = '.$this->cashId);
                                                if($checkCash){
                                                    if(empty($error)){
                                                        $this->stepOne = 1;
                                                    }
                                                    else{
                                                        Output::error();
                                                    }
                                                }
                                                else{
                                                    array_push($error, 'cashId,cashNotFound');
                                                }
                                            }
                                            else{
                                                array_push($error, 'payType,payTypeNotFound');
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
        
        
        if($this->stepOne == 1 AND $this->isVirtual != 'on'){
            $no = Dbase::getRow('buyInvoice', 'bi_id = '.$this->newInvoiceId, 'bi_no');
            
            $payments = 'payments';
            $vpayments = array(
                'payments_customers_id'                 => $this->customer,                    //Can NULL
                'payments_bi_id'                        => $this->newInvoiceId,
                'payments_seller_id'                    => $this->sellerId,                    //Can NULL
                'payments_cash_id'                      => $this->cashId,
                'payments_superuser_id'                 => $this->adminId,
                'payments_type'                         => $this->payType,
                'payments_category'                     => 'invoice',
                'payments_in_out'                       => "out",
                'payments_amount'                       => $this->buyPayment,
                'payments_desc'                         => $no.Lang::getLang('addBuyPayment'),
                'payments_date'                         => $this->date,
                );
                $insert = Dbase::insert($payments, $vpayments );
                if($insert){
                    return $insert;
                }
                else{
                    echo "Ödeme ekleme hatası";
                    exit();
                }
        }
        
    }
    //---------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    //-------------------------------CANCEL INVOICE------------------------------------------------------------------------------------------
    public function cancel($id){
        global $error;
        
        if(Check::control('numeric', $id, 'id', true)){
            $this->invoiceId = $id;$this->stepOne = 1;
        }
        
        if(empty($error) AND $this->stepOne == 1){
            $table                  = 'buyInvoice';
            
            $values = array(
                'bi_cancelled'      => 1
                );
                
                $insert             = Dbase::update($table, $values, 'bi_id = '.$this->invoiceId );
            
            if($insert){
                return true;
            }
            else{
                return false;
                exit();
            }
        }
        
    }
    //---------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    //-------------------------------REDUCE PRODUCTS AMOUNT FROM INVOICE FOR CANCEL INVOICE--------------------------------------------------
    public function reduceAmount($psId, $amount){
        global $error;
        
        if(Check::control('numeric', $psId, 'id', true)){
            if(Check::control('numeric', $amount, 'amount', true)){
                if(empty($error)){
                    $this->amount = $amount;
                    $this->stepOne = 1;
                }
                else{
                    Output::error();
                }
            }
        }
        
        if($this->stepOne == 1){
            
            $reduce = Dbase::updateOneRow('productsSold', 'ps_amount = (ps_amount - '.$this->amount.') ', 'ps_id = '.$psId);
            
            if($reduce){
                echo Lang::getLang('proccessSuccess');
            }
            else{
                echo "Miktar ayarlanırken hata ile karşılaşıldı";
                exit();
            }
        }
        
    }
    //---------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    //-------------------------------REMOVE EMPTY PRODUCTS INVOICE---------------------------------------------------------------------------
    public function removeEmptyInvoice($id){
        global $error;
        
        if(Check::control('numeric', $id, 'id', true)){
            $this->newInvoiceId         = $id;
            $checkHaveProducts          = Dbase::isExist('purchasedProducts', 'pp_bi_id = '.$this->newInvoiceId);
            
            
            if($checkHaveProducts){
                if(empty($error)){
                    $this->stepOne = 1;
                }
            }
            else{
                array_push($error, 'id,invoiceHasProducts');
            }
        }
        
        if($this->stepOne == 1){
            
            $remove = Dbase::delete('buyInvoice', 'bi_id = '.$this->newInvoiceId);
            
            if($remove){
                echo Lang::getLang('proccessSuccess');
            }
            else{
                echo "Fatura kaldırılırken hata ile karşılaşıldı";
                exit();
            }
        }
        
    }
    //---------------------------------------------------------------------------------------------------------------------------------------
    
}


?>
