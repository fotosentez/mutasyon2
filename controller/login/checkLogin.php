<?php
require_once(dirname(__FILE__).'/../include.php');
require_once(dirname(__FILE__).'/../../model/settings/include.php');


$email = Get::getValue("email");
$password = Get::getValue("password");
$loginkey = Get::getValue("loginKey");

if($loginkey == @$_SESSION["loginKey"]){
    if(Check::control('mail', $email, "email", true)){
        if(Check::control('password', $password, "password")){
            $check = Dbase::isExist('superuser', 'superuser_email = "'.$email.'" AND superuser_password = "'.md5($password).'" ');
            if($check == 1){
                
                //Session for login
                Session::build("mutasyon_login", Dbase::getRow('superuser', 'superuser_email = "'.$email.'" AND superuser_password = "'.md5($password).'" ', 'superuser_id'));
                
                //Session for buycart
                Session::build("buyCart", Array());
                
                //Session for cart
                Session::build("cart", Array());
                
                //Session for cart
                Session::build("checkPassword", 3);
                
                //Session for products list
                Session::build("products", Array(
		    'order' => 'nameASC',
		    'category' => 'all',
		    'view' => 'grid',
		    ));
                
                echo Lang::getLang("doLogin").'<script type="text/javascript">window.location.href="index.php?u=index";</script>';
            }
            else{
                $newKey = Key::loginKey();
                echo Lang::getLang('cantLogin')."<script type='text/javascript'>$('.loginKey').val('".$newKey."');</script>";
            }
        }
    }
}
else{
    $newKey = Key::loginKey();
    echo Lang::getLang('keyError')."<script type='text/javascript'>$('.loginKey').val('".$newKey."');</script>";
}
?>