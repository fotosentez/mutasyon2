<?php

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

?>