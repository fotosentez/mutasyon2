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
    
}





