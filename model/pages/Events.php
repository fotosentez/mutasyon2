<?php
Class Events{
    
    public function getRow($what = '', $where = 'event_id <> 0'){
        
        if($what == 'buyinvoice'){
            return Dbase::getRows('*', 'eventView', 'event_type = buyinvoice_added LIMIT 4 ');
        }
        else if($what == 'invoice'){
            return Dbase::getRows('*', 'eventView', 'event_type = invoice_added LIMIT 4 ');
        }
        else if($what == 'payment_added'){
            return Dbase::getRows('*', 'eventView', 'event_type = payment_added LIMIT 4 ');
        }
        else{
            return Dbase::getRows('*', 'eventView', $where);
        }
    }
    
    
}


?>