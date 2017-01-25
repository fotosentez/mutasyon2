<?php
Class Check {
    /*
     * -------------------------------------------------------------------------------------------------------------------------------------
     */        
    //For clear javascript codes
    public static function cleanScript($html)
    {
        $events = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange';
        $events .= '|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave|onerror|onselect|onreset|onabort|ondragdrop|onresize|onactivate|onafterprint|onmoveend';
        $events .= '|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onmove';
        $events .= '|onbounce|oncellchange|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondeactivate|ondrag|ondragend|ondragenter|onmousewheel';
        $events .= '|ondragleave|ondragover|ondragstart|ondrop|onerrorupdate|onfilterchange|onfinish|onfocusin|onfocusout|onhashchange|onhelp|oninput|onlosecapture|onmessage|onmouseup|onmovestart';
        $events .= '|onoffline|ononline|onpaste|onpropertychange|onreadystatechange|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onsearch|onselectionchange';
        $events .= '|onselectstart|onstart|onstop';
        if (preg_match('/<[\s]*script/ims', $html) || preg_match('/('.$events.')[\s]*=/ims', $html) || preg_match('/.*script\:/ims', $html)) {
            return false;
        }
        if (preg_match('/<[\s]*(i?frame|form|input|embed|object)/ims', $html)) {
            return false;
        }
        return true;
    }
    
    public static function cleanUniCode($pattern)
    {
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }
    
    //For clear all tag of html
    public static function clearCode($pattern)
    {
        if (!defined('PREG_BAD_UTF8_OFFSET')) {
            return $pattern;
        }
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }
    
    //For checking find amount of characters
    public static function strlen($str, $encoding = 'UTF-8')
    {
        if (is_array($str))
            return false;
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        if (function_exists('mb_strlen'))
            return mb_strlen($str, $encoding);
        return strlen($str);
    }
    
    //Clear all tag
    public static function clearTag($input)
    {
        return preg_replace("/[^\p{L}\p{N}.:+,-?=<> ]/u", ' ', $input);
    }
    
    public static function cleanHtmlCode($post)
    {
        return strip_tags($post);
    }
    
    /*
     * -------------------------------------------------------------------------------------------------------------------------------------
     */    
    //List of all functions for mutasyon2
    
    //For checking post numeric or not
    public static function isNumeric($value, $inputname)
    {
        if(preg_match('/^[+0-9. ()\/-]*$/', $value)){
            Output::cleanRed();
            return true;
        }
        else{
            echo Output::checkError($inputname, 'validateNumber');
            exit();
        }
    }
    
    //For checking post is a name or not. This can't include numeric
    public static function isName($name, $inputname, $required=false)
    {
        if($required == true){
            if($name){
                if(preg_match(Check::cleanUniCode('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/u'), stripslashes($name))){
                    Output::cleanRed();
                    return true;
                }
                else{
                    echo Output::checkError($inputname, 'validateText');
                    exit();
                }
            }
            else{
                echo Output::checkError($inputname, 'validateText');
                exit();
            }
        }
        else{
            if(preg_match(Check::cleanUniCode('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/u'), stripslashes($name))){
                Output::cleanRed();
                return true;
            }
            else{
                echo Output::checkError($inputname, 'validateText');
                exit();
            }
        }
    }
    
    //Checking password strong
    public static function isPasword($passwd, $inputname)
    {        
        if (preg_match("#.*^(?=.{5,20})(?=.*[a-z])(?=.*[0-9]).*$#", $passwd)){
            Output::cleanRed();
            return true;
        } else {
            echo Output::checkError($inputname, 'validatePassword');
            exit();
        }
    }
    
    //For cheking product name. This can inlude numeric
    public static function isProductName($name, $inputname)
    {
        if(preg_match('/^[^<>;=#{}]*$/ui', $name)){
            Output::cleanRed();
            return true;
        }
        else{//if address not valid
            Output::checkError($inputname, 'validateText');
            exit();
        }
    }
    
    //For cheking number of characters
    public static function numberOfCharacters($value, $min, $max,  $inputname)
    {
        if( $min <= strlen($value) AND strlen($value) <= $max ){
            Output::cleanRed();
            return true;
        }
        else{//if address not valid
            Output::checkError($inputname, 'validateShortInput');
            exit();
        }
    }
    
    //Checking for email
    public static function isEmail($email, $inputname)
    {
        if (preg_match('/^[a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+(?:[.]?[_a-z\p{L}0-9-])*\.[a-z\p{L}0-9]+$/ui', $email)){
            Output::cleanRed();
            return true;
        } else {
            echo Output::checkError($inputname, 'validateMail');
            exit();
        }
    }
    
    //Checking isMd5
    public static function isMd5($md5)
    {
        return preg_match('/^[a-f0-9A-F]{32}$/', $md5);
    }
    
    //Checking for date
    public static function isDate($date, $inputname)
    {
        if(preg_match('/^([0-9]{4}).((0?[0-9])|(1[0-2])).((0?[0-9])|([1-2][0-9])|(3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/', $date)){
            Output::cleanRed();
            return true;
        }
        else{
            Output::checkError($inputname, 'validateDate');
            exit();
        }
    }
    
    //Checking for link
    public static function isLink($gelen)
    {
        return preg_match('/^[_a-z0-9-]+$/ui', $gelen);
    }
    
    //Checking for address
    public static function isAddress($address, $inputname)
    {
        if(preg_match('/^[^<>;=#{}]*$/ui', $address)){
            Output::cleanRed();
            return true;
        }
        else{//if address not valid
            Output::checkError($inputname, 'validateText');
            exit();
        }
    }
    
    //Checking for product detail
    public static function isProductDetail($detail, $inputname)
    {
        if(Check::cleanHtmlCode($detail) AND Check::cleanScript($detail)){
            Output::cleanRed();
            return true;
        }
        else{//if address not valid
            Output::checkError($inputname, 'validateText');
            exit();
        }
    }
    
    //Checking for url is valid
    public static function isUrl($url, $inputname)
    {
        if (preg_match( '/^[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$url)) {
            Output::cleanRed();
            return true;
        }
        else{//if url not valid
            Output::checkError($inputname, 'validateUrl');
            exit();
        }
    }
    
    //Check IBAN thanks to ?????27
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
}





