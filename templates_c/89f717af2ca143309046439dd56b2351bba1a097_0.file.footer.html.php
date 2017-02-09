<?php
/* Smarty version 3.1.30, created on 2017-02-05 19:53:19
  from "/var/www/html/mutasyon2/view/default/footer.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5897587f6b7e74_10324183',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89f717af2ca143309046439dd56b2351bba1a097' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/footer.html',
      1 => 1486313596,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5897587f6b7e74_10324183 (Smarty_Internal_Template $_smarty_tpl) {
?>
        </div>
    </div>
<div class="inf displayNone"></div>
<!-- footer content -->

<footer>
    <div class="copyright-info">
        <p class="pull-right">Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>  
        </p>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
<!-- /page content -->

</div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<!-- For alla pages -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/icheck/icheck.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/jquery-ui.min.js"><?php echo '</script'; ?>
>

<!-- PNotify -->
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/notify/pnotify.custom.min.js"><?php echo '</script'; ?>
>
<!-- bootstrap progress js -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/progressbar/bootstrap-progressbar.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/nicescroll/jquery.nicescroll.min.js"><?php echo '</script'; ?>
>
<!-- input mask -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/input_mask/jquery.inputmask.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/switchery/switchery.min.js"><?php echo '</script'; ?>
>
<!-- dropzone -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/dropzone/dropzone.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/custom.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/styles.js"><?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['pagePath']->value == 'customers/addCustomer') {?>
<!-- pace -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/pace/pace.min.js"><?php echo '</script'; ?>
>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['pagePath']->value == 'products/productAdd') {?>
<!-- Tinymace -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/tinymce/tinymce.min.js"><?php echo '</script'; ?>
>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['pagePath']->value == 'invoice/invoices') {
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/dataTables.bootstrap.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/dataTables.buttons.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/buttons.bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/jszip.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/pdfmake.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/vfs_fonts.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/buttons.html5.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/buttons.print.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/dataTables.fixedHeader.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/dataTables.keyTable.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/dataTables.responsive.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/responsive.bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datatables/dataTables.scroller.min.js"><?php echo '</script'; ?>
>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['pagePath']->value == 'profile/profile') {?>
<!-- image cropping -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/cropping/cropper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/cropping/main.js"><?php echo '</script'; ?>
>

<!-- daterangepicker -->
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/moment/moment.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/datepicker/daterangepicker.js"><?php echo '</script'; ?>
>

<!-- chart js -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/chartjs/chart.min.js"><?php echo '</script'; ?>
>

<!-- moris js -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/moris/raphael-min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/moris/morris.min.js"><?php echo '</script'; ?>
>

<!-- pace -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/pace/pace.min.js"><?php echo '</script'; ?>
>
<?php }?>

<!-- if page has js -->
<?php if ($_smarty_tpl->tpl_vars['js']->value) {
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['template_dir']->value;?>
js/<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
.js"><?php echo '</script'; ?>
>
<?php }?>


</body>
</html><?php }
}
