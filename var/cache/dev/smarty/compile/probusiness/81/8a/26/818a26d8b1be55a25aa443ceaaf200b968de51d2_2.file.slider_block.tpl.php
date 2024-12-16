<?php
/* Smarty version 4.3.4, created on 2024-12-11 17:09:31
  from '/home/roeluser1/public_html/tienda/modules/ybc_blog_free/views/templates/hook/slider_block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6759f17b744f88_46560458',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '818a26d8b1be55a25aa443ceaaf200b968de51d2' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/modules/ybc_blog_free/views/templates/hook/slider_block.tpl',
      1 => 1733214785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6759f17b744f88_46560458 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['slides']->value) {?>
    <div class="bybc-blog-slider <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_RTL_CLASS'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php if ((isset($_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SLIDER_DISPLAY_CAPTION'])) && $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SLIDER_DISPLAY_CAPTION']) {?>caption-enabled<?php } else { ?>caption-disabled<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SLIDER_DISPLAY_NAV'])) && $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SLIDER_DISPLAY_NAV']) {?>nav-enabled<?php } else { ?>nav-disabled<?php }?>">
        <div class="block_content">
            <div class="ybc-blog-slider loading slider-wrapper theme-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['nivoTheme']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                <div class="loading_img">
                <img src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['loading_img']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'loading','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
" /></div>
                <div id="ybc_slider">                     
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slides']->value, 'slide');
$_smarty_tpl->tpl_vars['slide']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->do_else = false;
?>
                     
                        <?php if ($_smarty_tpl->tpl_vars['slide']->value['url']) {?><a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php }?>
                        <img src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['caption'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['caption'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                        <?php if ($_smarty_tpl->tpl_vars['slide']->value['url']) {?></a><?php }?>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                
                </div>                
            </div>
        </div>
    </div>
    <?php echo '<script'; ?>
 type="text/javascript">
        var sliderAutoPlay = <?php if ($_smarty_tpl->tpl_vars['nivoAutoPlay']->value) {?>true<?php } else { ?>false<?php }?>;       
    <?php echo '</script'; ?>
>
<?php }
}
}
