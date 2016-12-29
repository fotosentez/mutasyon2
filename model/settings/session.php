<?php

/*** CREATE TOKEN **/
	session_start();
	function makeToken(){
        $makeToken = md5(uniqid(rand(), true));
        $_SESSION['makeToken'] = $makeToken;
        return $makeToken;
    }
	if (!@$_SESSION['makeToken'])
	{
		$makeToken = makeToken();
	}
	else
		$makeToken = $_SESSION['makeToken'];
	
	$smarty->assign(array(
		'makeToken' => $_SESSION['makeToken'],
	));