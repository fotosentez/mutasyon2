<?php
Class Event{
    
    function getRow($what = "", $id = ""){
        
        if($what == "customer"){
            return Dbase::getRows('*, strftime("%m", event_date) as month, strftime("%Y", event_date) as year, strftime("%d", event_date) as day  ', 'eventView', ' invoice_customer_id = '.Get::getValue("id").' OR payments_customers_id = '.Get::getValue("id").' ');
        }
        
    }
    
}

?>