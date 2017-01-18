<?php
/* Smarty version 3.1.30, created on 2017-01-15 13:46:01
  from "/var/www/html/mutasyon2/view/default/products.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587b52e99c2fe5_63548896',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd436792d4dd05758ea19f3e4a3b1e01d9e2b0d8d' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/products.html',
      1 => 1484477155,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:view/default/products/categories.html' => 1,
  ),
),false)) {
function content_587b52e99c2fe5_63548896 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/var/www/html/mutasyon2/model/libs/plugins/modifier.truncate.php';
?>
<div class="col-xs-12">
    <table class="table filter">
        <tbody>
            <tr>
                <th>
                    <a href="javascript:removeOther('stock=outstock', 'stock=instock');"><i class="fa fa-check-square-o"></i> <span class="hidden-xs">Stokta Olanlar</span></a>
                </th>
                <th>
                    <a href="javascript:removeOther('s=all', 's=bestseller');"><i class="fa fa-line-chart"></i> <span class="hidden-xs">Çok Satılanlar</span></a>
                </th>
                <th>
                    <a href="javascript:removeOther('stock=instock', 'stock=outstock');"><i class="fa fa-battery-empty"></i> <span class="hidden-xs">Tükenenler</span></a>
                </th>
                <th class="gridList">
                    <a class="list"><i class="fa fa-bars"></i> <span class="hidden-xs">Liste</span></a>
                </th>
                <th class="gridList">
                    <a class="grid"><i class="fa fa-th-large"></i> <span class="hidden-xs">Tablo</span></a>
                </th>
            </tr>
        </tbody>
    </table>
</div><!--/prfilter-->
<div class="col-sm-3 col-xs-12">
    <?php $_smarty_tpl->_subTemplateRender("file:view/default/products/categories.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</div>
<div class="col-sm-9 col-xs-12 <?php if ($_SESSION['view'] == 'list') {?>vlist<?php } else { ?>vgrid<?php }?>">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'pr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->value) {
?>
    
    <?php if ($_SESSION['view'] == 'list') {?>
    <div class="row prlist">
        <div class="col-sm-4 col-xs-6">
            <img class="vbestseller" src="view/img/crown.png" />
            <img class="vprimage" src="view/img/products/37/big/51.jpg" />
        </div>
        <div class="col-sm-8 col-xs-6">
            <div class="row listPrname">
                <a href="?url=products/detail&id=<?php echo $_smarty_tpl->tpl_vars['pr']->value['products_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['pr']->value['products_name'];?>
">
                    <span class="vprname"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['pr']->value['products_name'],50);?>
</span>
                </a>
            </div>
            <div class="row listPrsname hidden-xs">
                <span class="vdetail"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['pr']->value['products_short_detail'],100);?>
</span>
            </div>
            <div class="row listPrbuttons">
                <span class="price">TRY 13</span>
                <div style="clear:both">
                    <a data-toggle="collapse" href="#buystock" class="btn btn-success btn-xs buystock1" stock="Hafıza Kartı 4 GB" sid="1">
                        <i class="fa fa-cart-plus"></i> Satın Al
                    </a>
                    <a data-toggle="collapse" href="#sellstock" class="btn btn-dark btn-xs sellstock1" price="10" stockname="Hafıza Kartı 4 GB">
                        <i class="fa fa-shopping-cart"></i> Satış Yap
                    </a>
                    <input class="ctname" value="Hafıza Kartı" type="hidden">
                </div>
            </div>
         </div>
    </div>
    
    <?php } else { ?>
    <div class="col-sm-3 col-xs-6 prbox relative">
        <div class="prboxinner">
            <div class="row rowImage">
                <img class="vbestseller" src="view/img/crown.png" />
                <img class="vprimage" src="view/img/products/<?php echo $_smarty_tpl->tpl_vars['pr']->value['products_id'];?>
/big/<?php echo $_smarty_tpl->tpl_vars['pr']->value['cover'];?>
.jpg" />
            </div>
            <div class="row vname">
                <a href="?url=products/detail&id=<?php echo $_smarty_tpl->tpl_vars['pr']->value['products_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['pr']->value['products_name'];?>
">
                    <span class="vprname"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['pr']->value['products_name'],40);?>
</span>
                </a>
            </div>
            <div class="row vdetail hidden-xs">
                <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['pr']->value['products_short_detail'],80);?>

            </div>
            <div class="row">
                <div class="vpricemobile">
                    <div class="vprice">
                        <span>₺</span> 10
                    </div>
                </div>
                <a data-toggle="collapse" href="#buystock" class="btn btn-success btn-xs buystock1" stock="Hafıza Kartı 4 GB" sid="1">
                    <i class="fa fa-cart-plus"></i> Satın Al
                </a>
                <a data-toggle="collapse" href="#sellstock" class="btn btn-dark btn-xs sellstock1" price="10" stockname="Hafıza Kartı 4 GB">
                    <i class="fa fa-shopping-cart"></i> Satış Yap
                </a>
                <input class="ctname" value="Hafıza Kartı" type="hidden">
            </div>
        </div>
    </div>
    <?php }?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <div class="row hidden-xs">
        <?php if ($_smarty_tpl->tpl_vars['totalPage']->value > 1) {?>
            <?php echo AddHtml::addPagination($_smarty_tpl->tpl_vars['totalPage']->value,$_smarty_tpl->tpl_vars['urlName']->value);?>

        <?php }?>
    </div>
    <div class="row  hidden-sm hidden-md hidden-lg">
        <?php if ($_smarty_tpl->tpl_vars['totalPage']->value > 1) {?>
            <?php echo AddHtml::addPagination($_smarty_tpl->tpl_vars['totalPage']->value,$_smarty_tpl->tpl_vars['urlName']->value,"mobile");?>

        <?php }?>
    </div>
    
</div>
    <?php }
}
