<?php
/* Smarty version 3.1.30, created on 2017-01-24 21:56:44
  from "/var/www/html/mutasyon2/view/default/header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5887a36c9c6276_42967629',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cd6883acfd53a79a6824a58de2f02e9d709271c' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/header.html',
      1 => 1485284191,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:view/default/top/link.html' => 1,
    'file:view/default/top/leftMenu.html' => 1,
    'file:view/default/top/topNavigation.html' => 1,
    'file:view/default/top/pageContent.html' => 1,
  ),
),false)) {
function content_5887a36c9c6276_42967629 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>Gentallela Alela! | </title>
                    <?php $_smarty_tpl->_subTemplateRender("file:view/default/top/link.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                </head>
                <body class="nav-md">
                <div class="container body">
                    <div class="main_container">
                       
                                    <?php $_smarty_tpl->_subTemplateRender("file:view/default/top/leftMenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                                    
                                </div>
                            </div>
                            <?php $_smarty_tpl->_subTemplateRender("file:view/default/top/topNavigation.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                            <?php $_smarty_tpl->_subTemplateRender("file:view/default/top/pageContent.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                            
                           <?php }
}
