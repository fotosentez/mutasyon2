<?php

Class AddHtml
{
    //Add pagination with letter to template docs
    public static function addPaginationWithLetter($foreach, $urlName, $page){
        echo '
        <div class="clear">
        <ul class="pagination pagination-split">';
        if ( Get::post($page) == "" ){
            echo '<li class="active" ><a href="?url='.$urlName.'">'.Lang::getLang("all").'</a></li> ';
        }
        else{
            echo '<li><a href="?url='.$urlName.'">'.Lang::getLang("all").'</a></li>';
        }
        
        foreach ( $foreach as $f ){
            if( Get::post($page) == $f["lastname"] ){
                echo '<li class = "active"><a href="?url='.$urlName.'&'.$page.'='.$f["lastname"].'">'.$f["lastname"].'</a></li> ';
            }
            else{
                echo '<li><a href="?url='.$urlName.'&'.$page.'='.$f["lastname"].'">'.$f["lastname"].'</a></li> ';
            }
        }
        echo ' </ul></div>';
    }
    
    //Add pagination to template docs
    public static function addPagination($totalPage, $urlName, $mobile=""){        
        
        if(Get::post("page") <= 5){
            $pageLeft = 1;
        }
        else{
            $pageLeft = Get::post("page") - 5;
        }
        if(Get::post("page") >= $totalPage - 5){
            $pageRight = $totalPage;
        }
        else{
            $pageRight = Get::post("page") + 5;
        }
        
        echo '
        <div class="clear"></div>
        <div class="btn-group">
        <ul class="pagination">';
        
        if(Get::post("page") > 1){
            echo '<li class="paginate_button"><a href="?url='.$urlName.'&page=1">'.Lang::getLang("firstPage").'</a></li>';
        }
        
        echo '<li class="paginate_button previous ';
        
        if(Get::post("page") < 2)
        {
            echo 'disabled';
        }
        echo '" id="datatable_previous"><a href="';
        
        if(Get::post("page") > 1)
        {
            echo '?url='.$urlName;
            $pre = Get::post("page")-1;
            echo '&page='.$pre;
        }
        
        echo '" aria-controls="datatable" data-dt-idx="0" tabindex="0">'.Lang::getLang("previous").'</a></li>';
        
        if($mobile == ""){
            for($i = $pageLeft;$i <= $pageRight;$i++)
            {
                echo '<li class="paginate_button ';
                if(Get::post("page") == $i)
                {
                    echo 'active';
                }
                echo '">
                <a href="?url='.$urlName.'&page='.$i.'" aria-controls="datatable" data-dt-idx="1" tabindex="0">'.$i.'</a>';
            }
        }
        else{
            echo '<li class="paginate_button"><a>'.Get::post("page").'/'.$totalPage.'</a></li>';
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
            echo '?url='.$urlName;
            $nxt = Get::post("page")+1;
            echo '&page='.$nxt;
        }
        
        echo '" aria-controls="datatable" data-dt-idx="0" tabindex="0">'.Lang::getLang("next").'</a></li></li>';
        if(Get::post("page") < $totalPage - 5){
            echo '<li class="paginate_button"><a href="?url='.$urlName.'&page='.$totalPage.'">'.Lang::getLang("lastPage").'</a></li></ul></div>';
        }
        else{
            echo '</ul></div>';
        }
    }
    
    //Add pagination to php for that template docs. You must pagination add php before add template docs
    public static function addPaginationPhp($id, $table, $perPage, $urlName)
    {
        global $db;
        global $smarty;
        $page = Get::post("page");
        
        $prtotal = $db->query("SELECT COUNT($id) AS prtotal FROM $table ");
        foreach($prtotal as $prt)
        {
            $totalEntry = $prt["prtotal"];
        }
        //Total page 
        $totalPage = ceil($totalEntry/$perPage);
        if($page)
        {
            $start = ($page-1)*$perPage;
        }
        else
        {
            $start = 0;
        }
        
        //Smarty veriables
        $smarty->assign ( array (
            "totalPage"        => $totalPage,
            ) );
        
        return array(
            "start" 	       => $start,
            "totalPage"        => $totalPage,
            "totalEntry"       => $totalEntry,
            "perPage" 	       => $perPage,
            );
    }
    
}

?>