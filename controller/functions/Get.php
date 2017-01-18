<?php

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
    
    public static function autocomplete($table, $values)
    {
        global $db;
        $prep = array();
        foreach($values as $k ) {
            $prep[$k] = $v;
        }
        $sth = $db->prepare('SELECT * FROM '.$table.' WHERE LIKE '. implode('OR ',array_keys("%'.$values.'%")) .' ');
        $res = $sth->execute($prep);
        print_r($res);
    }
    
}

?>