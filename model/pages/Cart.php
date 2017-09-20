<?php

Class Cart{
    
    function getRow($what = "", $key = ''){
        
        /*----------------GET CART---------------------------------------------------------
         * E.g. Cart::getRow('cart');
         */
        if($what == "cart"){
            
            return array_unique($_SESSION['cart']);//Remove dublice values
            
        }
        //----------------------------------------------------------------------------------
        
        
        
        /*----------------GET SALE CART-----------------------------------------------------
         * E.g. Cart::getRow('saleCart');
         */
        else if($what == 'saleCart'){
            $cart = array();
            foreach(self::getRow('cart') as $a){
                $a = explode('-', $a);
                if($a[2] == 'cart'){array_push($cart, $a[0].'-'.$a[1].'-'.$a[2].'-'.$a[3].'-'.$a[4]);}
            }
            return $cart;
        }
        //----------------------------------------------------------------------------------
        
        
        
        /*----------------GET BUY CART------------------------------------------------------
         * E.g. Cart::getRow('buyCart');
         */
        else if($what == 'buyCart'){
            $cart = array();
            foreach(self::getRow('cart') as $a){
                $a = explode('-', $a);
                if($a[2] == 'buyCart'){array_push($cart, $a[0].'-'.$a[1].'-'.$a[2]);}
            }
            return $cart;
        }
        //----------------------------------------------------------------------------------
        
        
        
        /*-----FIND PRODUCTS TOTAL IN CART--------------------------------------------------
         * Find products total in cart
         * E.g. Cart::getRow('amount', '1,products');
         */
        else if($what == "amount" AND $key){
            $countArray = array_count_values($_SESSION['cart']);
            foreach($countArray as $a => $k){
                if($key == $a){
                    return $k;
                }
            }
        }
        //-----------------------------------------------------------------------------------
        
        
        
        
        /*-------GET PRODUCT OR OPTIONS ID------------------------------------------------------------
         * E.g. Cart::getRow('id', '1-options-cart-15.50-1');
         */
        else if($what == "id" AND $key){
            $a = explode('-', $key);
            return $a[0];
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        
        /*-------GET PRODUCT OR OPTIONS PRICE---------------------------------------------------------
         * E.g. Cart::getRow('price', '1-options-cart-15.50-1');
         */
        else if($what == "price" AND $key){
            $a = explode('-', $key);
            return $a[3];
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        
        /*-------GET PRODUCT OR OPTIONS AMOUNT TYPE---------------------------------------------------
         * E.g. Cart::getRow('price', '1-options-cart-15.50-1');
         */
        else if($what == "amountType" AND $key){
            $a = explode('-', $key);
            return $a[4];
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        
        /*-----GET TYPE FOR INSERT INVOICE------------------------------------------------------------
         * E.g. Cart::getRow('what', '1-options-cart-15.50-1');
         */
        else if($what == "productType" AND $key){
            $a = explode('-', $key);
            return $a[1];
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        
        /*-----GET CART TYPE--------------------------------------------------------------------------
         * E.g. Cart::getRow('cartType', '1-options-cart-15.50-1');
         * For detect buy cart and cart
         */
        else if($what == "cartType" AND $key){
            $a = explode('-', $key);
            return $a[2];
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        
        /*-----COUNT CART-----------------------------------------------------------------------------
         * Find products total in cart
         * E.g. Cart::getRow('count', 'cart');
         */
        else if($what == "count"){
            
            $count = array();
            foreach(@$_SESSION['cart'] as $c){
                $a = explode('-', $c);
                array_push($count, $a[2]);
            }
            $cart = array_count_values($count);
            
            if($key == 'cart'){
                if(empty(self::getRow('saleCart'))){return 0;}
                else{return @$cart['cart'];}//For count sale cart
            }
            else if($key == 'buyCart'){
                if(empty(self::getRow('buyCart'))){return 0;}
                else{return @$cart['buyCart'];}//For count buy cart
            }
            else{
                return 0;
            }
        }
        //-------------------------------------------------------------------------------------------
        
        
        
        
        /*----FIND SALE PRICE OF OPTIONS--------------------------------------------------------------
         */
        else if($what == 'price' AND $key){
            $a = explode('-', $key);
            if($a[1] == 'options'){
                $getInfs = Dbase::getRows('pp_price, pp_profit, pp_profit_method', 'purchasedProducts', 'pp_products_options_id = '.$a[0]);
                
                foreach($getInfs as $g){
                    return Harizmi::getRow('total', array('profit' => $g['pp_profit'], 'price' => $g['pp_price'], 'method' => $g['pp_profit_method']));
                }
            }
            else{
                return Products::getRow('price', $a[0]);
            }
            
            
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        /*----GET NAME OF OPTIONS---------------------------------------------------------------------
         */
        else if($what == 'options_name' AND $key){
            $a = explode('-', $key);
            if($a[1] == 'options'){
                return Dbase::getRow('products_options INNER JOIN options ON po_options_id = options_id', 'po_id = '.$a[0], 'options_name');
            }
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        /*----REMOVE ITEMS FROM CART-------------------------------------------------------------------
         *E.g. Cart::getRow('empty', 'buyCart');
         */
        else if($what == 'empty' AND $key){
            
            foreach(Cart::getRow('cart') as $b => $k){
                $a = explode('-', $k);
                if($a[2] == $key){
                    $_SESSION['cart'] = array_diff($_SESSION['cart'], [$k]);
                }
            }
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        
        /*-----GET OTHER VALUES-----------------------------------------------------------------------
         */
        else{
            $a = explode('-', $key);
            
            if($a[1] == 'options'){
                $getProductsId = Dbase::getRow('products_options', 'po_id = '.$a[0], 'po_products_id');
                return Products::getRow($what, $getProductsId);
            }
            else if($a[1] == 'products'){
                return Products::getRow($what, $a[0]);
            } 
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    //Build page
    function build($page = ""){
        
        if($page == "buyCart"){
            Page::build("cart/buyCart", Lang::getLang("cart"));
        }
        else{
            Page::build("cart/cart", Lang::getLang("cart"));
        }
        
    }
    
}


?>
