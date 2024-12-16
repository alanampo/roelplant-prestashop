<?php
/* Smarty version 4.3.4, created on 2024-12-12 17:56:28
  from '/home/roeluser1/public_html/tienda/themes/probusiness/modules/ybc_productimagehover/views/templates/hook/renderJs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b4dfcbad966_02501759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cc479dbb41f47d58a322738920e6ac77747223c' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/themes/probusiness/modules/ybc_productimagehover/views/templates/hook/renderJs.tpl',
      1 => 1733215291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b4dfcbad966_02501759 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
 var baseAjax ='<?php if ((isset($_smarty_tpl->tpl_vars['_PI_VER_17_']->value)) && $_smarty_tpl->tpl_vars['_PI_VER_17_']->value) {
echo $_smarty_tpl->tpl_vars['baseAjax']->value;
} else {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['baseAjax']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>';
 var YBC_PI_TRANSITION_EFFECT = '<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['YBC_PI_TRANSITION_EFFECT']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
 var _PI_VER_17_ = <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['_PI_VER_17_']->value )), ENT_QUOTES, 'UTF-8');?>

 var _PI_VER_16_ = <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['_PI_VER_16_']->value )), ENT_QUOTES, 'UTF-8');?>

<?php echo '</script'; ?>
><?php }
}
