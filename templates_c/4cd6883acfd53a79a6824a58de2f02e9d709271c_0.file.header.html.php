<?php
/* Smarty version 3.1.30, created on 2017-01-16 19:32:25
  from "/var/www/html/mutasyon2/view/default/header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587cf599275f44_79754355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cd6883acfd53a79a6824a58de2f02e9d709271c' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/header.html',
      1 => 1484584259,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587cf599275f44_79754355 (Smarty_Internal_Template $_smarty_tpl) {
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
                    
                    <!-- Bootstrap core CSS -->
                    
                    <link href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
css/bootstrap.min.css" rel="stylesheet">
                        
                        <link href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
fonts/css/font-awesome.min.css" rel="stylesheet">
                            <link href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
css/animate.min.css" rel="stylesheet">
                                
                                <!-- Custom styling plus plugins -->
                                <link href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
css/custom.css" rel="stylesheet">
                                    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
css/maps/jquery-jvectormap-2.0.3.css" />
                                    <link href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
css/icheck/flat/green.css" rel="stylesheet" />
                                    <link href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
css/floatexamples.css" rel="stylesheet" type="text/css" />
                                    <?php if ($_smarty_tpl->tpl_vars['pagePath']->value == 'invoice/addInvoice') {?>
                                    <link href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
css/jquery-ui.css" rel="stylesheet" type="text/css" />
                                    <?php }?>
                                    
                                    <?php if ($_smarty_tpl->tpl_vars['css']->value) {?>
                                    <link href="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
css/<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
.css" rel="stylesheet" type="text/css" />
                                    <?php }?>
                                    
                                    <!--[if lt IE 9]>
                                    <?php echo '<script'; ?>
 src="../assets/js/ie8-responsive-file-warning.js"><?php echo '</script'; ?>
>
                                    <![endif]-->
                                    
                                    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                                    <!--[if lt IE 9]>
                                    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
                                    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
                                    <![endif]-->
                                    
                                </head>
                                <body class="nav-md">
                                <div class="container body">
                                    <div class="main_container">
                                        <!-- Left Menu -->
                                        <div class="col-md-3 left_col">
                                            <div class="left_col scroll-view">
                                                <div class="navbar nav_title" style="border: 0;">
                                                    <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $_smarty_tpl->tpl_vars['siteName']->value;?>
</span></a>
                                                </div>
                                                <div class="clearfix"></div>
                                                
                                                <!-- menu prile quick info -->
                                                <div class="profile">
                                                    <div class="profile_pic">
                                                        <img src="view/img/1.jpg" alt="..." class="img-circle profile_img">
                                                        </div>
                                                        <div class="profile_info">
                                                            <span>Welcome,</span>
                                                            <h2>John Doe</h2>
                                                        </div>
                                                    </div>
                                                    <!-- /menu prile quick info -->
                                                    
                                                    <br />
                                                    
                                                    <!-- sidebar menu -->
                                                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                                                        
                                                        <div class="menu_section">
                                                            <h3>General</h3>
                                                            <ul class="nav side-menu">
                                                                <!--Home -->
                                                                <li>
                                                                    <a href="?url=index">
                                                                        <i class="fa fa-home"></i> <?php echo Lang::getLang('mainPage');?>

                                                                    </a>
                                                                </li>
                                                                <!--Invoices -->
                                                                <li>
                                                                    <a>
                                                                        <i class="fa fa-file-text-o"></i> <?php echo Lang::getLang('invoices');?>
 
                                                                        <span class="fa fa-chevron-down"></span>
                                                                    </a>
                                                                    <ul class="nav child_menu" style="display: none">
                                                                        <li>
                                                                            <a href="?url=invoices"><?php echo Lang::getLang('invoiceList');?>
</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="?url=invoices/add"><?php echo Lang::getLang('addInvoice');?>
</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                
                                                                <!--Customers -->
                                                                <li>
                                                                    <a>
                                                                        <i class="fa fa-users"></i> <?php echo Lang::getLang('current');?>
 
                                                                        <span class="fa fa-chevron-down"></span>
                                                                    </a>
                                                                    <ul class="nav child_menu" style="display: none">
                                                                        <li>
                                                                            <a href="?url=customers"><?php echo Lang::getLang('customers');?>
</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="?url=customers/add"><?php echo Lang::getLang('addCustomer');?>
</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                
                                                                <!--Products -->
                                                                <li>
                                                                    <a>
                                                                        <i class="fa fa-users"></i> <?php echo Lang::getLang('products');?>
 
                                                                        <span class="fa fa-chevron-down"></span>
                                                                    </a>
                                                                    <ul class="nav child_menu" style="display: none">
                                                                        <li>
                                                                            <a href="?url=products"><?php echo Lang::getLang('productsList');?>
</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="?url=products/add"><?php echo Lang::getLang('addProducts');?>
</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- /sidebar menu -->
                                                    
                                                    <!-- /menu footer buttons -->
                                                    <div class="sidebar-footer hidden-small">
                                                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                                                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                        </a>
                                                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                                                        </a>
                                                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                                                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                                        </a>
                                                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                                                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                                                        </a>
                                                    </div>
                                                    <!-- /menu footer buttons -->
                                                </div>
                                            </div>
                                            
                                            <!-- top navigation -->
                                            <div class="top_nav">
                                                
                                                <div class="nav_menu">
                                                    <nav class="" role="navigation">
                                                        <div class="nav toggle">
                                                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                                                        </div>
                                                        
                                                        <ul class="nav navbar-nav navbar-right">
                                                            <li class="">
                                                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                    <img src="view/img/1.jpg" alt="">John Doe
                                                                        <span class=" fa fa-angle-down"></span>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                                                        <li><a href="javascript:;">  Profile</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:;">
                                                                                <span class="badge bg-red pull-right">50%</span>
                                                                                <span>Settings</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:;">Help</a>
                                                                        </li>
                                                                        <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                
                                                                <li role="presentation" class="dropdown">
                                                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-envelope-o"></i>
                                                                        <span class="badge bg-green">6</span>
                                                                    </a>
                                                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                                                        <li>
                                                                            <a>
                                                                                <span class="image">
                                                                                    <img src="images/img.jpg" alt="Profile Image" />
                                                                                </span>
                                                                                <span>
                                                                                    <span>John Smith</span>
                                                                                    <span class="time">3 mins ago</span>
                                                                                </span>
                                                                                <span class="message">
                                                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <div class="text-center">
                                                                                <a href="inbox.html">
                                                                                    <strong>See All Alerts</strong>
                                                                                    <i class="fa fa-angle-right"></i>
                                                                                </a>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    
                                                </div>
                                                <!-- /top navigation -->
                                                <?php if ($_smarty_tpl->tpl_vars['pagePath']->value != "index") {?>
                                                <!-- page content -->
                                                <div class="right_col" role="main">
                                                    <div class="">
                                                        <div class="page-title">
                                                            <div class="title_left">
                                                                <h3><?php echo Lang::getLang($_smarty_tpl->tpl_vars['pageTitle']->value);?>
</h3>
                                                            </div>
                                                            <div class="title_right">
                                                                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Search for...">
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-default" type="button">Go!</button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="x_panel">
                                                                        <div class="x_title">
                                                                            <h2></h2>
                                                                            <ul class="nav navbar-right panel_toolbox">
                                                                                <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                                                                </li>
                                                                                <li class="dropdown">
                                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                                    <ul class="dropdown-menu" role="menu">
                                                                                        <li><a href="#">Settings 1</a>
                                                                                        </li>
                                                                                        <li><a href="#">Settings 2</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </li>
                                                                                <li><a href="#"><i class="fa fa-close"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="x_content">
                                                                        <?php }
}
}
