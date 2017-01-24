<?php
/* Smarty version 3.1.30, created on 2017-01-24 18:09:21
  from "/var/www/html/mutasyon2/view/default/addCustomer.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58876e21e96052_22124422',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c3fe7a5710fad113fce87d61a4133d9044ab6cb' => 
    array (
      0 => '/var/www/html/mutasyon2/view/default/addCustomer.html',
      1 => 1485270554,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58876e21e96052_22124422 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/var/www/html/mutasyon2/model/libs/plugins/modifier.date_format.php';
?>
<form class="form-horizontal noload" method="post" action="controller/addCustomer.php">
    
    <!--Inputs -->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo Lang::getLang('name');?>
 
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="name" class="form-control col-md-7 col-xs-12" name="name" type="text" required />
            <input class="form-control col-md-7 col-xs-12" name="addDate" type="hidden" value="<?php echo smarty_modifier_date_format(time(),'%Y.%m.%d');?>
" />
        </div>
    </div>
    
    <!--Surname -->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="surname"><?php echo Lang::getLang('surname');?>
 
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" name="surname" type="text" required/>
        </div>
    </div>
    
    <!--Address -->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea"><?php echo Lang::getLang('address');?>
 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="textarea" name="address" class="form-control col-md-7 col-xs-12"></textarea>
        </div>
    </div>
    
    <!--Phone -->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo Lang::getLang('phone');?>
 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control" name="phone" data-inputmask="'mask' : '(999) 999-9999'" type="text">
            </div>
        </div>
        
        <!--Mail -->
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mail"><?php echo Lang::getLang('mail');?>
 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" class="form-control col-md-7 col-xs-12" name="mail" type="text" />
            </div>
        </div>
        
        <!--City -->
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city"><?php echo Lang::getLang('city');?>
 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" class="form-control col-md-7 col-xs-12" name="city" type="text" />
            </div>
        </div>
        
        <!--Country -->
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country"><?php echo Lang::getLang('country');?>
 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" class="form-control col-md-7 col-xs-12" name="country" type="text" />
            </div>
        </div>
        
        <!--Select Group -->
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo Lang::getLang('group');?>
</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="group">
                    <option value=""><?php echo Lang::getLang('noGroup');?>
</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['getGroup']->value, 'g');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['g']->value) {
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['g']->value['costumers_groups_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['g']->value['costumers_groups_name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
            </div>
        </div>
        <!--inputs -->
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <a href="?url=customers" class="btn btn-primary"><?php echo Lang::getLang('cancel');?>
</a>
                <button id="send" type="submit" class="btn btn-success"><?php echo Lang::getLang('submit');?>
</button>
            </div>
        </div>
    </form><?php }
}
