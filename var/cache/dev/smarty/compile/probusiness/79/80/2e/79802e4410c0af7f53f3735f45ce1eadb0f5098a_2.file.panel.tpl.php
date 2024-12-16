<?php
/* Smarty version 4.3.4, created on 2024-12-12 17:56:29
  from '/home/roeluser1/public_html/tienda/themes/probusiness/modules/ybc_themeconfig/views/templates/hook/panel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b4dfd23e8b1_73332310',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '79802e4410c0af7f53f3735f45ce1eadb0f5098a' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/themes/probusiness/modules/ybc_themeconfig/views/templates/hook/panel.tpl',
      1 => 1733215291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b4dfd23e8b1_73332310 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['tc_display_panel']->value) {?>
<div class="ybc-theme-panel closed">
    <div class="ybc-theme-panel-medium">
        <div class="ybc-theme-panel-btn" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Theme Option','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
"></div>
        <div class="ybc-theme-panel-loading">
            <div class="ybc-theme-panel-loading-setting">
                <h2>
                    <img alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Loading','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
" class="ybc-theme-panel-loading-logo" src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tc_modules_dir']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
img/loading.gif" />
                    <br/>
                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Updating...','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</span>
                </h2>
            </div>
        </div>
        <div class="ybc-theme-panel-wrapper">
            <h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Theme options','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</h2>
            <div class="ybc-theme-panel-box tc-separator"><h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Theme color','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</h3></div>
            <div class="ybc-theme-panel-inner">
                <div class="ybc-theme-panel-box">                    
                    <ul class="ybc-skin ybc_tc_skin ybc_select_option" id="ybc_tc_skin">
                        <?php if ($_smarty_tpl->tpl_vars['skins']->value) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['skins']->value, 'skin');
$_smarty_tpl->tpl_vars['skin']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['skin']->value) {
$_smarty_tpl->tpl_vars['skin']->do_else = false;
?>
                                <li style="background: <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['skin']->value['main_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;" <?php if ($_smarty_tpl->tpl_vars['configs']->value['YBC_TC_SKIN'] == $_smarty_tpl->tpl_vars['skin']->value['id_option']) {?>class="active"<?php }?> data-val="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['skin']->value['id_option'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['skin']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['skin']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                    </ul>
                </div>
                <?php if ((isset($_smarty_tpl->tpl_vars['ybcDev']->value)) && $_smarty_tpl->tpl_vars['ybcDev']->value) {?>  
                    <div class="ybc-theme-panel-box tc-separator">
                        <h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Layout type','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</h3></div>
                    <div class="ybc-theme-panel-box">                    
                        <ul id="ybc_tc_layout" class="ybc_tc_layout ybc_select_option">
                            <?php if ($_smarty_tpl->tpl_vars['layouts']->value) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['layouts']->value, 'layout');
$_smarty_tpl->tpl_vars['layout']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->do_else = false;
?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['configs']->value['YBC_TC_LAYOUT'] == $_smarty_tpl->tpl_vars['layout']->value['id_option']) {?>class="active"<?php }?> data-val="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layout']->value['id_option'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layout']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</li>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php }?>
                        </ul>
                    </div>
                <?php }?>
                <?php if ((isset($_smarty_tpl->tpl_vars['float_header']->value)) && $_smarty_tpl->tpl_vars['float_header']->value) {?>
                    <div class="ybc-theme-panel-box tc-separator"><h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Float header','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</h3></div>
                    <div class="ybc-theme-panel-box">                    
                        <ul id="ybc_tc_float_header" class="ybc_tc_float_header ybc_select_option">
                            <li <?php if ($_smarty_tpl->tpl_vars['configs']->value['YBC_TC_FLOAT_HEADER']) {?>class="active"<?php }?> data-val="1"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</li>
                            <li <?php if (!$_smarty_tpl->tpl_vars['configs']->value['YBC_TC_FLOAT_HEADER']) {?>class="active"<?php }?> data-val="0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</li>
                        </ul>
                    </div>
                <?php }?>
                <?php if ((isset($_smarty_tpl->tpl_vars['bgs']->value)) && $_smarty_tpl->tpl_vars['bgs']->value) {?>              
                    <div class="ybc-theme-panel-box tc-separator"><h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Background image','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</h3></div>
                    <div class="ybc-theme-panel-box tc-ul">
                        <?php if ($_smarty_tpl->tpl_vars['bgs']->value) {?>
                            <ul class="ybc-theme-panel-bg-list">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bgs']->value, 'bg');
$_smarty_tpl->tpl_vars['bg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bg']->value) {
$_smarty_tpl->tpl_vars['bg']->do_else = false;
?>
                                    <li><span rel='<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['bg']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
' class="ybc-theme-panel-bg<?php if ($_smarty_tpl->tpl_vars['configs']->value['YBC_TC_BG_IMG'] == $_smarty_tpl->tpl_vars['bg']->value) {?> active<?php }?>" style="background: url('<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['moduleDirl']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
bgs/<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['bg']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
.png');"></span></li>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                        <?php }?>
                    </div>
                <?php }?>
                <div class="ybc-theme-panel-box tc-reset">
                    <span id="tc-reset"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reset to default','mod'=>'ybc_themeconfig'),$_smarty_tpl ) );?>
</span>
                </div>
            </div>        
        </div>       
    </div>
</div>
<?php }
echo '<script'; ?>
 type="text/javascript">
    var YBC_TC_FLOAT_CSS3 = <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['YBC_TC_FLOAT_CSS3']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
    var YBC_TC_AJAX_URL = '<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['moduleDirl']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
ajax.php';
<?php echo '</script'; ?>
><?php }
}
