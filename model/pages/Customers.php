<?php
Class Customers{
    
    function getRow($what = "", $gid = ""){
        //Check gid
        if($gid){$id = $gid;}else{$id = Get::getValue('id');}
        
        
        /*-------------------CUSTOMERS IMAGE------------------------
         */
        if($what == 'image'){
            $image = 'view/img/customers/'.$id.'.jpg';
            if (file_exists($image)) {return $image;} 
            else {return 'view/img/user.jpg';}
        }
        //----------------------------------------------------------
        
        
        
        else{
            if($what){
                return Dbase::getRow('customersView', 'customers_id = '.$id.' AND '.$what.' IS NOT NULL ', $what);
            }
            else{
                return Dbase::getRows('*', 'customersView', 'customers_id <> 0');
            }
        }
    }
    
    
    
    
    //Build page
    function build($page = "list"){
        
        if($page == "detail"){
            Page::build("customers/customerProfile", Lang::getLang("customerProfile"));
        }
        else if($page == "list"){
            Page::build("customers/customers", Lang::getLang("customers"));
        }
        
    }
}


?>
