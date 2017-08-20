<?php
Class options{
    function getRow($what = "", $id = ""){
        
        if($what == "contents"){
            return Dbase::getRows('*', 'options INNER JOIN optionsGroup ON options_optionsGroup_id = og_id', 'og_id = '.$id.' AND  options_id is not null ');
        }
        else if($what == "group"){
            return Dbase::getRows('*', 'optionsGroup', 'og_id <> 0 ');
        }
        else{
            return Dbase::getRow('options INNER JOIN optionsGroup ON options_optionsGroup_id = og_id', 'options_id = '.$id.' ', $what);
        }
    }
}

?>