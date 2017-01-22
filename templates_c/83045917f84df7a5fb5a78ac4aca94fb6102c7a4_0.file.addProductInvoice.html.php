<?php
/* Smarty version 3.1.30, created on 2017-01-22 17:22:07
  from "/var/www/html/mutasyon2/view/default/invoice/addProductInvoice.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5884c00fe66887_17261736',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83045917f84df7a5fb5a78ac4aca94fb6102c7a4' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/invoice/addProductInvoice.html',
      1 => 1485094924,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5884c00fe66887_17261736 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Search product -->
<div class="row">
    <div class="col-xs-12">
        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 relative">
            <input type="text" id="addToCart" class="autocomplete form-control" name="term" placeholder="Ürün adı veya SKU" />
            <button type="button" class="btn btn-primary getProductList" data-toggle="modal" data-target=".bs-example-modal-md" />
                    <i class="glyphicon glyphicon-th-list"></i>
                </button>
        </div>
        
        <input type="hidden" id="productPrice" />
        <input type="hidden" id="productSKU" />
    </div>
</div>
<!-- /serach product	     -->

<!-- Basket -->
<h4 class="cartListheader"><?php echo Lang::getLang("cart");?>
</h4>
<div class="cartList">
    <div id="urunler"  class="urunler row">
        <ul class="baslik">
            <li class="col-xs-2"><?php echo Lang::getLang("sku");?>
</li><li class="col-sm-6 col-xs-5"><?php echo Lang::getLang("productName");?>
</li><li class="col-xs-2 col-sm-1"><?php echo Lang::getLang("amount");?>
</li><li class="col-xs-2"><?php echo Lang::getLang("price");?>
</li><li class="col-xs-1"><?php echo Lang::getLang("delete");?>
</li>
        </ul>
        <ul id="cart" class="icerik">
            
        </ul>
    </div>
    <div class="clear"></div>
</div>
<div class="pull-right" id="total"><?php echo Lang::getLang("total");?>
: <span></span></div>
<input id="totalInput" type="hidden" name="total" />
<!-- /Basket -->

<!-- Small modal -->

<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"><?php echo Lang::getLang("productsList");?>
</h4>
            </div>
            <div class="modal-body">
                <table id="datatable-keytable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo Lang::getLang("productName");?>
</th>
                            <th><?php echo Lang::getLang("productPrefix");?>
</th>
                            <th><?php echo Lang::getLang("sku");?>
</th>
                            <th><?php echo Lang::getLang("price");?>
</th>
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
                        <tr id="<?php echo $_smarty_tpl->tpl_vars['p']->value['products_id'];?>
" onClick="clickToAddCart(<?php echo $_smarty_tpl->tpl_vars['p']->value['products_id'];?>
)">
                            <td class="listProductName"><?php echo $_smarty_tpl->tpl_vars['p']->value['products_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['p']->value['products_prefix'];?>
</td>
                            <td class="SKU"><?php echo $_smarty_tpl->tpl_vars['p']->value['SKU'];?>
</td>
                            <td class="listPrice"><?php echo $_smarty_tpl->tpl_vars['p']->value['sp_price'];?>
</td>
                        </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /modals --><?php }
}
