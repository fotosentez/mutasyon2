<?php
Class Providers{
    
    function getRow($what = "", $gid = ""){
        
        if($what){
            
            ($gid ? $id = $gid : $id = Get::getValue('id'));
            
            
            /*----------------PROVIDERS IMAGE-----------------------------------------
            */
            if($what == "image"){
                $coverImage = 'view/img/providers/'.$id.'.jpg';
                if (file_exists($coverImage)) {return $coverImage;} 
                else {return 'view/img/user.jpg';}
            }
            //------------------------------------------------------------------------
            
            
            /*----------------PROVIDERS EVENTS-----------------------------------------
            */
            if($what == "events"){
                
            }
            //------------------------------------------------------------------------
            
            
            
            else{
                return Dbase::getRow('providers', 'providers_id =  '.$id.' ', $what);
            }
        }
        else{
            return Dbase::getRows('*', 'providers', 'providers_status = 1 ');
        }
        
    }
    
    
    
    
    
    //Build page
    function build($page = "list"){
        
        if($page == "detail"){
            Page::build("providers/providerProfile", Lang::getLang("providerProfile"));
        }
        else if($page == "list"){
            Page::build("providers/providers", Lang::getLang("providers"));
        }
        
    }
}
?>