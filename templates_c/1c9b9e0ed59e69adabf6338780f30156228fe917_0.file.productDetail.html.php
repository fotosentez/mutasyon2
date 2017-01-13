<?php
/* Smarty version 3.1.30, created on 2017-01-09 20:58:29
  from "/var/www/html/mutasyon2/view/default/productDetail.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5873cf454a2a67_69562167',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c9b9e0ed59e69adabf6338780f30156228fe917' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/productDetail.html',
      1 => 1483455251,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5873cf454a2a67_69562167 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="x_content">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productDetail']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="product-image">
            <img src="view/img/products/<?php echo $_smarty_tpl->tpl_vars['p']->value['products_id'];?>
/big/<?php echo $_smarty_tpl->tpl_vars['p']->value['cover'];?>
.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['products_name'];?>
" />
        </div>
        <div class="product_gallery">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['getImages']->value, 'images');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['images']->value) {
?>
            <a>
                <img src="view/img/products/<?php echo $_smarty_tpl->tpl_vars['p']->value['products_id'];?>
/small/<?php echo $_smarty_tpl->tpl_vars['images']->value['products_images_id'];?>
.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['products_name'];?>
" />
            </a>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </div>
    </div>
    
    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
        
        <h3 class="prod_title"><?php echo $_smarty_tpl->tpl_vars['p']->value['products_name'];?>
</h3>
        
        <p><?php echo $_smarty_tpl->tpl_vars['p']->value['products_short_detail'];?>
</p>
        <br />
        
        <?php if ($_smarty_tpl->tpl_vars['isAttributes']->value == 1) {?>
        <div class="">
            <h2>Öznitelikler</h2>
            <ul class="list-inline prod_color">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['attr']->value, 'ga');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ga']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['ga']->value['color'] == NULL) {?>
                        <li>
                            <label><?php echo $_smarty_tpl->tpl_vars['ga']->value['ag_name'];?>
</label><br />
                            <button type="button" class="btn btn-default btn-xs"><?php echo $_smarty_tpl->tpl_vars['ga']->value['ac_name'];?>
</button>
                        </li>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </ul>
        </div>
        <br />
        <?php }?>
        
        <div class="">
            <h2><?php echo Lang::getLang('colors');?>
</h2>
            <ul class="list-inline prod_color">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['attr']->value, 'color');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['color']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['color']->value['color'] != NULL) {?>
                        <li>
                            <div class="color" style="background-color:#<?php echo $_smarty_tpl->tpl_vars['color']->value['color'];?>
"></div>
                        </li>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </ul>
        </div>
        <br />
        
        <div class="">
            <div class="product_price">
                <h1 class="price"><?php echo $_smarty_tpl->tpl_vars['currency']->value;
echo $_smarty_tpl->tpl_vars['p']->value['sp_price'];?>
</h1>
                <span class="price-tax"><?php echo Lang::getLang('exTax');?>
: <?php echo $_smarty_tpl->tpl_vars['currency']->value;
echo Math::findTax($_smarty_tpl->tpl_vars['p']->value['tax_amount'],$_smarty_tpl->tpl_vars['p']->value['sp_price']);?>
</span>
                <br>
                </div>
            </div>
            
            <div class="">
                <button type="button" class="btn btn-default btn-lg"><?php echo Lang::getLang('addToCart');?>
</button>
                <button type="button" class="btn btn-default btn-lg"><?php echo Lang::getLang('addToStock');?>
</button>
            </div>
            
            <div class="product_social">
                <ul class="list-inline">
                    <li><a href="#"><i class="fa fa-facebook-square"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-twitter-square"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-envelope-square"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-rss-square"></i></a>
                    </li>
                </ul>
            </div>
            
        </div>
        
        
        <div class="col-md-12">
            
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><?php echo Lang::getLang('desc');?>
</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><?php echo Lang::getLang('productAct');?>
</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        <p><?php echo $_smarty_tpl->tpl_vars['p']->value['products_detail'];?>
</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-keytable" class="table table-striped table-bordered" style="width:100% !important">
                                        <thead>
                                            <tr>
                                                <th><?php echo Lang::getLang('productName');?>
</th>
                                                <th><?php echo Lang::getLang('sellerName');?>
</th>
                                                <th><?php echo Lang::getLang('amount');?>
</th>
                                                <th><?php echo Lang::getLang('eachPrice');?>
</th>
                                                <th><?php echo Lang::getLang('paidTotal');?>
</th>
                                                <th><?php echo Lang::getLang('date');?>
</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['buyActions']->value, 'ba');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ba']->value) {
?>
                                            <tr>
                                                <td><?php echo $_smarty_tpl->tpl_vars['ba']->value['products_name'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['ba']->value['seller_name'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['ba']->value['bp_amount'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['currency']->value;
echo $_smarty_tpl->tpl_vars['ba']->value['bp_price'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['currency']->value;
echo $_smarty_tpl->tpl_vars['ba']->value['bp_price']*$_smarty_tpl->tpl_vars['ba']->value['bp_amount'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['ba']->value['bp_date'];?>
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
                </div>
            </div>
            
        </div>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</div><?php }
}
