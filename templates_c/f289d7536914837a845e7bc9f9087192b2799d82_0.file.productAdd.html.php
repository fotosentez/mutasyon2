<?php
/* Smarty version 3.1.30, created on 2017-01-13 16:40:23
  from "/var/www/html/mutasyon2/view/default/productAdd.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5878d8c77776a4_62393578',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f289d7536914837a845e7bc9f9087192b2799d82' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/productAdd.html',
      1 => 1484314169,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5878d8c77776a4_62393578 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="navbar">  
    <h3>1- <?php echo Lang::getLang('productInfs');?>
</h3>
    <form action="controller/products/productAdd.php" method="post" enctype="multipart/form-data" class="tinyMCE">
        <div class="well one"><!--add product-->
            <label class="margin-top"><?php echo Lang::getLang('productName');?>
</label>
            <input type="text" class="form-control name" placeholder="<?php echo Lang::getLang('productName');?>
" name="product_name" />
            <label class="margin-top"><?php echo Lang::getLang('shortDesc');?>
</label>
            <input type="text" class="form-control shortdesc" placeholder="<?php echo Lang::getLang('shortDesc');?>
" name="short_desc" />
            <label class="margin-top"><?php echo Lang::getLang('desc');?>
</label>
            <textarea type="text" class="form-control" placeholder="<?php echo Lang::getLang('desc');?>
" id="editor" name="product_detail"></textarea>
            <label><?php echo Lang::getLang('category');?>
</label>
            <div class="input-group input-group-sm categorylist">
                <span class="input-group-addon btn btn-yellow" id="sizing-addon3" data-toggle="collapse" href="#addcategory" aria-expanded="false" title="<?php echo Lang::getLang('addCategory');?>
">
                    <i class="fa fa-plus"></i> <?php echo Lang::getLang('addCategory');?>

                </span>
                <select class="form-control" name="category">
                    <option value="none"></option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['getSubCategory']->value, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value) {
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['sc']->value['subcategory_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['sc']->value['maincategory_name'];?>
 --> <?php echo $_smarty_tpl->tpl_vars['sc']->value['subcategory_name'];?>
                     </option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
            </div>
            <button class="btn btn-success margin-top send" type="submit"><?php echo Lang::getLang('addNewProduct');?>
</button>
        </div><!--/add product-->
    </form>
    
    <div class="two "><!--add picture-->
        <h3>2- <?php echo Lang::getLang('uploadImages');?>
</h3>
        <div class="form-group margin-top well ">
            <div class="form-group">
                <form action="controller/addImages.php" method="post" class="dropzone" id="addimagesform" enctype="multipart/form-data">
                    <input name="newproductname" class="stname" type="hidden" />
                </form>
            </div>
            <a href="?url=products" class="btn btn-success"><?php echo Lang::getLang('finishUpload');?>
</a>
        </div>
    </div><!--/add picture-->
</div><!--/navbar--><?php }
}
