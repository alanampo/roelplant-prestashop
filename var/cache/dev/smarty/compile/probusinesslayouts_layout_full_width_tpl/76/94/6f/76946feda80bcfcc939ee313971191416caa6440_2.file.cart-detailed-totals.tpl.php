<?php
/* Smarty version 4.3.4, created on 2024-12-12 15:19:14
  from '/home/roeluser1/public_html/tienda/themes/probusiness/templates/checkout/_partials/cart-detailed-totals.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b29224ffda6_42014447',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76946feda80bcfcc939ee313971191416caa6440' => 
    array (
      0 => '/home/roeluser1/public_html/tienda/themes/probusiness/templates/checkout/_partials/cart-detailed-totals.tpl',
      1 => 1733215291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:checkout/_partials/cart-voucher.tpl' => 1,
  ),
),false)) {
function content_675b29224ffda6_42014447 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="cart-detailed-totals">
  <?php if ((isset($_smarty_tpl->tpl_vars['cart']->value['subtotals']))) {?>
    <div class="card-block">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['subtotals'], 'subtotal');
$_smarty_tpl->tpl_vars['subtotal']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['subtotal']->value) {
$_smarty_tpl->tpl_vars['subtotal']->do_else = false;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['subtotal']->value['value'])) && $_smarty_tpl->tpl_vars['subtotal']->value['value'] && $_smarty_tpl->tpl_vars['subtotal']->value['type'] !== 'tax') {?>
          <div class="cart-summary-line" id="cart-subtotal-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['subtotal']->value['type'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
          <span class="label<?php if ('products' === $_smarty_tpl->tpl_vars['subtotal']->value['type']) {?> js-subtotal<?php }?>">
            <?php if ('products' == $_smarty_tpl->tpl_vars['subtotal']->value['type']) {?>
              <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['summary_string'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

            <?php } else { ?>
              <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['subtotal']->value['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

            <?php }?>
          </span>
            <span class="value"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['subtotal']->value['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
            <?php if ($_smarty_tpl->tpl_vars['subtotal']->value['type'] === 'shipping') {?>
              <div><small class="value"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCheckoutSubtotalDetails','subtotal'=>$_smarty_tpl->tpl_vars['subtotal']->value),$_smarty_tpl ) );?>
</small></div>
            <?php }?>
          </div>
        <?php }?>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
  <?php }?>

  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_604195686675b29224fb7b0_62096089', 'cart_voucher');
?>


  <hr>

  <div class="card-block">
    <?php if ((isset($_smarty_tpl->tpl_vars['cart']->value['totals']['total']))) {?>
      <div class="cart-summary-line cart-total">
        <span class="label"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['totals']['total']['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['labels']['tax_short'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
        <span class="value"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['totals']['total']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
      </div>
    <?php }?>
    <?php if ((isset($_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']))) {?>
      <div class="cart-summary-line">
        <small class="label"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</small>
        <small class="value"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</small>
      </div>
    <?php }?>
  </div>

  <hr>
</div>
<?php }
/* {block 'cart_voucher'} */
class Block_604195686675b29224fb7b0_62096089 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'cart_voucher' => 
  array (
    0 => 'Block_604195686675b29224fb7b0_62096089',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender('file:checkout/_partials/cart-voucher.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php
}
}
/* {/block 'cart_voucher'} */
}
