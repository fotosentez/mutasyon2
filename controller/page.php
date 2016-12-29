<?php
	Class Page {
		
		/** CREATE PAGE eg: $page->create('home', 'index.css', 'new-page.js') ***/
		public static function create($pageName, $pageDesc = false, $css = false, $js = false)
		{
		   global $smarty;
		   if ($css)
			   $css = $css;
		   if ($js)
			   $js = $js;

		   $smarty->assign(array(
				'pageName' => $pageName,
				'pageDesc' => $pageDesc,
				'css' => $css,
				'js' => $js,
			));
			$smarty->display(_THEME_BASE_DIR_.'header.html');
			$smarty->display(_THEME_BASE_DIR_.$pageName.'.html');
			$smarty->display(_THEME_BASE_DIR_.'footer.html');
		}
	}