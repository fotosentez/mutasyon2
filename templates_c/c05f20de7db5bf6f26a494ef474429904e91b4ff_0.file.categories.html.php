<?php
/* Smarty version 3.1.30, created on 2017-01-14 21:09:03
  from "/var/www/html/mutasyon2/view/default/products/categories.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587a693f994976_06692356',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c05f20de7db5bf6f26a494ef474429904e91b4ff' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/products/categories.html',
      1 => 1484417340,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587a693f994976_06692356 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- start accordion -->
<div class="accordion hidden-xs" id="accordion" role="tablist" aria-multiselectable="true">
    <h2><i class="fa fa-align-left"></i> Kategoriler</h2>
    <a class="panel-heading collapsed" href="?url=products">
        <h4 class="panel-title"><i class="fa fa-home"></i> Tüm Ürünler</h4>
    </a>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mainCategories']->value, 'mc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mc']->value) {
?>
    <div class="panel">
        <a class="panel-heading collapsed" role="tab" id="<?php echo $_smarty_tpl->tpl_vars['mc']->value['maincategory_name'];?>
" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $_smarty_tpl->tpl_vars['mc']->value['maincategory_id'];?>
" aria-expanded="false" aria-controls="<?php echo $_smarty_tpl->tpl_vars['mc']->value['maincategory_id'];?>
">
            <h4 class="panel-title"><i class="fa fa-home"></i> <?php echo $_smarty_tpl->tpl_vars['mc']->value['maincategory_name'];?>
</h4>
            <small><?php echo $_smarty_tpl->tpl_vars['mc']->value['maincategory_desc'];?>
</small>
        </a>
        <div id="<?php echo $_smarty_tpl->tpl_vars['mc']->value['maincategory_id'];?>
" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $_smarty_tpl->tpl_vars['mc']->value['maincategory_name'];?>
">
            <div class="panel-body">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subCategories']->value, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['mc']->value['maincategory_id'] == $_smarty_tpl->tpl_vars['sc']->value['subcategory_main']) {?>
                    <p><a href="?url=products&cid=<?php echo $_smarty_tpl->tpl_vars['sc']->value['subcategory_id'];?>
"><i class="fa fa-caret-right"></i> <?php echo $_smarty_tpl->tpl_vars['sc']->value['subcategory_name'];?>
</a></p>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </div>
        </div>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</div>
<!-- end of accordion -->

<div class=" hidden-sm hidden-md hidden-lg">
    <!-- Small modal -->
    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm">Kategorilere Bak</button>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Kategoriler</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row"><a href="?url=products"><i class="fa fa-caret-right"></i> Tüm Ürünler</a></th>
                            </tr>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subCategories']->value, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value) {
?>
                            <tr>
                                <th scope="row"><a href="?url=products&cid=<?php echo $_smarty_tpl->tpl_vars['sc']->value['subcategory_id'];?>
"><i class="fa fa-caret-right"></i> <?php echo $_smarty_tpl->tpl_vars['sc']->value['subcategory_name'];?>
</a></th>
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
    <!-- /modals -->
</div>

<!-- Filters -->
<?php }
}
