<?php
/* Smarty version 4.3.4, created on 2024-12-12 17:56:29
  from '/home/roeluser1/public_html/tienda/modules/ybc_blog_free/views/templates/hook/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b4dfd2245e3_30477449',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e29df1577e58cb760d49c92bce688480815cc03' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/modules/ybc_blog_free/views/templates/hook/footer.tpl',
      1 => 1733214785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b4dfd2245e3_30477449 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    ybc_blog_free_like_url = '<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['like_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
    ybc_like_error ='<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ybc_like_error']->value,'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
    YBC_BLOG_FREE_GALLERY_SPEED = <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['YBC_BLOG_FREE_GALLERY_SPEED']->value )), ENT_QUOTES, 'UTF-8');?>
;
    YBC_BLOG_FREE_SLIDER_SPEED = <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['YBC_BLOG_FREE_SLIDER_SPEED']->value )), ENT_QUOTES, 'UTF-8');?>
;
    YBC_BLOG_FREE_GALLERY_SKIN = '<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['YBC_BLOG_FREE_GALLERY_SKIN']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
    YBC_BLOG_FREE_GALLERY_AUTO_PLAY = <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['YBC_BLOG_FREE_GALLERY_AUTO_PLAY']->value )), ENT_QUOTES, 'UTF-8');?>
;
<?php echo '</script'; ?>
><?php }
}
