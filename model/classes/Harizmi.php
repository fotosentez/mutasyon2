<?php

Class Harizmi
{
   function getRow($what, $value = ""){
        if($what){
            $price = @$value['price'];
            $profit = @$value['profit'];
            $discount = @$value['discount'];
            $method = @$value['method'];
                        
            
            /*------------------------------------------------------------------------
	     * Calculate profit amount
	     * E.g. Harizmi::getRow('profit', array('profit' => 10, 'price' => 50, 'method' => 'percent'));
	     */
            if($what == "profit"){
                if($profit and $price and $method){
                    if($method == "percent"){
                        return sprintf("%0.2f", ($price*$profit/100));
                    }
                    else if($method == "amount"){
                        return sprintf("%0.2f", $profit);
                    }
                }
            }
            //---------------------------------------------------------------------------
            
            
            /*-----------------CALCULATE DISCOUNT--------------------------------
	     * E.g. Harizmi::getRow('discount', array('discount' => 10, 'price' => 50, 'method' => 'percent'));
	     */
            else if($what == "discount"){
                if($discount and $price and $method){
                    if($method == "percent"){
                        return sprintf("%0.2f", ($price*$discount/100));
                    }
                    else if($method == "amount"){
                        return sprintf("%0.2f", $discount);
                    }
                }
            }
            //---------------------------------------------------------------------------
            
            
            /* --------------------------------------------------------------------------
	     * Calculate price included profit
	     * E.g. Harizmi::getRow('inclProfit', array('profit' => 10, 'price' => 50, 'method' => 'percent'));
	     */
            else if($what == "inclProfit"){
                if($profit and $price and $method){
                    if($method == "percent"){
                        return sprintf("%0.2f", ($price*$profit/100 + $price));
                    }
                    else if($method == "amount"){
                        return sprintf("%0.2f", ($profit + $price));
                    }
                }
            }
            //-----------------------------------------------------------------------------
            
            
            /*-----------------------------------------------------------------------------
	     * Calculate total price (price + profit)
	     * E.g. Harizmi::getRow('total', array('profit' => 10, 'price' => 50, 'tax' => 10, 'method' => 'percent'));
	     */
            else if($what == "total"){
                if($method == "percent"){
                        return sprintf("%0.2f", ($price*$profit/100 + $price));
                    }
                    else if($method == "amount"){
                        return sprintf("%0.2f", ($price + $profit));
                    }
            }
            //-------------------------------------------------------------------------------
        }
    }
    
}

/*
 W *ho is Muhammad ibn Musa al-Khwarizmi?
 Visit this link please :https://en.wikipedia.org/wiki/Muhammad_ibn_Musa_al-Khwarizmi
 */
?>