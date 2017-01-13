<?php

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

?>