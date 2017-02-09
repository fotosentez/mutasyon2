<?php
/* Smarty version 3.1.30, created on 2017-02-01 17:19:42
  from "/var/www/html/mutasyon2/view/default/invoice/addInvoice.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5891ee7e21a150_60039712',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f58d2f0f7dbe35fba80ea4a7f6b9f20cdf6a8741' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/invoice/addInvoice.html',
      1 => 1485872728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:view/default/invoice/addProductInvoice.html' => 1,
    'file:view/default/invoice/addServiceInvoice.html' => 1,
  ),
),false)) {
function content_5891ee7e21a150_60039712 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/var/www/html/mutasyon2/model/libs/plugins/modifier.date_format.php';
?>
<!-- Smart Wizard -->
<p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
<form id="addInvoiceForm" action="controller/invoice/addInvoice.php" class="form-horizontal form-label-left noload" onsubmit="return(false)">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Müşteri Adı</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input autocomplete="off" id="customers" type="text" name="customer-name" required="required" class="customer-name autocomplete form-control col-md-7 col-xs-12" />
            <input autocomplete="off" id="customerId" name="cId" type="hidden" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih</label>
        <div class="col-sm-3 col-xs-6">
            <input autocomplete="off" type="date" name="date" value="<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
" required="required" class="date form-control col-md-7 col-xs-12" />
        </div>
        <div class="col-sm-3 col-xs-6">
            <input autocomplete="off" type="date" name="dueDate" value="<?php echo smarty_modifier_date_format("+1 month",'%Y-%m-%d');?>
" required="required" class="date dueDate form-control col-md-7 col-xs-12" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">İndirim</label>
        <div class="col-sm-1 col-xs-3">
            <select class="form-control discountType" name="discountType">
                <option value="percent">Yüzde</option>
                <option value="same">Aynısı</option>
            </select>
        </div>
        <div class="col-sm-2 col-xs-3">
            <input autocomplete="off" type="number" name="discount" class="discount form-control col-md-7 col-xs-12" />
        </div>
        <label class="control-label col-sm-1 col-xs-2">Önek</label>
        <div class="col-sm-2 col-xs-4">
            <select class="form-control prefix" name="prefix">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['prefix']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['prefix_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['prefix_name'];?>
</option>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <label>Ürün Faturası</label> 
            <input autocomplete="off" type="radio" class="whichInvoice invoiceType" name="invoiceType" id="typeP" value="product" required />
            <label>Hizmet Faturası</label> 
            <input autocomplete="off" type="radio" class="whichInvoice invoiceType" name="invoiceType" id="typeS" value="service" required />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Açıklama</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea type="text" name="desc" class="desc form-control col-md-7 col-xs-12" ></textarea>
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
    <div class="clear"></div>
    <div class="x_content">
        <button type="submit" class="btn btn-success"><?php echo Lang::getLang("submit");?>
</button>
    </div>
</form>
<!-- End SmartWizard Content --><?php }
}
