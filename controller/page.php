<?php
require_once(dirname(__FILE__).'/../model/settings/settings.php'); // Get All Functions

Class Page {
    
    /** CREATE PAGE eg: $page->create('home', 'index.css', 'new-page.js') ***/
    public static function create($pagePath, $pageTitle, $css = false, $js = false, $admin = true)
    {
        global $smarty;
        global $dbase;

        if ($css){$css = $css;} 
        if ($js){$js = $js;}            
        if ($pageTitle == ''){$pageTitle = "pageTitleBlank";}else{$pageTitle = $pageTitle;}
        
        $smarty->assign(array(
            'pagePath' => $pagePath,
            'pageTitle' => $pageTitle,
            'css' => $css,
            'js' => $js,
            ));
            
            
            if($admin == false){
                $adminId = $dbase->getAdminInf('superuser_id');
                $userStatus = $dbase->getRow('superuser', 'superuser_id = '.$adminId.' ', 'superuser_status');
                if($userStatus == 1){
                    $smarty->display(_THEME_BASE_DIR_.'header.html');
                    $smarty->display(_THEME_BASE_DIR_.$pagePath.'.html');
                    $smarty->display(_THEME_BASE_DIR_.'footer.html');
                }else{
                    $smarty->display(_THEME_BASE_DIR_.'header.html');
                    $smarty->display(_THEME_BASE_DIR_.'errors/500.html');
                    $smarty->display(_THEME_BASE_DIR_.'footer.html');
                }
                
            }else{
                $smarty->display(_THEME_BASE_DIR_.'header.html');
                $smarty->display(_THEME_BASE_DIR_.$pagePath.'.html');
                $smarty->display(_THEME_BASE_DIR_.'footer.html');
            }
            
    }
}