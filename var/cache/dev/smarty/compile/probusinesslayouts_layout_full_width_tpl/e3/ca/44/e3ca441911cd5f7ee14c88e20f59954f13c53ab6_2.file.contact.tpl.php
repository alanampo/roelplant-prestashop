<?php
/* Smarty version 4.3.4, created on 2024-12-12 16:13:57
  from '/home/roeluser1/public_html/tienda/themes/probusiness/templates/contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b35f5650143_09417035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3ca441911cd5f7ee14c88e20f59954f13c53ab6' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/themes/probusiness/templates/contact.tpl',
      1 => 1733215291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b35f5650143_09417035 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_348831833675b35f5640ae1_56065413', 'page_header_container');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_302322770675b35f56412f2_11683323', 'left_column');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1909488349675b35f5641b20_47709947', 'page_content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_header_container'} */
class Block_348831833675b35f5640ae1_56065413 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_header_container' => 
  array (
    0 => 'Block_348831833675b35f5640ae1_56065413',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_header_container'} */
/* {block 'left_column'} */
class Block_302322770675b35f56412f2_11683323 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'left_column' => 
  array (
    0 => 'Block_302322770675b35f56412f2_11683323',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div id="left-column" class="col-xs-12 col-sm-3">
    
  </div>
<?php
}
}
/* {/block 'left_column'} */
/* {block 'page_content'} */
class Block_1909488349675b35f5641b20_47709947 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_1909488349675b35f5641b20_47709947',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php if ((isset($_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_CONTACT_FORM_LAYOUT'])) && $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_CONTACT_FORM_LAYOUT'] == 'contactlayout1') {?>
      <div class="page_contact_layout1">
          <?php if ($_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'] && $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'] != '') {?>
            <div class="embe_map_contact">
                <?php echo $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'];?>

            </div>
          <?php }?>
          <div class="embe_map_contact col-xs-12 col-sm-6 pull-right">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"contactform"),$_smarty_tpl ) );?>

            </div>
            <div class="col-xs-12 col-sm-6 contact_info_content">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"ps_contactinfo",'hook'=>'displayLeftColumn'),$_smarty_tpl ) );?>

            </div>
      </div>
    <?php }?>
    
    
        <?php if ((isset($_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_CONTACT_FORM_LAYOUT'])) && $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_CONTACT_FORM_LAYOUT'] == 'contactlayout2') {?>
        <div class="page_contact_layout2">
          <?php if ($_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'] && $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'] != '') {?>
            <div class="row">
                <div class="embe_map_contact col-sm-6">
                    <?php echo $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'];?>

                </div>
                <div class="embe_map_contact col-sm-6">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"contactform"),$_smarty_tpl ) );?>

                </div>
                <div class="col-xs-12 col-sm-12 contact_info_content contact_layout_2">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"ps_contactinfo",'hook'=>'displayLeftColumn'),$_smarty_tpl ) );?>

                </div>
            </div>
          <?php } else { ?>
            
            <div class="embe_map_contact col-xs-12 col-sm-6 pull-right">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"contactform"),$_smarty_tpl ) );?>

            </div>
            <div class="col-xs-12 col-sm-6 contact_info_content">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"ps_contactinfo",'hook'=>'displayLeftColumn'),$_smarty_tpl ) );?>

            </div>
            
          <?php }?>
          
        </div> 
    <?php }?>
    
        <?php if ((isset($_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_CONTACT_FORM_LAYOUT'])) && $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_CONTACT_FORM_LAYOUT'] == 'contactlayout3') {?>
        <div class="page_contact_layout3">  
          <?php if ($_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'] && $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'] != '') {?>
              <div class="row"> 
                <div class="col-sm-6 col-md-4">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"ps_contactinfo",'hook'=>'displayLeftColumn'),$_smarty_tpl ) );?>

                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="embe_map_contact">
                        <?php echo $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_GOOGLE_MAP_EMBED_CODE'];?>

                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"contactform"),$_smarty_tpl ) );?>

                </div>
              </div> 
          <?php } else { ?>
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"ps_contactinfo",'hook'=>'displayLeftColumn'),$_smarty_tpl ) );?>

                </div>
                <div class="col-sm-6 col-md-6">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"contactform"),$_smarty_tpl ) );?>

                </div>
            </div>
          <?php }?>
        </div>
    <?php }
}
}
/* {/block 'page_content'} */
}
