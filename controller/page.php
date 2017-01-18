<?php
Class Page {
    
    /** CREATE PAGE eg: $page->create('home', 'index.css', 'new-page.js') ***/
    public static function create($pagePath, $pageTitle, $css = false, $js = false)
    {
        global $smarty;
        if ($css)
            $css = $css;
        if ($js)
            $js = $js;
        if ($pageTitle == ''){
            $pageTitle = "pageTitleBlank";
        }
        else{
            $pageTitle = $pageTitle;
        }
        
        $smarty->assign(array(
            'pagePath' => $pagePath,
            'pageTitle' => $pageTitle,
            'css' => $css,
            'js' => $js,
            ));
            $smarty->display(_THEME_BASE_DIR_.'header.html');
            $smarty->display(_THEME_BASE_DIR_.$pagePath.'.html');
            $smarty->display(_THEME_BASE_DIR_.'footer.html');
    }
}