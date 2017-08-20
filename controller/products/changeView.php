<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions


/*----------FOR USE-----------------------------------------------------
 * Send $value via post. IF $value is 
 * name products order by name
 * order products order by order amount
 * date products order by date
 * stock products order by stock amount (None or all)
 * price products order by price
 * view product listing like list or grid.
 * ---------------------------------------------------------------------
 */

//Get value
$value = Get::getValue('value');

if($value == 'name'){$asc = 'nameASC';$desc = 'nameDESC';}
if($value == 'order'){$asc = 'orderASC';$desc = 'orderDESC';}
if($value == 'date'){$asc = 'dateASC';$desc = 'dateDESC';}
if($value == 'stock'){$asc = 'stockNONE';$desc = 'stockALL';}
if($value == 'price'){$asc = 'priceASC';$desc = 'priceDESC';}
if($value == 'view'){$asc = 'list';$desc = 'grid';}


/*------------------CHANGE VIEW GRID OR LIST------------------------
 * 
 */
if($value == 'view'){
    if(@$_SESSION['products']['view']){
        if(@$_SESSION['products']['view'] == $asc){
            @$_SESSION['products']['view'] = $desc;
        }
        else if(@$_SESSION['products']['view'] == $desc){
            @$_SESSION['products']['view'] = $asc;
        }
        else{
            @$_SESSION['products']['view'] = $asc;
        }
    }
    else{
        Session::products('view', 'grid');
    }
}
//--------------------------------------------------------------------



/*---------------CHANGE ORDER BY PRICE OR AMOUNT ...etc---------------
 * 
 */
else if($value == 'name' OR $value == 'order' OR $value == 'date' OR $value == 'stock' OR $value == 'price'){
    if(@$_SESSION['products']['order']){
        if(@$_SESSION['products']['order'] == $asc){
            @$_SESSION['products']['order'] = $desc;
        }
        else if(@$_SESSION['products']['order'] == $desc){
            @$_SESSION['products']['order'] = $asc;
        }
        else{
            @$_SESSION['products']['order'] = $asc;
        }
    }
    else{
        Session::products('order', 'nameASC');
    }
}
//--------------------------------------------------------------------



/*----------------CAHANGE CATEGORY------------------------------------
*/
else if($value == 'all' OR Check::control('numeric', $value, '')){
    @$_SESSION['products']['category'] = $value;
}
//--------------------------------------------------------------------

else{return false;}

echo '<script type="text/javascript">setTimeout(function(){location.reload();}, 1000); </script>'.Lang::getLang("changedView");

?>