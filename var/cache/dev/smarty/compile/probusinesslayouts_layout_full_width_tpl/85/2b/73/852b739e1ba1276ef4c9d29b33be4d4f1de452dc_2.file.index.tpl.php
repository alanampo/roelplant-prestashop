<?php
/* Smarty version 4.3.4, created on 2024-12-12 17:47:52
  from '/home/roeluser1/public_html/tienda/themes/probusiness/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b4bf8742637_96681669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '852b739e1ba1276ef4c9d29b33be4d4f1de452dc' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/themes/probusiness/templates/index.tpl',
      1 => 1733215291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b4bf8742637_96681669 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_729501184675b4bf8740c29_54689152', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_1998140138675b4bf8741095_00123599 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_1509469445675b4bf8741973_60777349 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_420597665675b4bf8741699_56349912 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1509469445675b4bf8741973_60777349', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_729501184675b4bf8740c29_54689152 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_729501184675b4bf8740c29_54689152',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_1998140138675b4bf8741095_00123599',
  ),
  'page_content' => 
  array (
    0 => 'Block_420597665675b4bf8741699_56349912',
  ),
  'hook_home' => 
  array (
    0 => 'Block_1509469445675b4bf8741973_60777349',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1998140138675b4bf8741095_00123599', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_420597665675b4bf8741699_56349912', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
}
