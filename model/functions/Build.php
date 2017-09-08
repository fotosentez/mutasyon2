<?php
Class Build{
    
    /*-------------------------------BUILD NO-------------------------------------------
     * Build invoice no. You must find last no firstly
     * You can find last no write : Invoice::lastNo();
     * E.g. Invoice::buildNewNo('00000001');
     */
    function buildNewNo($lastNo){
	if($lastNo){
            if(Check::control('numeric', $lastNo)){
                return sprintf("%06d", $lastNo+1);
            }
	}
	else{
            return sprintf("%06d", 1); 
	}
    }
    //-----------------------------------------------------------------------------------------------
}
?>