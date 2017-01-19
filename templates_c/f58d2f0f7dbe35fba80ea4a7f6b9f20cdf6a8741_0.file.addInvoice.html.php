<?php
/* Smarty version 3.1.30, created on 2017-01-18 14:01:41
  from "/var/www/html/mutasyon2/view/default/invoice/addInvoice.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587f4b15e7a674_23571445',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f58d2f0f7dbe35fba80ea4a7f6b9f20cdf6a8741' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/invoice/addInvoice.html',
      1 => 1484737298,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:view/default/invoice/addProductInvoice.html' => 1,
    'file:view/default/invoice/addServiceInvoice.html' => 1,
  ),
),false)) {
function content_587f4b15e7a674_23571445 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Smart Wizard -->
<p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
<form id="addInvoiceForm" action="controller/invoice/addInvoice.php" class="form-horizontal form-label-left noload">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Müşteri Adı</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="customer-name" required="required" class="form-control col-md-7 col-xs-12" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" name="date" required="required" class="form-control col-md-7 col-xs-12" />
        </div>
        <div class="col-sm-6">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Önek</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select id="heard" class="form-control" name="prefix">
                    <option value="">Choose..</option>
                    <option value="press">Press</option>
                    <option value="net">Internet</option>
                    <option value="mouth">Word of mouth</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <label>Ürün Faturası</label> 
            <input type="radio" class="whichInvoice" name="invoiceType" id="typeP" value="product" required />
            <label>Hizmet Faturası</label> 
            <input type="radio" class="whichInvoice" name="invoiceType" id="typeS" value="service" required />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Açıklama</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea type="text" name="desc" required="required" class="form-control col-md-7 col-xs-12" ></textarea>
        </div>
    </div>            
    
    <div id="addProductForm" class="displayNone">
        <?php $_smarty_tpl->_subTemplateRender("file:view/default/invoice/addProductInvoice.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
    <div id="addServiceForm" class="displayNone">
        <?php $_smarty_tpl->_subTemplateRender("file:view/default/invoice/addServiceInvoice.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
    <button type="submit" class="btn btn-success">Yolla</button>
</form>
<!-- End SmartWizard Content --><?php }
}
