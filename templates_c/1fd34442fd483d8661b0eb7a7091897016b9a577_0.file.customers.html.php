<?php
/* Smarty version 3.1.30, created on 2017-01-11 20:51:52
  from "/var/www/html/mutasyon2/view/default/customers.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587670b8b64385_00888599',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fd34442fd483d8661b0eb7a7091897016b9a577' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/customers.html',
      1 => 1483636221,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587670b8b64385_00888599 (Smarty_Internal_Template $_smarty_tpl) {
?>
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
                    <h4 class="brief"><b><i><?php echo $_smarty_tpl->tpl_vars['c']->value['customers_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['customers_surname'];?>
</i></b></h4>
                    <div class="left col-xs-7">
                        <h4><?php echo $_smarty_tpl->tpl_vars['c']->value['costumers_groups_name'];?>
</h4>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-phone"></i><?php echo $_smarty_tpl->tpl_vars['c']->value['customers_phone'];?>
</li>
                            <p><strong><?php echo Lang::getLang('address');?>
: </strong><?php echo $_smarty_tpl->tpl_vars['c']->value['customers_address'];?>
</p>
                        </ul>
                    </div>
                    <div class="right col-xs-5 text-center">
                        <img src="view/img/1.jpg" alt="" class="img-circle img-responsive">
                        </div>
                    </div>
                    <div class="col-xs-12 bottom text-center">
                        <div class="col-xs-12 col-sm-6 emphasis">
                            <p class="ratings">
                                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['c']->value['costumers_groups_star']+1 - (1) : 1-($_smarty_tpl->tpl_vars['c']->value['costumers_groups_star'])+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <?php }
}
?>

                                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? (5-$_smarty_tpl->tpl_vars['c']->value['costumers_groups_star'])+1 - (1) : 1-((5-$_smarty_tpl->tpl_vars['c']->value['costumers_groups_star']))+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                                <a href="#"><span class="fa fa-star-o"></span></a>
                                <?php }
}
?>

                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-6 emphasis">
                            <button type="button" class="btn btn-success btn-xs"> 
                                <i class="fa fa-plus"></i> 
                                <i class="fa-file-text-o"></i> 
                            </button>
                            <a href="?url=customers&id=<?php echo $_smarty_tpl->tpl_vars['c']->value['customers_id'];?>
" type="button" class="btn btn-primary btn-xs"> 
                                <i class="fa fa-user"></i> <?php echo Lang::getLang('viewProfil');?>
 
                            </a>
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

            <?php if ($_smarty_tpl->tpl_vars['totalPage']->value > 1) {?>
                <?php if ($_smarty_tpl->tpl_vars['letter']->value) {?>
                <?php ob_start();
echo Get::post('c');
$_prefixVariable1=ob_get_clean();
echo AddHtml::addPagination($_smarty_tpl->tpl_vars['totalPage']->value,"customers&c=".$_prefixVariable1);?>

                <?php } else { ?>
                <?php echo AddHtml::addPagination($_smarty_tpl->tpl_vars['totalPage']->value,"customers");?>

                <?php }?>
            <?php }?>
        </div>
    </div>
</div><?php }
}
