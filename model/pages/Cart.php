<?php

Class Cart{
    
    function getRow($what = "", $key = ''){
        
        /*----------------GET CART---------------------------------------------------------
         * E.g. Cart::getRow('cart');
         */
        if($what == "cart"){
            
            $d = array_unique($_SESSION['cart']);//Remove dublice values
            return $d;
            
        }
        //----------------------------------------------------------------------------------
        
        
        
        
        /*-----FIND PRODUCTS TOTAL IN CART--------------------------------------------------
         * Find products total in cart
         * E.g. Cart::getRow('amount', '1,products');
         */
        else if($what == "amount"){
            $countArray = array_count_values($_SESSION['cart']);
            foreach($countArray as $a => $k){
                if($key == $a){
                    return $k;
                }
            }
        }
        //-----------------------------------------------------------------------------------
        
        
        
        
        /*-----COUNT CART--------------------------------------------------------------------
         * Find products total in cart
         * E.g. Cart::getRow('count', '1,products');
         */
        else if($what == "count"){
            return count($_SESSION['cart']);
        }
        //-----------------------------------------------------------------------------------
        
        
        else{return false;}
        
    }
    
    
    /*------------GET BUY CART----------------------------------------------------------------------------
     * E.g. Cart::buyCart('produts_name', '1,options');
     */
    function buyCart($what, $id){
        $a = explode(',', $id);
        
        
        
        /*-------GET PRODUCT OR OPTIONS ID------------------------------------------------------------
         * 
         */
        if($what == "id"){
            return $a[0];
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        
        /*-----GET TYPE FOR INSERT INVOICE------------------------------------------------------------
         * 
         */
        else if($what == "what"){
            return $a[1];
        }
        //--------------------------------------------------------------------------------------------
        
        
        
        /*-----GET OTHER VALUES-----------------------------------------------------------------------
         * 
         */
        else{
            if($a[1] == 'options'){
                $getProductsId = Dbase::getRow('products_options', 'po_id = '.$a[0], 'po_products_id');
                return Products::getRow($what, $getProductsId);
            }
            else if($a[1] == 'products'){
                return Products::getRow($what, $a[0]);
            } 
        }
        //--------------------------------------------------------------------------------------------
    }
    //----------------------------------------------------------------------------------------------------------
    
    
    
    
    function saleCart($what){
        
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