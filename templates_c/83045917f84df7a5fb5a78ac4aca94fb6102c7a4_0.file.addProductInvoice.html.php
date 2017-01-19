<?php
/* Smarty version 3.1.30, created on 2017-01-18 13:36:07
  from "/var/www/html/mutasyon2/view/default/invoice/addProductInvoice.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587f45174ca762_93119180',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83045917f84df7a5fb5a78ac4aca94fb6102c7a4' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/invoice/addProductInvoice.html',
      1 => 1484677448,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587f45174ca762_93119180 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Search product -->
<div class="row">
    <div class="col-sm-12">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
            <div class="col-sm-12 relative">
                <input type="text" id="addToCart" class="form-control" name="term" placeholder="Ürün adı veya SKU" />
                <button type="button" class="btn btn-default btn-sm getProductLit" data-toggle="collapse" href="#stocklist" aria-expanded="false" title="Ürünlere bak">
                    <i class="glyphicon glyphicon-th-list"></i>
                </button>
            </div>
        </div>
        
        <input type="hidden" id="productPrice" />
        <input type="hidden" id="productSKU" />
    </div>
</div>
<!-- /serach product	     -->

<!-- Basket -->
<h4 class="cartListheader">Sepet</h4>
<div class="cartList">
    <div id="urunler"  class="urunler row">
        <ul class="baslik">
            <li class="col-xs-2">SKU</li><li class="col-sm-6 col-xs-5">Ürün Adı</li><li class="col-xs-2 col-sm-1">Miktar</li><li class="col-xs-2">Fiyat</li><li class="col-xs-1">Sil</li>
        </ul>
        <ul id="sepet" class="icerik">
            
        </ul>
    </div>
    <div class="clearBosluk"></div>
</div>
<!-- /Basket --><?php }
}
