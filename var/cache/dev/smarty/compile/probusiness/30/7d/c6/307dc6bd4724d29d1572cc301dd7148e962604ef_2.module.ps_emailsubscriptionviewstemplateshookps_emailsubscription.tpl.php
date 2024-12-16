<?php
/* Smarty version 4.3.4, created on 2024-12-12 17:56:29
  from 'module:ps_emailsubscriptionviewstemplateshookps_emailsubscription.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b4dfd1a5e65_62194072',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '307dc6bd4724d29d1572cc301dd7148e962604ef' => 
    array (
      0 => 'module:ps_emailsubscriptionviewstemplateshookps_emailsubscription.tpl',
      1 => 1733215291,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675b4dfd1a5e65_62194072 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/roeluser1/public_html/tienda/themes/probusiness/modules/ps_emailsubscription/views/templates/hook/ps_emailsubscription.tpl --><div class="block_newsletter col-xs-12 col-md-3 col-sm-3 links">

    <h3 class="myaccount-title hidden-sm-down">
        <a class="text-uppercase" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" rel="nofollow">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Newsletter','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

        </a>
      </h3>
  <div class="title clearfix hidden-md-up" data-target="#footer_newsletter" data-toggle="collapse">
    <span class="h3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Newsletter','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
    <span class="pull-xs-right">
      <span class="navbar-toggler collapse-icons">
        <i class="material-icons material-icons-add add"></i>
        <i class="material-icons material-icons-remove remove"></i>
      </span>
    </span>
  </div>
    <div id="footer_newsletter" class="collapse">
        <?php if ($_smarty_tpl->tpl_vars['conditions']->value) {?>
        <p><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['conditions']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>
      <?php }?>
      <form action="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['urls']->value['pages']['index'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
#footer" method="post">
        <div class="row">
          <div class="col-xs-12">
            <div class="submit_subscribe" data-title="\f003">
                <input class="btn btn-primary pull-xs-right hidden-xs-down" name="submitNewsletter" type="submit" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subscribe','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
" >
                <input class="btn btn-primary pull-xs-right hidden-sm-up" name="submitNewsletter" type="submit" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'OK','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
" >
            </div>
            <div class="input-wrapper">
              <input name="email" type="text" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter your email...','d'=>'Shop.Forms.Labels'),$_smarty_tpl ) );?>
" >
            </div>
            <input type="hidden" name="action" value="0" />
            <div class="clearfix"></div>
          </div>
          <div class="col-xs-12">
              <?php if ($_smarty_tpl->tpl_vars['msg']->value) {?>
                <p class="alert <?php if ($_smarty_tpl->tpl_vars['nw_error']->value) {?>alert-danger<?php } else { ?>alert-success<?php }?>">
                  <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['msg']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                </p>
              <?php }?>
          </div>
        </div>
      </form>
    </div>
</div>
<!-- end /home/roeluser1/public_html/tienda/themes/probusiness/modules/ps_emailsubscription/views/templates/hook/ps_emailsubscription.tpl --><?php }
}
