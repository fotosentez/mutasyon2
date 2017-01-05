<?php
Class Validation {
    
    //For clear javascript codes
    public static function cleanScript($html)
    {
        $events = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange';
        $events .= '|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave|onerror|onselect|onreset|onabort|ondragdrop|onresize|onactivate|onafterprint|onmoveend';
        $events .= '|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onmove';
        $events .= '|onbounce|oncellchange|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondeactivate|ondrag|ondragend|ondragenter|onmousewheel';
        $events .= '|ondragleave|ondragover|ondragstart|ondrop|onerrorupdate|onfilterchange|onfinish|onfocusin|onfocusout|onhashchange|onhelp|oninput|onlosecapture|onmessage|onmouseup|onmovestart';
        $events .= '|onoffline|ononline|onpaste|onpropertychange|onreadystatechange|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onsearch|onselectionchange';
        
        
        return (!preg_match('/<[ \t\n]*script/ui', $html) && !preg_match('/<.*('.$events.')[ \t\n]*=/ui', $html) && !preg_match('/<[\s]*(form|input|embed|object)/ims', $html)  && !preg_match('/.*script\:/ui', $html));
    }
    
    public static function cleanUniCode($pattern)
    {
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }
    
    //For checking post numeric or not
    public static function isNumeric($value)
    {
        return preg_match('/^[+0-9. ()\/-]*$/', $value);
    }
    
    //For clear all tag of html
    public static function clearCode($pattern)
    {
        if (!defined('PREG_BAD_UTF8_OFFSET')) {
            return $pattern;
        }
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }
    
    //For checking post is a name or not. This can't include numeric
    public static function isName($name)
    {
        return preg_match(Validation::cleanUniCode('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/u'), stripslashes($name));
    }
    
    //For cheking product name. This can inlude numeric
    public static function isProductName($name)
    {
        return preg_match(Validation::cleanUniCode('/^[^<>;=#{}]*$/u'), $name);
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
    public static function clearTag($yazilan)
    {
        return preg_replace("/[^\p{L}\p{N}.:+,-?=<> ]/u", ' ', $yazilan);
    }
    
    
    //Checking for link
    public static function isLink($gelen)
    {
        return preg_match('/^[_a-z0-9-]+$/ui', $gelen);
    }
    
    //Checking password strong
    public static function isPasword($passwd)
    {
        return preg_match("#.*^(?=.{5,20})(?=.*[a-z])(?=.*[0-9]).*$#", $passwd);
    }
    
    public static function cleanHtmlCode($post)
    {
        return strip_tags($post);
    }
    
    //Checking for email
    public static function isEmail($email)
    {
        return preg_match('/^[a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+(?:[.]?[_a-z\p{L}0-9-])*\.[a-z\p{L}0-9]+$/ui', $email);
    }
    
    //Checking isMd5
    public static function isMd5($md5)
    {
        return preg_match('/^[a-f0-9A-F]{32}$/', $md5);
    }
    
    //Checking for date
    public static function isDate($date)
    {
        return (bool)preg_match('/^([0-9]{4})-((0?[0-9])|(1[0-2]))-((0?[0-9])|([1-2][0-9])|(3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/', $date);
    }
}

Class Get
{
    public static function post($key, $default_value = false)
    {
        if (!isset($key) || empty($key) || !is_string($key))
            return false;
        $ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default_value));
        
        if (is_string($ret) === true)
            $ret = urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret)));
        return !is_string($ret)? $ret : stripslashes($ret);
    }
    
}

Class AddHtml
{
    //Add pagination with letter to template docs
    public static function addPaginationWithLetter($foreach, $pageName, $page){
        echo '
        <div class="clear">
        <ul class="pagination pagination-split">';
        if ( Get::post($page) == "" ){
            echo '<li class="active" ><a href="?url='.$pageName.'">'.Lang::getLang("all").'</a></li> ';
        }
        else{
            echo '<li><a href="?url='.$pageName.'">'.Lang::getLang("all").'</a></li>';
        }
        
        foreach ( $foreach as $f ){
            if( Get::post($page) == $f["lastname"] ){
                echo '<li class = "active"><a href="?url='.$pageName.'&'.$page.'='.$f["lastname"].'">'.$f["lastname"].'</a></li> ';
            }
            else{
                echo '<li><a href="?url='.$pageName.'&'.$page.'='.$f["lastname"].'">'.$f["lastname"].'</a></li> ';
            }
        }
        echo ' </ul></div>';
    }
    
    //Add pagination to template docs
    public static function addPagination($totalPage, $pageName){        
        echo '
        <div class="clear"></div>
        <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
        
        <li class="paginate_button previous ';
        
        if(Get::post("page") < 2)
        {
            echo 'disabled';
        }
        echo '" id="datatable_previous">
        <a href="';
        if(Get::post("page") > 1)
        {
            echo '?url='.$pageName;
            $pre = Get::post("page")-1;
            echo '&page='.$pre;
        }
        
        echo '" aria-controls="datatable" data-dt-idx="0" tabindex="0">'.Lang::getLang("previous").'</a></li>';
        
        for($i = 1;$i <= $totalPage;$i++)
        {
            echo '<li class="paginate_button ';
            if(Get::post("page") == $i)
            {
                echo 'active';
            }
            echo '">
            <a href="?url='.$pageName.'&page='.$i.'" aria-controls="datatable" data-dt-idx="1" tabindex="0">'.$i.'</a></li>';
        }
        echo '<li class="paginate_button previous ';
        
        if(Get::post("page") == $totalPage)
        {
            echo 'disabled';
        }
        echo '" id="datatable_previous">
        <a href="';
        if(Get::post("page") != $totalPage)
        {
            echo '?url='.$pageName;
            $nxt = Get::post("page")+1;
            echo '&page='.$nxt;
        }
        
        echo '" aria-controls="datatable" data-dt-idx="0" tabindex="0">'.Lang::getLang("next").'</a></li></ul></div>';
    }
    
}

Class Output
{
    //Add red background to input which gived error
    public static function checkError($name, $output)
    {
        echo "<script>$('input').removeClass('alert-danger');$('select').removeClass('alert-danger');$('input[name=".$name."]').addClass('alert-danger');$('textarea[name=".$name."]').addClass('alert-danger');</script>".Lang::getLang($output);
    }
    
    //Clean all inputs and textarea's values
    public static function cleanInputs()
    {
        echo "<script>$('input').val('');$('textarea').val('');</script>";
    }
    
    //Clean red from all inputs and textarea
    public static function cleanRed()
    {
        echo "<script>$('input').removeClass('alert-danger');$('textarea').removeClass('alert-danger');</script>";
    }
    
}

Class Math
{
    //Find tax
    public static function findTax($tax, $price)
    {
        $one = 1;
        $getTax = round($price/(($one.$tax)/100), 2);
        return $getTax;
    }
    
    
}