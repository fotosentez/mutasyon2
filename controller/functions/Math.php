<?php

Class Math
{
    //Find total price its included tax and profit
    public static function findTotalPrice($purchasePrice, $tax, $profit, $method="")
    {
        $one = 1;
        if($method == "percent"){
            $total = ($purchasePrice*($tax/100 + 1))*(($profit/100 + 1));
            return round($total, 2);
        }
        else if($method == "amount"){
            $total = ($purchasePrice*(1 + $tax/100))+$profit;
            return $total;
        }
        else{
            echo "0.00";
        }
    }
    
}

?>