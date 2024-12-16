<?php
/* Smarty version 4.3.4, created on 2024-12-12 17:56:28
  from 'module:ps_contactinfonav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b4dfcd38fc4_58753731',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0eb2119957cbc13b240126b3ccd8fac8f109f1e2' => 
    array (
      0 => 'module:ps_contactinfonav.tpl',
      1 => 1733215291,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b4dfcd38fc4_58753731 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/roeluser1/public_html/tienda/themes/probusiness/modules/ps_contactinfo/nav.tpl --><div id="_desktop_contact_link">
  <div id="contact-link" class="shop_text_nav">
    <i aria-hidden="true" class="fa fa-phone-square"></i>
    <div class="shop_text_nav_config">
      <?php if ($_smarty_tpl->tpl_vars['contact_infos']->value['phone']) {?>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'[1]%phone%[/1] 24/7 Online Support','sprintf'=>array('[1]'=>'<span>','[/1]'=>'</span>','%phone%'=>$_smarty_tpl->tpl_vars['contact_infos']->value['phone']),'d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>


      <?php } else { ?>
        <?php if ((isset($_smarty_tpl->tpl_vars['tc_config']->value))) {?>
          <a href="tel:<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tc_config']->value['BLOCKCONTACTINFOS_PHONE'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><span><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tc_config']->value['BLOCKCONTACT_LABEL_PHONE'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span></a>
        <?php }?>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'24/7 Online Support','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

      <?php }?>
    </div>
  </div>
</div>
<!-- end /home/roeluser1/public_html/tienda/themes/probusiness/modules/ps_contactinfo/nav.tpl --><?php }
}
