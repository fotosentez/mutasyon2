<?php
Class Invoice{
    
    function getRow($what = "", $gid = ""){
	
	
	if($what){
	    
	    //Check gid
            if($gid){
                if(preg_match('/^[+0-9. ()\/-]*$/', $gid)){
                    $id = $gid;
                }
            }
            else{
                $id = Get::getValue('id');
            }
	    
	    
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
		    $getTable = Dbase::getRows('
		    *, 
		    (SELECT s_value FROM settings WHERE po_colors_id = s_id)                  AS colors, 
		    (SELECT options_name FROM options WHERE options_id = po_options_id)       AS options, 
		    products_prefix||SKU||po_sku                                              AS osku', 
		    'productsSold 
		    INNER JOIN invoice                                                        ON ps_invoice_id = invoice_id 
		    LEFT JOIN products_options                                                ON ps_products_options_id = po_id 
		    LEFT JOIN products                                                        ON ps_products_id = products_id', 
		    'ps_invoice_id = '.$id.' '); 
		}
		else{
		    $getTable = Dbase::getRows('*', 'productsSold INNER JOIN invoice ON ps_invoice_id = invoice_id', 'ps_invoice_id <> 0 ');
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
        
        if($what == 'total' OR $what == 'subTotal' OR $what == 'providerRemain' OR $what == 'remain'){
            
            /*------------------------------------------------------------
             */
            $total = 0;
            $invoiceTotal = self::getRow('invoiceTotal', $id);
            //------------------------------------------------------------
            
            
            
            /*---------TOTAL INCLUDE DISCOUNT-----------------------------
             */
            if($what == 'total'){
                $total = $invoiceTotal - self::getRow('invoice_discount', $id);
            }
            //------------------------------------------------------------
            
            
            
            /*-------TOTAL NOT INCLUDE DISCOUNT--------------------------
             */
            else if($what == 'subTotal'){
                $total = $invoiceTotal;
            }
            //-----------------------------------------------------------
            
            
            
            /*-------REMAIN (TOTAL-DISCOUNT-PAYMENTS)--------------------
             */
            else if($what == 'remain'){
                $total = self::findTotal('total', $id)-(self::getRow('invoice_discount', $id)+self::getRow('payments', $id));
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
