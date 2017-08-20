<?php
Class IbniYunus{
    
    function getDate($what = ""){
        
        /*---------------------------------------------------
         * Get now
         * E.g. IbniYunus::getDate('now')
         */
        if($what == "now"){
            return date('Y-m-d');
        }
        //----------------------------------------------------
        
        
        /*----------------------------------------------------
         * Get a month later after today
         * E.g. IbniYunus::getDate('amonthlater');
         */
        else if($what == 'amonthlater'){
            
            $date = new DateTime(self::getDate('now'));            
            $date->modify('+1 months');
            return $date->format('Y-m-d');
        }
        //----------------------------------------------------
    }
    
}

?>