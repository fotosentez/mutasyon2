<?php
Class Functions{
    
    /*---------------------GET SESSION FOR CHANGE VIEW OR ORDER LIST--------------
     * E.g. Functions::getSession('name');
     */
    function getSession($value){
        
        $order = $_SESSION['products']['order'];
        $view = $_SESSION['products']['view'];
        
        if($value == 'name'){
            if($order == 'nameASC'){return 'fa fa-caret-up green sortactive';}
            else if($order == 'nameDESC'){return 'fa fa-caret-down red';}
            else{return 'fa fa-sort';}
        }
        if($value == 'order'){
            if($order == 'orderASC'){return 'fa fa-caret-up green sortactive';}
            else if($order == 'orderDESC'){return 'fa fa-caret-down red';}
            else{return 'fa fa-sort';}
        }
        if($value == 'date'){
            if($order == 'dateASC'){return 'fa fa-caret-up green sortactive';}
            else if($order == 'dateDESC'){return 'fa fa-caret-down red';}
            else{return 'fa fa-sort';}
        }
        if($value == 'stock'){
            if($order == 'stockALL'){return 'fa fa-caret-up green sortactive';}
            else if($order == 'stockNONE'){return 'fa fa-caret-down red';}
            else{return 'fa fa-sort';}
        }
        if($value == 'price'){
            if($order == 'priceASC'){return 'fa fa-caret-up green sortactive';}
            else if($order == 'priceDESC'){return 'fa fa-caret-down red';}
            else{return 'fa fa-sort';}
        }
        if($value == 'view'){
            if($view == 'list'){return 'fa fa-th-list';}
            else if($view == 'grid'){return 'fa fa-th-large';}
            else{return 'fa fa-sort';}
        }
    }
    //----------------------------------------------------------------------------------------
    
    function convertColors($color = ""){
        if($color == "RED"){return "#ff0000";}
        else if($color == "GRN"){return "#00e600";}
        else if($color == "WHT"){return "#FFFFFF";}
        else if($color == "BLU"){return "#0039e6";}
    }
    
    
    
    /*------------------FIND ALL INVOICE TOTAL AND PAY TOTAL------------------------------------------------------------------
     */
    function findAllInvoiceTotal($what = 'total'){
        $getTotals = Dbase::getRows('sum(invoiceTotal) AS total, sum(payments) AS payTotal', 'invoiceView', 'invoice_id <> 0 AND invoice_cancelled = 0');
        
        if($getTotals){
            foreach($getTotals as $g){
                if($what == 'total'){return $g['total'];}
                else if($what == 'payTotal'){return $g['payTotal'];}
            }
        }
        
        if($what == "waitTotal"){
            $getWait = Dbase::getRows('sum(invoiceTotal) AS waitTotal, sum(payments) AS waitPayments', 'invoiceView', 'invoice_id <> 0 AND invoice_cancelled = 0 AND invoice_due_date >= '.IbniYunus::getDate('now'));
            
            if($getWait){
                foreach($getWait as $w){return $w['waitTotal']-$w['waitPayments'];}
            }
        }
        
        if($what == "noTotal"){
            $getWait = Dbase::getRows('sum(invoiceTotal) AS noTotal, sum(payments) AS noPayments', 'invoiceView', 'invoice_id <> 0 AND invoice_cancelled = 0 AND invoice_due_date < '.IbniYunus::getDate('now'));
            
            if($getWait){
                foreach($getWait as $w){return $w['noTotal']-$w['noPayments'];}
            }
        }
    }
    //-------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    
    /*------------------CHECK PROVIDERS INSERTED BEFORE OR NOT------------------------------------------------------------------
     */
    function cehckProvidersAndServices($what, $id){
        
        $checkCancelled = Dbase::getRow('invoiceView', 'invoice_id = '.$id, 'invoice_cancelled');
        
        if($what == "providers"){
            $checkProviderExist = Dbase::getRow('invoice', 'invoice_id = '.$id, 'invoice_providers_id');
            $checkProviderFee = Dbase::getRow('invoiceView', 'invoice_id = '.$id, 'invoice_providers_price');
            $checkProviderPayments = Dbase::getRow('invoiceView', 'invoice_id = '.$id, 'providersPaid');
            
            if($checkCancelled == 0){
                if(!empty($checkProviderExist)){
                    if($checkProviderFee > $checkProviderPayments){
                        return '<button class="btn btn-xs btn-warning pull-right" data-toggle="modal" data-target=".modalPayToProviders"><i class="glyphicon glyphicon-exclamation-sign"></i> '.Lang::getLang("payToProviders").'</button>';
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return '<button class="btn btn-xs btn-danger pull-right" data-toggle="modal" data-target=".modalProvidersToInvoice"><i class="glyphicon glyphicon-plus"></i> '.Lang::getLang("addProviders").'</button>';
                }
            }
            else{
                return false;
            }
        }
        else if($what == 'service'){
            $checkPayment = Dbase::getRow('invoiceView', 'invoice_id = '.$id, 'payments');
            $getStatus = Dbase::getRow('invoice', 'invoice_id = '.$id, 'invoice_status');
            
            if($checkCancelled == 0){
                if($checkPayment == 0){
                    if($getStatus == 0){
                        return '<button class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target=".modalAddServices"><i class="glyphicon glyphicon-plus"></i> '.Lang::getLang("addServices").'</button>';
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
    }
    //-------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    
    /*------------------CHECK INVOICE STATUS-----------------------------------------------------------------------------------
     */
    function checkServiceStatus($id){
        
        $status = Dbase::getRow('invoice', 'invoice_id = '.$id, 'invoice_status');
        $checkStatus = Dbase::getRow('invoice', 'invoice_id = '.$id, 'invoice_cancelled');
        $serviceTotal = Services::findTotal('total', $id);
        $servicePayments = Services::getRow('payments', $id);
        $getService = Dbase::getRow('servicesSold', 'ss_invoice_id = '.$id, 'ss_services_id');
        
        if($status == 1){
            if($serviceTotal > $servicePayments){
                return '<button class="btn btn-success pull-right" data-toggle="modal" data-target=".modalAddPayments"><i class="fa fa-credit-card"></i> '.Lang::getLang("addPayment").'</button><button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target=".modalCancelServices"><i class="glyphicon glyphicon-off"></i> '.Lang::getLang("cancelled").'</button>';
            }
            else{
                if($checkStatus == 0){
                    return '<button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target=".modalCancelServices"><i class="glyphicon glyphicon-off"></i> '.Lang::getLang("cancelled").'</button>';
                }
                else{
                    return false;
                }
            }
        }
        else{
            if($getService > 0){
                return '<button class="btn btn-info pull-right" data-toggle="modal" data-target=".modalCompromise"><i class="fa fa-handshake-o"></i> '.Lang::getLang("compromise").'</button>'; 
            }
            else{
                return false;
            }
        }
    }
    //-------------------------------------------------------------------------------------------------------------------------
    
    
    
}

?>