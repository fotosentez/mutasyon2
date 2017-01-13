<?php

require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

$username = Get::post('username');
$password = Get::post('password');
$token = Get::post('token');

if(Check::isMd5($token)){
    if($token == $makeToken){
        if($username){
            if(Check::isEmail($username)){
                if($password){
                    if(Check::isPasword($password, 'password')){
                        $checkUser = DB::isExist("superuser", "superuser_email = '" . $username . "' AND superuser_password = '" . md5 ( $password ) . "' AND superuser_active = 1");
                        if ($checkUser == 1) {
                            $_SESSION ["mutasyon_session"] = 4;
                            $_SESSION ["email"] = $username;
                            echo '<script type="text/javascript">window.location.href="index.php?url=index";</script>'.Lang::getLang('doLogin');
                        } else {
                            echo '<script type="text/javascript">window.location.href="index.php?url=login";</script>'.Lang::getLang('cantLogin');
                        }
                    }
                    
                }
                else{
                    Output::checkError('password', 'cantBlank');
                }
            }
            else{
                Output::checkError('username', 'validateMail');
            }
        }
        else{
            Output::checkError('username', 'cantBlank');
        }
    }
    else{
        Lang::getLang('tokenError');
    }
}
$newToken = makeToken();
echo "<script type='text/javascript'>$('#token').val('$newToken');</script>";