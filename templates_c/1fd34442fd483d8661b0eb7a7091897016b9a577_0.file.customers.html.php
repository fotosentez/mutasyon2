<?php
/* Smarty version 3.1.30, created on 2016-12-29 21:10:54
  from "/var/www/html/mutasyon2/view/default/customers.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_586551aec97735_27687648',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fd34442fd483d8661b0eb7a7091897016b9a577' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/customers.html',
      1 => 1483035051,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_586551aec97735_27687648 (Smarty_Internal_Template $_smarty_tpl) {
?>
          
          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_content">

                  <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                        <?php echo AddHtml::addPaginationWithLetter($_smarty_tpl->tpl_vars['customersLetters']->value,"customers","c");?>

                    </div>
                    <div class="clearfix"></div>
                    
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customers']->value, 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
                    <!-- List Start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                      <div class="well profile_view">
                        <div class="col-sm-12">
                          <h4 class="brief"><i>Digital Strategist</i></h4>
                          <div class="left col-xs-7">
                              <h2><?php echo $_smarty_tpl->tpl_vars['c']->value['customers_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['customers_surname'];?>
</h2>
                            <p><strong>About: </strong> Web Designer / UI. </p>
                            <ul class="list-unstyled">
                              <li><i class="fa fa-phone"></i> Address: </li>
                              <li><i class="fa fa-phone"></i> Address: </li>

                            </ul>
                          </div>
                          <div class="right col-xs-5 text-center">
                            <img src="view/img/1.jpg" alt="" class="img-circle img-responsive">
                          </div>
                        </div>
                        <div class="col-xs-12 bottom text-center">
                          <div class="col-xs-12 col-sm-6 emphasis">
                            <p class="ratings">
                              <a>4.0</a>
                              <a href="#"><span class="fa fa-star"></span></a>
                              <a href="#"><span class="fa fa-star"></span></a>
                              <a href="#"><span class="fa fa-star"></span></a>
                              <a href="#"><span class="fa fa-star"></span></a>
                              <a href="#"><span class="fa fa-star-o"></span></a>
                            </p>
                          </div>
                          <div class="col-xs-12 col-sm-6 emphasis">
                            <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                                            </i> <i class="fa fa-comments-o"></i> </button>
                            <button type="button" class="btn btn-primary btn-xs"> <i class="fa fa-user">
                                                            </i> View Profile </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- List Finish-->
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div><?php }
}
