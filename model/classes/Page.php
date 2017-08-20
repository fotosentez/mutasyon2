<?php
require_once(_BASEDIR_.'model/settings/templatePath.php');


Class Page {
    
    
    public function build($path, $title = "", $level = 1)
    {
        
        
        $smarty = new Smarty();
        $smarty->assign(array(
            'pagePath' => $path,
            'pageTitle' => $title,
            ));
            
            if($level == 1){
                $smarty->display(_THEME_BASE_DIR_.'header.html');
                $smarty->display(_THEME_BASE_DIR_.$path.'.html');
                $smarty->display(_THEME_BASE_DIR_.'footer.html');
            }
            else{
                $userStatus = Superuser::getRow("status");
                if($userStatus == "superuser"){
                    $smarty->display(_THEME_BASE_DIR_.'header.html');
                    $smarty->display(_THEME_BASE_DIR_.$path.'.html');
                    $smarty->display(_THEME_BASE_DIR_.'footer.html');
                }else{
                    $smarty->display(_THEME_BASE_DIR_.'header.html');
                    $smarty->display(_THEME_BASE_DIR_.'errors/500.html');
                    $smarty->display(_THEME_BASE_DIR_.'footer.html');
                }
            }
            
    }
}