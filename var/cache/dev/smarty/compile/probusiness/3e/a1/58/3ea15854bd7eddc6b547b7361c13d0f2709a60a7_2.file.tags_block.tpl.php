<?php
/* Smarty version 4.3.4, created on 2024-12-12 17:47:48
  from '/home/roeluser1/public_html/tienda/modules/ybc_blog_free/views/templates/hook/tags_block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b4bf492eff9_56016802',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3ea15854bd7eddc6b547b7361c13d0f2709a60a7' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/modules/ybc_blog_free/views/templates/hook/tags_block.tpl',
      1 => 1733214785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b4bf492eff9_56016802 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['tags']->value) {?>
    <div class="block ybc_block_tag <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_RTL_CLASS'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
        <h4 class="title_blog title_block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Blog tags','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</h4>
            <?php $_smarty_tpl->_assignInScope('totalTags', count($_smarty_tpl->tpl_vars['tags']->value));?>
            <?php $_smarty_tpl->_assignInScope('ik', 0);?>
            <div class="content_block block_content">
                <div class="blog_tag">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tags']->value, 'tag');
$_smarty_tpl->tpl_vars['tag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->do_else = false;
?>
                        <?php $_smarty_tpl->_assignInScope('ik', $_smarty_tpl->tpl_vars['ik']->value+1);?>
                        <a class="<?php if ($_smarty_tpl->tpl_vars['tag']->value['viewed'] > 10000) {?>tag_10000<?php } elseif ($_smarty_tpl->tpl_vars['tag']->value['viewed'] > 1000) {?>tag_1000<?php } elseif ($_smarty_tpl->tpl_vars['tag']->value['viewed'] > 500) {?>tag_500<?php } elseif ($_smarty_tpl->tpl_vars['tag']->value['viewed'] > 100) {?>tag_100<?php } elseif ($_smarty_tpl->tpl_vars['tag']->value['viewed'] > 10) {?>tag_10<?php } elseif ($_smarty_tpl->tpl_vars['tag']->value['viewed'] > 5) {?>tag_5<?php } elseif ($_smarty_tpl->tpl_vars['tag']->value['viewed'] > 1) {?>tag_1<?php } elseif ($_smarty_tpl->tpl_vars['tag']->value['viewed'] <= 0) {?>tag_0<?php }?> ybc-blog-tag-a" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tag']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tag']->value['tag'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a>                        
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
                <!-- Tags: 10000, 1000, 500, 100, 10, 5, 1, 0 -->
            </div>
    </div>
<?php }
}
}
