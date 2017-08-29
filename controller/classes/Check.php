<?php

Class Check {
    /*
     * ------------------------------------------------------------------------------------------------------------------------
     */        
    public static function cleanUniCode($pattern)
    {
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }
    
    /*
     * ------------------------------------------------------------------------------------------------------------------------
     */    
    
    
    
    /*------------------------CONTROL------------------------------------------------------------------------------------------
     */
    public static function control($what, $name, $inputname = '', $required = false)
    {
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post for it is name or not. It can not include special characters and numerics
        *   E.g. Check::control('name', $post, $inputname);
        */
        if($what == 'name'){$check = preg_match(Check::cleanUniCode('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/u'), stripslashes($name));$lang="validateText";}
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post for it is a validate address
        *   E.g. Check::control('address', $post, $inputname);
        */
        if($what == 'address'){$check = preg_match('/^[^<>;=#{}]*$/ui', $name);$lang="validateText";}
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post for it is a valiadete url
        *   E.g. Check::control('url', $post, $inputname);
        */
        if($what == 'url'){$check = preg_match( '/^[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$name);$lang="validateUrl";}
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post for it is a numeric or not if a numeric return true
        *   E.g. Check::control('numeric', $post, $inputname);
        */
        if($what == 'numeric'){
            if(preg_match('/^[+0-9. ()\/-]*$/', $name)){
                if($name > 0){
                    $check = true;
                }
                else{
                    $check = false;
                }
            }
            else{
                $check = false;
            }
            $lang="validateText";
        }
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check password strange. It must between 5 and 20 letters and include at least one numeric 
        *   E.g. Check::control('password', $post, $inputname);
        */
        if($what == 'password'){
            $check = preg_match("#.*^(?=.{5,20})(?=.*[a-z])(?=.*[0-9]).*$#", $name);
            $lang="validatePassword";
        }
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post like description. It can include numeric and special characters like :,_;
        *   E.g. Check::control('desc', $post, $inputname);
        */
        if($what == 'desc'){$check = preg_match('/^[^<>;=#{}]*$/ui', $name);$lang="validateDesc";}
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post for valiadete mail
        *   E.g. Check::control('mail', $post, $inputname);
        */
        if($what == 'mail'){$check = preg_match('/^[a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+(?:[.]?[_a-z\p{L}0-9-])*\.[a-z\p{L}0-9]+$/ui', $name);$lang="validateMail";}
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post for validate md5
        *   E.g. Check::control('md5', $post, $inputname);
        */
        if($what == 'md5'){$check = preg_match('/^[a-f0-9A-F]{32}$/', $name);$lang="validateMd5";}
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post for exist or not. If post is 1 when return true else return false 
        *   E.g. Check::control('exist', $post, $inputname);
        */
        if($what == 'exist'){if($name == 1){$check = true;}else{$check = false;}$lang="validateExist";}
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check equal two post. If two post equal when return true
        *   E.g. Check::control('equal', 'postOne,postTwo', $inputname);
        */
        if($what == 'equal'){$e = explode(',', $name);if($e[0] == $e[1]){$check = true;}else{$check = false;}$lang="validateEqual";}
        
        /*-------------------------------------------------------------------------------------------------------------------
        *   Check post for valiadete date
        *   E.g. Check::control('date', $post, $inputname);
        */
        if($what == 'date'){$d = DateTime::createFromFormat('Y-m-d', $name);$check = $d && $d->format('Y-m-d') === $name;$lang="validateDate";}
        //-------------------------------------------------------------------------------------------------------------------
        
        global $error;
        
        if($what){
            if($required == true){
                if($name){
                    if($check){Output::cleanRed();return true;}
                    else{return array_push($error, $inputname.','.$lang);}
                }
                else{return array_push($error, $inputname.','.$lang);}
            }
            else{
                if($name){
                    if($check){Output::cleanRed();return true;}
                    else{return array_push($error, $inputname.','.$lang);}
                }
                else{return true;}
            }
        }
        else{
            return false;
        }
        
    }
    //---------------------------------------------------------------------------------------------------------------
    
    
    
    
    /*---------------CHECK NUMBER OF CHARACTER-----------------------------------------------------------------------
     */
    public static function numberOfCharacters($value, $min, $max,  $inputname)
    {
        global $error;
        if( $min <= strlen($value) AND strlen($value) <= $max ){
            Output::cleanRed();
            return true;
        }
        else{//if address not valid
            array_push($error, $inputname);
            Output::addRed($inputname, 'validateShortInput');
            exit();
        }
    }
    //----------------------------------------------------------------------------------------------------------------
    
    
    
    
    /*---------------CHECK IBAN---------------------------------------------------------------------------------------
     */
    public static function checkIBAN($iban, $inputname)
    {
        $iban = strtolower($iban);
        $Countries = array(
            'al'=>28,'ad'=>24,'at'=>20,'az'=>28,'bh'=>22,'be'=>16,'ba'=>20,'br'=>29,'bg'=>22,'cr'=>21,'hr'=>21,'cy'=>28,'cz'=>24,
            'dk'=>18,'do'=>28,'ee'=>20,'fo'=>18,'fi'=>18,'fr'=>27,'ge'=>22,'de'=>22,'gi'=>23,'gr'=>27,'gl'=>18,'gt'=>28,'hu'=>28,
            'is'=>26,'ie'=>22,'il'=>23,'it'=>27,'jo'=>30,'kz'=>20,'kw'=>30,'lv'=>21,'lb'=>28,'li'=>21,'lt'=>20,'lu'=>20,'mk'=>19,
            'mt'=>31,'mr'=>27,'mu'=>30,'mc'=>27,'md'=>24,'me'=>22,'nl'=>18,'no'=>15,'pk'=>24,'ps'=>29,'pl'=>28,'pt'=>25,'qa'=>29,
            'ro'=>24,'sm'=>27,'sa'=>24,'rs'=>22,'sk'=>24,'si'=>19,'es'=>24,'se'=>24,'ch'=>21,'tn'=>24,'tr'=>26,'ae'=>23,'gb'=>22,'vg'=>24
            );
            $Chars = array(
                'a'=>10,'b'=>11,'c'=>12,'d'=>13,'e'=>14,'f'=>15,'g'=>16,'h'=>17,'i'=>18,'j'=>19,'k'=>20,'l'=>21,'m'=>22,
                'n'=>23,'o'=>24,'p'=>25,'q'=>26,'r'=>27,'s'=>28,'t'=>29,'u'=>30,'v'=>31,'w'=>32,'x'=>33,'y'=>34,'z'=>35
                );
                
                if (strlen($iban) != $Countries[ substr($iban,0,2) ]) { Output::checkError($inputname, 'validateIBAN');exit(); }
                
                $MovedChar = substr($iban, 4) . substr($iban,0,4);
                $MovedCharArray = str_split($MovedChar);
                $NewString = "";
                
                foreach ($MovedCharArray as $k => $v) {
                    
                    if ( !is_numeric($MovedCharArray[$k]) ) {
                        $MovedCharArray[$k] = $Chars[$MovedCharArray[$k]];
                    }
                    $NewString .= $MovedCharArray[$k];
                }
                if (function_exists("bcmod")) { return bcmod($NewString, '97') == 1; }
                
                // http://au2.php.net/manual/en/function.bcmod.php#38474
                $x = $NewString; $y = "97";
                $take = 5; $mod = "";
                
                do {
                    $a = (int)$mod . substr($x, 0, $take);
                    $x = substr($x, $take);
                    $mod = $a % $y;
                }
                while (strlen($x));
                
                return (int)$mod == 1;
    }
    //------------------------------------------------------------------------------------------------------------------
}



