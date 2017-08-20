<?php
Class Products{
    
    /*
     *      
     */
    
    function getRow($what, $gid = ""){
        
        //Check gid
        if($gid){$id = $gid;}else{$id = Get::getValue('id');}
        
        
        /*--------------------------COVER-------------------------------------------
         * Get product cover image
         * E.g. Products::getRow(('cover', 10))
         */
        if($what == "cover"){
            $cover = Dbase::getRow('products_images', 'products_images_product = '.$id.' AND products_images_cover = 1 ', 'products_images_id');
            
            $coverImage = 'view/img/products/'.$id.'/big/'.$cover.'.jpg';
            
            if (file_exists($coverImage)) {
                return $coverImage;
            } 
            else {
                return 'view/img/noimage-large.jpg';
            }
        }
        //-----------------------------------------------------------------------------
        
        
        
        /*-------------------------GET ALL IMAGES--------------------------------------------
         * Get all images of product
         * E.g. Products::getRow(('images', 10))
         */
        else if($what == "images"){
            $getTable = Dbase::getRows('*', 'products_images', 'products_images_product = '.$id.'');
        }
        //-----------------------------------------------------------------------------
        
        
        /*------------------------CALC TOTAL----------------------------------------
         * For get products price (include profit)
         * E.g. Products::getRow(('price', 10))
         */
        else if($what == "salePrice"){
            
            $price = Dbase::getRows('*', 'productsView', 'products_id = '.$id);
            
            foreach($price as $p){
                $profit = $p['pp_profit'];
                $prc = $p['price'];
                $method = $p['pp_profit_method'];
                
                return Harizmi::getRow('total', array('profit' => $profit, 'price' => $prc, 'method' => $method));
            }
            
        }
        //------------------------------------------------------------------------------
        
        
        
        /*-------------------------GET PROFIT-----------------------------------------
         * For get products profit
         * E.g. Products::getRow(('profit', 10))
         */
        else if($what == "profit"){
            
            $price = Dbase::getRows('pp_price, pp_profit_method, pp_profit', 'purchasedProducts INNER JOIN tax ON tax_id = pp_tax', 'pp_products_id = '.$id.' ORDER BY pp_id DESC LIMIT 1');
            
            if($price){
                foreach($price as $p){
                    $profit = $p['pp_profit'];
                    $prc = $p['pp_price'];
                    $method = $p['pp_profit_method'];
                    
                    return Harizmi::getRow('profit', array('profit' => $profit, 'price' => $prc, 'method' => $method));
                }
            }
            else{echo Lang::getLang('connectionErrorInvoice');}
        }
        //------------------------------------------------------------------------------
        
        
        
        /* ------------------------LIST PRICE OF PRODUCT--------------------------------
         * For get all prices
         * E.g. Products::getRow(('prices', 10))
         */ 
        else if($what == "prices"){
            $getTable = Dbase::getRows('pp_price', 'purchasedProducts', 'pp_products_id = '.$id);
        }
        //---------------------------------------------------------------------------------
        
        
        
        /*-----------------------------GET COLORS OF PRODUCT-------------------------------
         * For get products colors
         * E.g. Products::getRow(('color', 10))
         */
        else if($what == "color"){
            $getTable = Dbase::getRows('*', 'products_options INNER JOIN colors ON po_colors_id = colors_id', 'po_products_id = '.$id.' GROUP BY colors_id ');
        }
        //------------------------------------------------------------------------
        
        
        
        /*----------------------OPTIONS------------------------------------
         * Get all options of that product
         * E.g. Products::getRow(('options', 10))
         */
        else if($what == "optionsGroup"){
            $getTable = Dbase::getRows('*', 'optionsView', 'po_products_id = '.$id.' GROUP BY og_name');
        }
        else if($what == "optionsContents"){
            $getTable = Dbase::getRows('*', 'optionsView', 'po_products_id = '.$id.' GROUP BY options_name ORDER BY options_name ');
        }
        //----------------------------------------------------------------------------
        
        
        
        /*------------------------COUNT PRODUCTS------------------------------------
         * Get count all products (this include all products but not list deactive products)
         * E.g. Products::getRow(('count', 10))
         */
        else if($what == "count"){
            $getTable = Dbase::getCount('products', 'products_status = 1', 'products_id');
        }
        //--------------------------------------------------------------------------
        
        
        
        /*---------------------GET CATEGORIES---------------------------------------
         * Get categories for that product
         * E.g. Products::getRow(('category', 10))
         */
        else if($what == "category"){
            $getTable = Dbase::getRow('products INNER JOIN subcategory ON subcategory_id = products_category', 'products_id = '.$id.' ', 'subcategory_name');
        }
        //--------------------------------------------------------------------------
        
        
        
        /*----------------------OTHER------------------------------------------------
         * Get table of product like products_id, products_name...
         * E.g. Products::getRow(('products_name', 10))
         */
        else{
            $getTable = Dbase::getRow('productsView', 'products_id = '.$id, $what);
        }
        //--------------------------------------------------------------------------
        
        
        
        return $getTable;
        
    }
    
    
    
    function options($what, $gid = "", $group = ""){
        if($gid){$id = $gid;}else{$id = Get::getValue('id');}//Check gid
        if($group){$g = "AND og_id = ".$group." GROUP BY po_options_id";}else{$g = "";}
        
        if($what == 'all'){
            return Dbase::getRows('*', 'optionsView', 'po_products_id = '.$id.' GROUP BY po_id');
        }
        else if($what == 'colors'){
            return Dbase::getRows('*', 'optionsView', 'po_products_id = '.$id.' AND po_colors_id IS NOT NULL GROUP BY po_colors_id');
        }
        else if($what == 'optionsGroup'){
            return Dbase::getRows('*', 'optionsView', 'po_products_id = '.$id.' AND po_options_id IS NOT NULL GROUP BY og_id');
        }
        else if($what == 'optionsContents'){
            return Dbase::getRows('*', 'optionsView', 'po_products_id = '.$id.' AND po_options_id IS NOT NULL '.$g.' ');
        }
        else{
            return Dbase::getRow('optionsView', 'po_products_id = '.$id.' GROUP BY po_id', $what);
        }
    }
    
    
    
    function getAll(){
        //Products status
        $order = @$_SESSION['products']['order'];
        $category = @$_SESSION['products']['category'];
        
        //----CHECK ORDER---------------------------------------------
        if($order == "nameASC"){$ord = "GROUP BY products_id ORDER BY products_name ASC";}
        else if($order == "nameDESC"){$ord = "GROUP BY products_id ORDER BY products_name DESC";}
        else if($order == "orderASC"){$ord = "GROUP BY products_id ORDER BY porder ASC";}
        else if($order == "orderDESC"){$ord = "GROUP BY products_id ORDER BY porder DESC";}
        else if($order == "dateASC"){$ord = "GROUP BY products_id ORDER BY bi_date ASC";}
        else if($order == "dateDESC"){$ord = "GROUP BY products_id ORDER BY bi_date DESC";}
        else if($order == "stockNONE"){$ord = "AND 'amount' = '' GROUP BY products_id";}
        else if($order == "stockALL"){$ord = "AND 'amount' > 0 GROUP BY products_id";}
        else if($order == "priceASC"){$ord = "GROUP BY products_id ORDER BY price ASC";}
        else if($order == "priceDESC"){$ord = "GROUP BY products_id ORDER BY price DESC";}
        
        if($category != "all"){$cat = "AND subcategory_id = ".$category;}else{$cat = "";}
        
        return Dbase::getRows('*', 'productsView', 'products_id <> 0 '.$cat.' '.$ord.' ');
    }
    
    
    
    //Build page
    function build($page = "list"){
        
        if($page == "detail"){
            Page::build("products/productDetail", self::getRow("products_name"));
        }
        else if($page == "list"){
            Page::build("products/products", Lang::getLang("products"));
        }
        
    }
}


?>