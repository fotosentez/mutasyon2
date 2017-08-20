<?php

Class Superuser{
    
    
    function getRow($what = "", $gid = ""){
                
        /*------------------------------------------------------------------------------------------------------------------
         * Check superuser status. If superuser status is 1 (its means superuser) then he/she can check/get other superuser 
         * or admin informations. If status is not 1 (its means not superuser) then he/she can not check/get other superuser or admin informations
         * but herself/himself
         */
        if($gid){
            if(Check::control('numeric', $gid)){
                
                //Get user status
                $status = Dbase::getRow('superuser', 'superuser_id = '.@$_SESSION["mutasyon_login"].' ', 'superuser_status');
                
                if($status == 1){$id = $gid;}else{$id = @$_SESSION["mutasyon_login"];}
            }
        }
        else{
            $id = @$_SESSION["mutasyon_login"];
        }
        //-------------------------------------------------------------------------------------------------------------------
        
        
        
        /*-------------------------------------------------------------------------------------------------------------------
         * Get superuser lang
         * E.g Superuser::getRow('lang', 1)
         */
        if($what == "lang"){
            return Dbase::getRow('superuser LEFT JOIN settings ON superuser_language = s_id ', 'superuser_id = '.$id.' ', 's_attributes');
        }
        //-------------------------------------------------------------------------------------------------------------------
        
        
        
        else if($what == "status"){
            return Dbase::getRow('superuser LEFT JOIN adminStatus ON as_id  = superuser_status ', 'superuser_id = '.$id.' ', 'as_name');
        }
        
        
        
        /*-----------------------------------------------------------------------------------------
         * Get superuser profile image
         *E.g. Superuser::getRow('image', 1)
         */
        else if($what == "image"){
            
            $profileImage = 'view/img/'.$id.'.jpg';
            
            if (file_exists($profileImage)) {
                return $profileImage;
            } 
            else {
                return 'view/img/user.png';
            }
            
        }
        //----------------------------------------------------------------------------------------
        
        
        
        /*-----------------------------------------------------------------------------------------
         * Get superuser rows
         *E.g. Superuser::getRow('superuser_name', 1)
         */
        else{
            return Dbase::getRow('superuser', 'superuser_id = '.$id.' ', $what);
        }
        //-------------------------------------------------------------------------------------------------------
        
    }
    
    
    
    //Build page
    function build($page = "list"){
        
        if($page == "detail"){
            Page::build("superuser/superuserProfile", Lang::getLang("superuser"));
        }
        else if($page == "list"){
            Page::build("superuser/superuser", Lang::getLang("superuser"), 2);
        }
        
    }
    
    
}

?>