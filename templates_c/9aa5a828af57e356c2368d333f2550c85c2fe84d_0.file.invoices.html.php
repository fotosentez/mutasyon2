<?php
/* Smarty version 3.1.30, created on 2017-01-27 21:28:21
  from "/var/www/html/mutasyon2/view/default/invoice/invoices.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_588b91458779f4_65375502',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9aa5a828af57e356c2368d333f2550c85c2fe84d' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/invoice/invoices.html',
      1 => 1485289901,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_588b91458779f4_65375502 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/var/www/html/mutasyon2/model/libs/plugins/modifier.date_format.php';
?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo Lang::getLang("invoiceNo");?>
</th>
                                <th><?php echo Lang::getLang("desc");?>
</th>
                                <th><?php echo Lang::getLang("admin");?>
</th>
                                <th><?php echo Lang::getLang("customer");?>
</th>
                                <th><?php echo Lang::getLang("cash");?>
</th>
                                <th><?php echo Lang::getLang("total");?>
</th>
                                <th><?php echo Lang::getLang("date");?>
</th>
                                <th><?php echo Lang::getLang("invoiceExpiry");?>
</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoice']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                            <tr>
                                <td class="invoiceList <?php if ($_smarty_tpl->tpl_vars['i']->value['invoice_cancelled'] == 1) {?>invoiceNo<?php }?>">
                                    <a href="index.php?url=invoices/id=<?php echo $_smarty_tpl->tpl_vars['i']->value['invoice_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['prefix_name'];
echo $_smarty_tpl->tpl_vars['i']->value['invoice_no'];?>
</a>
                                    <?php if ($_smarty_tpl->tpl_vars['i']->value['invoice_providers_id'] == NULL) {?>
                                            <i class="fa fa-circle purple"></i>
                                        <?php } else { ?>
                                            <i class="fa fa-circle silver"></i>
                                        <?php }?>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['i']->value['invoice_desc'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['i']->value['superuser_name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['i']->value['customers_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['i']->value['customers_surname'];?>
</td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['i']->value['cash_name'] != NULL) {?>
                                        <a><?php echo $_smarty_tpl->tpl_vars['i']->value['cash_name'];?>
</a>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['i']->value['providers_name'] != NULL) {?>
                                        <a><?php echo $_smarty_tpl->tpl_vars['i']->value['providers_name'];?>
</a>
                                    <?php } else { ?>
                                    <a></a>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['currency']->value;?>

                                    <?php if ($_smarty_tpl->tpl_vars['i']->value['invoice_discount_type'] == "percent") {?>
                                        <?php echo $_smarty_tpl->tpl_vars['i']->value['productTotal']-($_smarty_tpl->tpl_vars['i']->value['invoice_discount']*$_smarty_tpl->tpl_vars['i']->value['productTotal']/100);?>

                                    <?php } else { ?>
                                        <?php echo $_smarty_tpl->tpl_vars['i']->value['productTotal']-$_smarty_tpl->tpl_vars['i']->value['invoice_discount'];?>

                                    <?php }?>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['i']->value['invoice_date'];?>
</td>
                                <td <?php if (smarty_modifier_date_format(time(),"%Y-%m-%d") >= $_smarty_tpl->tpl_vars['i']->value['invoice_due_date']) {?>class="expry"<?php }?>>
                                    <?php echo $_smarty_tpl->tpl_vars['i']->value['invoice_due_date'];?>

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
                <i class="fa fa-circle purple"></i>: Ürün faturası<br>
                <i class="fa fa-circle silver"></i>: Servis faturası<?php }
}
