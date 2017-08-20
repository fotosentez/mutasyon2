<?php
Class Invoice{
    
    function getRow($what = "", $gid = ""){
	
	
	if($what){
	    
	    //Check gid
            if(preg_match('/^[+0-9. ()\/-]*$/', $gid)){$id = $gid;}else{$id = Get::getValue('id');}
	    
	    
	    /*--------------------------GET LAST NO---------------------------------------
	     * Get last invoice no 
	     * E.g: Invoice::getRow('lastNo');
	     */
	   if($what == "lastNo"){
		
               $getTable = Dbase::getRow('invoice', 'invoice_prefix_id = '.$id.' ORDER BY invoice_id DESC ', 'invoice_no');
		
	    }
	    //---------------------------------------------------------------------------------------------
	    
	    
	    
	    
	    /*---------------------------INVOICE STATUS-------------------------------------------------
	     * Get last invoice status 
	     * E.g: Invoice::getRow('status');
	     */
	    else if($what == "status"){
		
		$total = self::findTotal('total', $id);
		$payments = self::getRow('payments', $id);
		$now = date("Y-m-d");
		$due = self::getRow('invoice_due_date', $id);
		
		if(self::getRow('invoice_cancelled', $id) != 1){
		    
                    if($payments < $total){if($due > $now){return "waiting";}else{return "unpaid";}}
		    else{return "paid";}
		}
		else{return "cancelled";}
		
	    }
	    //---------------------------------------------------------------------------------------------
	    
	    
	    
	    /*---------------------------------PRODUCTS------------------------------------------------
	     * Get products of invoice
	     * E.g: Invoice::getRow('products');
	     */
	    else if($what == "products"){
		
		if($id){
		    $getTable = Dbase::getRows('*', 'productsSold INNER JOIN products ON products_id = ps_products_id INNER JOIN invoice ON ps_invoice_id = invoice_id', 'ps_invoice_id = '.$id.' '); 
		}
		else{
		    $getTable = Dbase::getRows('*', 'productsSold INNER JOIN products ON products_id = ps_products_id INNER JOIN invoice ON ps_invoice_id = invoice_id', 'ps_invoice_id <> 0 ');
		}
		
	    }
	    //---------------------------------------------------------------------------------------------
	    
	    
	    
	    
	    /*---------------------------------------------------------------------------------------------
	     * Get inivoice tables like id, customer name ...
	     * E.g. Invoice::getRow('customers_name', 10)
	     */
	    else{
		
                $getTable = Dbase::getRow('invoiceView', 'invoice_id = '.$id.' ', $what);

		
	    }
	}
	else{
	    
            $getTable = Dbase::getRows('*', 'invoiceView', 'invoice_id <> 0 GROUP BY invoice_id ');
	    
	}
	//-------------------------------------------------------------------------------------------------
	
	
	return $getTable;
	
    }
    
    
    
    /*-----------------------------------------------------------------------------------------------
     * Find invoice subtotal, discount or total. For all invoices total please not write id.
     * Sub total means total but not include discount.
     * Total means all total include discount too.
     * E.g. Invoice::findTotal('total', 1);
     */
    function findTotal($what = "", $id = ""){
        
        if($what == 'total' OR $what == 'subTotal' OR $what == 'discount' OR $what == 'providerRemain'){
            
            /*------------------------------------------------------------
             */
            $total = 0;
            $invoiceTotal = self::getRow('invoiceTotal', $id);
            $discount = self::getRow('invoice_discount', $id);
            $discountType = self::getRow('invoice_discount_type', $id);
            //------------------------------------------------------------
            
            
            
            /*---------TOTAL INCLUDE DISCOUNT-----------------------------
             */
            if($what == 'total'){
                if($discountType == 'percent'){
                    $total = $invoiceTotal - $invoiceTotal*$discount/100;
                }
                else if($discountType == 'amount'){
                    $total = $invoiceTotal - $discount;
                }
                else{
                    $total = 0;
                }
            }
            //------------------------------------------------------------
            
            
            
            /*-----------DISCOUNT-----------------------------------------
             */
            else if($what == 'discount'){
                if($discountType == 'percent'){
                    $total = $invoiceTotal*$discount/100;
                }
                else if($discountType == 'amount'){
                    $total = $discount;
                }
                else{
                    $total = 0;
                }
            }
            //-----------------------------------------------------------
            
            
            
            /*-------TOTAL NOT INCLUDE DISCOUNT--------------------------
             */
            else if($what == 'subTotal'){
                $total = $invoiceTotal;
            }
            //-----------------------------------------------------------
            

            //------------IF ERROR------------------------------------------------------------------
            return sprintf("%.2f", $total);
        }
    }
    //-----------------------------------------------------------------------------------------------
    
    
    
    
    
    //Build page
    function build($page = "list"){
	
	if($page == "detail"){
            $getInvoiceType = Dbase::getRow('invoiceView', 'invoice_id = '.Get::getValue('id'), 'invoice_type');
            
            if($getInvoiceType == "i"){
                Page::build("invoice/invoiceDetail", Lang::getLang("invoiceDetail"));
            }
            else{
                Page::build("invoice/serviceDetail", Lang::getLang("serviceDetail"));
            }
            
	}
	else if($page == "list"){
	    Page::build("invoice/invoices", Lang::getLang("invoices"));
	}
	
    }
}

?>