<?php
/* Smarty version 3.1.30, created on 2016-12-29 14:44:42
  from "/var/www/html/mutasyon2/view/login/login.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5864f72a0d3b53_53691750',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a9a8667cdf6c94aa2622b8a1d64fbdb0ea102bf' => 
    array (
      0 => '/var/www/html/mutasyon2/view/login/login.html',
      1 => 1482945167,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5864f72a0d3b53_53691750 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <title>Login To Mutasyon</title>
        <link rel="stylesheet" type="text/css" href="view/login/css/login.css">
            <?php echo '<script'; ?>
 src="view/login/js/jquery.min.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="view/login/js/script.js"><?php echo '</script'; ?>
>
        </head>
        <body>
        <form class='noload' action="controller/login/controlLogin.php" method="POST">
            <div class="loginform">
                <h4><?php echo Lang::getLang("signin");?>
</h4>
                <div>
                    <div class="relative">
                        <label><?php echo Lang::getLang("username");?>
</label><br />
                        <input type="text" class="input" name="username" />
                    </div>
                    <div class="relative">
                        <label><?php echo Lang::getLang("password");?>
</label><br />
                        <input type="password" class="input" name="password" />
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['makeToken']->value;?>
" name="token" />
                    </div>
                    <div class="buttondiv">
                        <button type="submit"><?php echo Lang::getLang("login");?>
</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="inf absolute displayNone"></div>
    </body>
</html>
<?php }
}
