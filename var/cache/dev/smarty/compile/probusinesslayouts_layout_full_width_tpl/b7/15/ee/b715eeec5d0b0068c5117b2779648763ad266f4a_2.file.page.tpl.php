<?php
/* Smarty version 4.3.4, created on 2024-12-12 17:47:58
  from '/home/roeluser1/public_html/tienda/themes/probusiness/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b4bfe7c3509_27470365',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b715eeec5d0b0068c5117b2779648763ad266f4a' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/themes/probusiness/templates/page.tpl',
      1 => 1733215291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b4bfe7c3509_27470365 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_176043784675b4bfe7c02a4_67963138', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_1962307441675b4bfe7c0c41_10440188 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_1267667095675b4bfe7c0767_70414672 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1962307441675b4bfe7c0c41_10440188', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_1923200571675b4bfe7c1ff1_47627288 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_1045084055675b4bfe7c2429_71432288 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_1075934314675b4bfe7c1d07_33199123 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1923200571675b4bfe7c1ff1_47627288', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1045084055675b4bfe7c2429_71432288', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_1732059862675b4bfe7c2d02_80591689 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_798807577675b4bfe7c2a73_29094259 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1732059862675b4bfe7c2d02_80591689', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_176043784675b4bfe7c02a4_67963138 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_176043784675b4bfe7c02a4_67963138',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_1267667095675b4bfe7c0767_70414672',
  ),
  'page_title' => 
  array (
    0 => 'Block_1962307441675b4bfe7c0c41_10440188',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_1075934314675b4bfe7c1d07_33199123',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_1923200571675b4bfe7c1ff1_47627288',
  ),
  'page_content' => 
  array (
    0 => 'Block_1045084055675b4bfe7c2429_71432288',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_798807577675b4bfe7c2a73_29094259',
  ),
  'page_footer' => 
  array (
    0 => 'Block_1732059862675b4bfe7c2d02_80591689',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <div id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1267667095675b4bfe7c0767_70414672', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1075934314675b4bfe7c1d07_33199123', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_798807577675b4bfe7c2a73_29094259', 'page_footer_container', $this->tplIndex);
?>


  </div>

<?php
}
}
/* {/block 'content'} */
}
