<?php

require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

$username = Get::post('username');
$password = Get::post('password');
$token = Get::post('token');

if(Validation::isMd5($token)){
    if($token == $makeToken){
        if($username){
            if(Validation::isEmail($username)){
                if($password){
                    if(Validation::isPasword($password)){
                        Validation::checkError('');
                        $checkUser = DB::isExist("superuser", "superuser_email = '" . $username . "' AND superuser_password = '" . md5 ( $password ) . "' AND superuser_active = 1");
                        if ($checkUser == 1) {
                            session_start ();
                            $_SESSION ["mutasyon_session"] = 4;
                            $_SESSION ["email"] = $username;
                            echo '<script type="text/javascript">window.location.href="index.php?url=index";</script>';
                        } else {
                            echo '<script type="text/javascript">window.location.href="index.php?url=login";</script>';
                        }
                    }
                    else{
                        echo Lang::getLang('validatePassword');
                        Validation::checkError('password');
                    }
                }
                else{
                    echo Lang::getLang('cantBlank');
                    Validation::checkError('password');
                }
            }
            else{
                echo Lang::getLang('notEmail');
                Validation::checkError('username');
            }
        }
        else{
            echo Lang::getLang('cantBlank');
            Validation::checkError('username');
        }
    }
}
makeToken();