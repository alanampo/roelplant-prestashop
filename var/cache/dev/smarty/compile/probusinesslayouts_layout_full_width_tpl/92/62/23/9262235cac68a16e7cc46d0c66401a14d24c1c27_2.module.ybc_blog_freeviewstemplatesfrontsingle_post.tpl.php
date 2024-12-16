<?php
/* Smarty version 4.3.4, created on 2024-12-12 15:20:41
  from 'module:ybc_blog_freeviewstemplatesfrontsingle_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_675b2979ba09b3_80568308',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9262235cac68a16e7cc46d0c66401a14d24c1c27' => 
    array (
      0 => 'module:ybc_blog_freeviewstemplatesfrontsingle_post.tpl',
      1 => 1733214785,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/head.tpl' => 1,
    'file:catalog/_partials/product-activation.tpl' => 1,
    'file:_partials/header.tpl' => 1,
    'file:_partials/notifications.tpl' => 1,
    'file:_partials/breadcrumb.tpl' => 1,
    'file:_partials/footer.tpl' => 1,
    'file:_partials/javascript.tpl' => 1,
  ),
),false)) {
function content_675b2979ba09b3_80568308 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!-- begin /home/roeluser1/public_html/tienda/modules/ybc_blog_free/views/templates/front/single_post.tpl --><!doctype html>
<html lang="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">

  <head>
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
    <meta property="og:image"         content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_817944316675b2979b28921_21357744', 'head');
?>

  </head>

  <body id="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['page']->value['page_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'classnames' ][ 0 ], array( $_smarty_tpl->tpl_vars['page']->value['body_classes'] )), ENT_QUOTES, 'UTF-8');?>
">

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayAfterBodyOpeningTag'),$_smarty_tpl ) );?>


    <main>
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_623460883675b2979b2d541_38349986', 'product_activation');
?>

      <header id="header">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_270193234675b2979b2def8_18788874', 'header');
?>

      </header>
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1512351863675b2979b2e6c5_00162563', 'notifications');
?>

      <section id="wrapper">
        <div class="container">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1170974372675b2979b2ee47_60470570', 'breadcrumb');
?>

          <?php if ((isset($_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SIDEBAR_POSITION'])) && $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SIDEBAR_POSITION'] == 'left') {?>
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_220724895675b2979b30fa3_56655392', "left_column");
?>

          <?php }?>  
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1921955289675b2979b31c16_92666363', "content_wrapper");
?>

          <?php if ((isset($_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SIDEBAR_POSITION'])) && $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SIDEBAR_POSITION'] == 'right') {?>
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1341105550675b2979b9e3d6_92462589', "right_column");
?>

          <?php }?>
        </div>
      </section>

      <footer id="footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2028259227675b2979b9ef62_78042100', "footer");
?>

      </footer>

    </main>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_145692466675b2979b9f885_26548913', 'javascript_bottom');
?>


    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBeforeBodyClosingTag'),$_smarty_tpl ) );?>


  </body>

</html>
<!-- end /home/roeluser1/public_html/tienda/modules/ybc_blog_free/views/templates/front/single_post.tpl --><?php }
/* {block 'head'} */
class Block_817944316675b2979b28921_21357744 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_817944316675b2979b28921_21357744',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php $_smarty_tpl->_subTemplateRender('file:_partials/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php
}
}
/* {/block 'head'} */
/* {block 'product_activation'} */
class Block_623460883675b2979b2d541_38349986 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_activation' => 
  array (
    0 => 'Block_623460883675b2979b2d541_38349986',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-activation.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <?php
}
}
/* {/block 'product_activation'} */
/* {block 'header'} */
class Block_270193234675b2979b2def8_18788874 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header' => 
  array (
    0 => 'Block_270193234675b2979b2def8_18788874',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php $_smarty_tpl->_subTemplateRender('file:_partials/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php
}
}
/* {/block 'header'} */
/* {block 'notifications'} */
class Block_1512351863675b2979b2e6c5_00162563 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'notifications' => 
  array (
    0 => 'Block_1512351863675b2979b2e6c5_00162563',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender('file:_partials/notifications.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <?php
}
}
/* {/block 'notifications'} */
/* {block 'breadcrumb'} */
class Block_1170974372675b2979b2ee47_60470570 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'breadcrumb' => 
  array (
    0 => 'Block_1170974372675b2979b2ee47_60470570',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php $_smarty_tpl->_subTemplateRender('file:_partials/breadcrumb.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
          <?php
}
}
/* {/block 'breadcrumb'} */
/* {block "left_column"} */
class Block_220724895675b2979b30fa3_56655392 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'left_column' => 
  array (
    0 => 'Block_220724895675b2979b30fa3_56655392',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div id="left-column" class="col-xs-12 col-sm-4 col-md-3">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"blogSidebar"),$_smarty_tpl ) );?>

            </div>
          <?php
}
}
/* {/block "left_column"} */
/* {block "content"} */
class Block_1358687274675b2979b33687_01256195 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php if ((isset($_smarty_tpl->tpl_vars['blog_post']->value['enabled'])) && $_smarty_tpl->tpl_vars['blog_post']->value['enabled']) {?>
                <?php echo '<script'; ?>
 type="text/javascript">
                    ybc_blog_free_report_url = '<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
                    ybc_blog_free_report_warning = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do you want to report this comment?','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
';
                    ybc_blog_free_error = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There was a problem while submitting your report. Try again later','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
';
                <?php echo '</script'; ?>
>
                <div class="ybc_blog_free_layout_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_layout']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 ybc-blog-wrapper-detail" itemscope itemType="http://schema.org/BlogPosting">
                    <meta itemprop="author" content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['blog_post']->value['firstname']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['blog_post']->value['lastname']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/> 
                    <div itemprop="publisher" itemtype="http://schema.org/Organization" itemscope="" style="display: none;">
                        <meta itemprop="name" content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Configuration::get('PS_SHOP_NAME'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                        <?php if (Configuration::get('PS_LOGO')) {?>
                            <div itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
                                <meta itemprop="url" content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SHOP_URI'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
img/<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Configuration::get('PS_LOGO'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                <meta itemprop="width" content="200px" />
                                <meta itemprop="height" content="100px" />
                            </div>
                        <?php }?>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['blog_post']->value['image']) {?>
                        <div class="ybc_blog_free_img_wrapper" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                            <?php if ($_smarty_tpl->tpl_vars['enable_slideshow']->value) {?><a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="prettyPhoto"><?php }?>                            
                            <img title="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" itemprop="url" />
                            <meta itemprop="width" content="600px" />
                            <meta itemprop="height" content="300px" />
                            <?php if ($_smarty_tpl->tpl_vars['enable_slideshow']->value) {?></a><?php }?>
                        </div>                        
                     <?php }?>
                     <div class="ybc-blog-wrapper-content">
                    <?php if ($_smarty_tpl->tpl_vars['blog_post']->value) {?>
                        <h1 class="page-heading product-listing" itemprop="mainEntityOfPage"><span  class="title_cat" itemprop="headline"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span></h1>
                        <div class="post-details">
                            <div class="blog-extra">
                                <div class="ybc-blog-latest-toolbar">
                                    <?php if ($_smarty_tpl->tpl_vars['show_views']->value) {?>                  
                                        <span title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Page views','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
" class="ybc-blog-latest-toolbar-views">
                                            <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['click_number'] )), ENT_QUOTES, 'UTF-8');?>
 
                                            <?php if ($_smarty_tpl->tpl_vars['blog_post']->value['click_number'] != 1) {?>
                                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Views','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                            <?php } else { ?>
                                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                            <?php }?>
                                        </span>
                                    <?php }?> 
                                    <?php if ($_smarty_tpl->tpl_vars['allow_like']->value) {?>
                                        <span title="<?php if ($_smarty_tpl->tpl_vars['likedPost']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Liked','mod'=>'ybc_blog_free'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Like this post','mod'=>'ybc_blog_free'),$_smarty_tpl ) );
}?>" class="ybc-blog-like-span ybc-blog-like-span-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['id_post'] )), ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['likedPost']->value) {?>active<?php }?>"  data-id-post="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['id_post'] )), ENT_QUOTES, 'UTF-8');?>
">
                                            <span class="ben_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['id_post'] )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['likes'] )), ENT_QUOTES, 'UTF-8');?>
</span>
                                            <span class="blog-post-like-text blog-post-like-text-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['id_post'] )), ENT_QUOTES, 'UTF-8');?>
"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Liked','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span></span>
                                        </span>  
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['allow_rating']->value && $_smarty_tpl->tpl_vars['everage_rating']->value) {?>                      
                                        <div class="blog_rating_wrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">                            
                                            <?php if ($_smarty_tpl->tpl_vars['total_review']->value) {?>
                                                <span title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Comments','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
" class="blog_rating_reviews">
                                                     <span class="total_views" itemprop="reviewCount"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['total_review']->value )), ENT_QUOTES, 'UTF-8');?>
</span>
                                                     <span>
                                                        <?php if ($_smarty_tpl->tpl_vars['total_review']->value != 1) {?>
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reviews','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>

                                                        <?php } else { ?>
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Review','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>

                                                        <?php }?>
                                                    </span>
                                                </span>
                                            <?php }?>
                                            <div title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Everage rating','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
" class="ybc_blog_free_review">
                                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rating: ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['everage_rating']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['everage_rating']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                                    <div class="star star_on"></div>
                                                <?php }
}
?>
                                                <?php if ($_smarty_tpl->tpl_vars['everage_rating']->value < 5) {?>
                                                    <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - ($_smarty_tpl->tpl_vars['everage_rating']->value+1) : $_smarty_tpl->tpl_vars['everage_rating']->value+1-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['everage_rating']->value+1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                                        <div class="star"></div>
                                                    <?php }
}
?>
                                                <?php }?>
                                                <meta itemprop="worstRating" content="0"/>
                                                <span class="ybc-blog-rating-value"  itemprop="ratingValue"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( number_format((float)$_smarty_tpl->tpl_vars['everage_rating']->value,1,'.',''),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                                                <meta itemprop="bestRating" content="5"/>                                                
                                            </div>
                                        </div>
                                    <?php }?>  
                                    <?php if ($_smarty_tpl->tpl_vars['show_date']->value) {?>
                                        <?php if (!$_smarty_tpl->tpl_vars['date_format']->value) {
$_smarty_tpl->_assignInScope('date_format', 'F jS Y');
}?>
                                        <span class="post-date">
                                            <span class="be-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Posted on','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
: </span>
                                            <span><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( date($_smarty_tpl->tpl_vars['date_format']->value,strtotime($_smarty_tpl->tpl_vars['blog_post']->value['datetime_added'])),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                                            <meta itemprop="datePublished" content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( date('Y-m-d',strtotime($_smarty_tpl->tpl_vars['blog_post']->value['datetime_added'])),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                            <meta itemprop="dateModified" content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( date('Y-m-d',strtotime($_smarty_tpl->tpl_vars['blog_post']->value['datetime_modified'])),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                        </span>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['show_author']->value && ($_smarty_tpl->tpl_vars['blog_post']->value['firstname'] || $_smarty_tpl->tpl_vars['blog_post']->value['lastname'])) {?>
                                        <div class="author-block">
                                            <span class="post-author-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'By: ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                            <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_post']->value['author_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                                <span class="post-author-name">
                                                    <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['blog_post']->value['firstname']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['blog_post']->value['lastname']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                                </span>
                                            </a>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="ybc-blog-tags-social"> 
                                <?php if ($_smarty_tpl->tpl_vars['use_google_share']->value || $_smarty_tpl->tpl_vars['use_facebook_share']->value || $_smarty_tpl->tpl_vars['use_twitter_share']->value) {?>
                                    <div class="blog-extra-item blog-extra-facebook-share">
                                        <?php if ($_smarty_tpl->tpl_vars['use_facebook_share']->value) {?>
                                            <div class="ybc_blog_free_button_share">
                                                <div id="fb-root"></div>
                                                
                                                    <?php echo '<script'; ?>
>(function(d, s, id) {
                                                      var js, fjs = d.getElementsByTagName(s)[0];
                                                      if (d.getElementById(id)) return;
                                                      js = d.createElement(s); js.id = id;
                                                      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
                                                      fjs.parentNode.insertBefore(js, fjs);
                                                    }(document, 'script', 'facebook-jssdk'));<?php echo '</script'; ?>
>
                                                
                                                <div class="fb-like" data-image="" data-href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                                            </div>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['use_google_share']->value) {?>
                                            <div class="ybc_blog_free_button_share">
                                                <?php echo '<script'; ?>
 src="https://apis.google.com/js/platform.js" async defer><?php echo '</script'; ?>
>                   
                                                <div class="g-plusone" data-size="medium" data-href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"></div>
                                            </div>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['use_twitter_share']->value) {?>
                                            <div class="ybc_blog_free_button_share">
                                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tweet','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</a>
                                                
                                                    <?php echo '<script'; ?>
>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');<?php echo '</script'; ?>
>
                                                
                                            </div>
                                        <?php }?>
                                    </div>   
                                <?php }?>          
                            </div>               
                            </div>                           
                            <div class="blog_description">
                                <?php if ($_smarty_tpl->tpl_vars['blog_post']->value['description']) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['blog_post']->value['description'];?>

                                <?php } else { ?>
                                    <?php echo $_smarty_tpl->tpl_vars['blog_post']->value['short_description'];?>

                                <?php }?>
                            </div>
                            <?php if (($_smarty_tpl->tpl_vars['show_tags']->value && $_smarty_tpl->tpl_vars['blog_post']->value['tags']) || ($_smarty_tpl->tpl_vars['show_categories']->value && $_smarty_tpl->tpl_vars['blog_post']->value['categories'])) {?>
                            <div class="extra_tag_cat">
                                <?php if ($_smarty_tpl->tpl_vars['show_tags']->value && $_smarty_tpl->tpl_vars['blog_post']->value['tags']) {?>
                                    <div class="ybc-blog-tags">
                                        <?php $_smarty_tpl->_assignInScope('ik', 0);?>
                                        <?php $_smarty_tpl->_assignInScope('totalTag', count($_smarty_tpl->tpl_vars['blog_post']->value['tags']));?>
                                        <span class="be-label">
                                            <?php if ($_smarty_tpl->tpl_vars['totalTag']->value > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tags','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>

                                            <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tag','mod'=>'ybc_blog_free'),$_smarty_tpl ) );
}?>:
                                        </span>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blog_post']->value['tags'], 'tag');
$_smarty_tpl->tpl_vars['tag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->do_else = false;
?>
                                            <?php $_smarty_tpl->_assignInScope('ik', $_smarty_tpl->tpl_vars['ik']->value+1);?>                                        
                                            <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tag']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['tag']->value['tag']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a><?php if ($_smarty_tpl->tpl_vars['ik']->value < $_smarty_tpl->tpl_vars['totalTag']->value) {?>, <?php }?>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </div>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['show_categories']->value && $_smarty_tpl->tpl_vars['blog_post']->value['categories']) {?>
                                    <div class="ybc-blog-categories">
                                        <?php $_smarty_tpl->_assignInScope('ik', 0);?>
                                        <?php $_smarty_tpl->_assignInScope('totalCat', count($_smarty_tpl->tpl_vars['blog_post']->value['categories']));?>                        
                                        <div class="be-categories">
                                            <span class="be-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Posted in','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
: </span>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blog_post']->value['categories'], 'cat');
$_smarty_tpl->tpl_vars['cat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->do_else = false;
?>
                                                <?php $_smarty_tpl->_assignInScope('ik', $_smarty_tpl->tpl_vars['ik']->value+1);?>                                        
                                                <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cat']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['cat']->value['title']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a><?php if ($_smarty_tpl->tpl_vars['ik']->value < $_smarty_tpl->tpl_vars['totalCat']->value) {?>, <?php }?>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </div>
                                    </div>
                                <?php }?> 
                            </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['display_related_products']->value && $_smarty_tpl->tpl_vars['blog_post']->value['products']) {?>
                                <div id="ybc-blog-related-products" class="">
                                    <h4 class="title_blog">
                                        <?php if (count($_smarty_tpl->tpl_vars['blog_post']->value['products']) > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Related products ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>

                                        <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Related product','mod'=>'ybc_blog_free'),$_smarty_tpl ) );
}?>
                                    </h4>
                                    <div class="ybc-blog-related-products-wrapper ybc-blog-related-products-list">
                                        <ul class="blog-product-list product_list grid row ybc_related_products_type_<?php if ($_smarty_tpl->tpl_vars['blog_related_product_type']->value) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_related_product_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>default<?php }?>">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blog_post']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                <li class="ajax_block_product col-xs-12 col-sm-4">
                                                    <div class="product-container">
                                                        <div class="left-block">
                                                            <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><img src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['img_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" /></a>
                                                        </div>
                                                        <div class="right-block">
                                                            <h5><a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a></h5>
                                                            <?php if ($_smarty_tpl->tpl_vars['show_price']->value) {?>
                                                                <div class="blog-product-extra content_price">
                                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['price'] != $_smarty_tpl->tpl_vars['product']->value['old_price']) {?>
                                                                        <span class="bp-price-old old-price"><span class="bp-price-old-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Old price: ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span><span class="bp-price-old-display"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['old_price'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span></span>
                                                                    <?php }?>
                                                                    <span class="bp-price price product-price"><span class="bp-price-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price:  ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span><span class="bp-price-display"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['price'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span></span>
                                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['price'] != $_smarty_tpl->tpl_vars['product']->value['old_price']) {?>
                                                                        <span class="bp-percent price-percent-reduction"><span class="bp-percent-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discount: ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span><span class="bp-percent-display">-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['discount_percent'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span></span>
                                                                        <span class="bp-save"><span class="bp-save-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save up: ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span><span class="bp-save-display">-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['discount_amount'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span></span>
                                                                    <?php }?>
                                                                </div>
                                                            <?php }?>
                                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['short_description']) {?>
                                                                <div class="blog-product-desc">
                                                                    <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( strip_tags((string) $_smarty_tpl->tpl_vars['product']->value['short_description']),80,'...' )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                                                </div>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul>
                                    </div>
                                </div>
                            <?php }?>
                            <div class="ybc-blog-wrapper-comment">          
                                <?php if ($_smarty_tpl->tpl_vars['allowComments']->value) {?>
                                    <div class="ybc_comment_form_blog">
                                        <h4 class="title_blog"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Leave a comment','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</h4>
                                        <div class="ybc-blog-form-comment">                   
                                            <?php if ($_smarty_tpl->tpl_vars['hasLoggedIn']->value || $_smarty_tpl->tpl_vars['allowGuestsComments']->value) {?>
                                                <form action="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blogCommentAction']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                                    <?php if (!$_smarty_tpl->tpl_vars['hasLoggedIn']->value) {?> 
                                                        <div class="blog-comment-row blog-name">
                                                            <label for="bc-name"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</label>
                                                            <input class="form-control" name="name_customer" id="bc-name" type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['name_customer']->value))) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name_customer']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" />
                                                        </div>
                                                        <div class="blog-comment-row blog-email">
                                                            <label for="bc-email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</label>
                                                            <input class="form-control" name="email_customer" id="bc-email" type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['email_customer']->value))) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['email_customer']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" />
                                                        </div>
                                                    <?php }?>
                                                    <div class="blog-comment-row blog-title">
                                                        <label for="bc-subject"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subject ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</label>
                                                        <input class="form-control" name="subject" id="bc-subject" type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['subject']->value))) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['subject']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" />
                                                    </div>                                
                                                    <div class="blog-comment-row blog-content-comment">
                                                        <label for="bc-comment"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Comment ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</label>
                                                        <textarea   class="form-control" name="comment" id="bc-comment"><?php if ((isset($_smarty_tpl->tpl_vars['comment']->value))) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?></textarea>
                                                    </div>
                                                    <div class="blog-comment-row flex_space_between">
                                                    <?php if ($_smarty_tpl->tpl_vars['allow_rating']->value || $_smarty_tpl->tpl_vars['use_capcha']->value) {?>
                                                        <div class="blog-rate-capcha">
                                                            <?php if ($_smarty_tpl->tpl_vars['allow_rating']->value) {?>                            
                                                                <div class="blog-rate-post">
                                                                    <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rating: ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</label>
                                                                    <div class="blog_rating_box">
                                                                        <?php if ($_smarty_tpl->tpl_vars['default_rating']->value > 0 && $_smarty_tpl->tpl_vars['default_rating']->value < 5) {?>
                                                                            <input id="blog_rating" type="hidden" name="rating" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['default_rating']->value )), ENT_QUOTES, 'UTF-8');?>
" />
                                                                            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['default_rating']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['default_rating']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                                                                <div rel="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value )), ENT_QUOTES, 'UTF-8');?>
" class="star star_on blog_rating_star blog_rating_star_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value )), ENT_QUOTES, 'UTF-8');?>
"></div>
                                                                            <?php }
}
?>
                                                                            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - ($_smarty_tpl->tpl_vars['default_rating']->value+1) : $_smarty_tpl->tpl_vars['default_rating']->value+1-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['default_rating']->value+1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                                                                <div rel="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value )), ENT_QUOTES, 'UTF-8');?>
" class="star blog_rating_star blog_rating_star_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value )), ENT_QUOTES, 'UTF-8');?>
"></div>
                                                                            <?php }
}
?>
                                                                        <?php } else { ?>
                                                                            <input id="blog_rating" type="hidden" name="rating" value="5" />
                                                                            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                                                                <div rel="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value )), ENT_QUOTES, 'UTF-8');?>
" class="star star_on blog_rating_star blog_rating_star_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value )), ENT_QUOTES, 'UTF-8');?>
"></div>
                                                                            <?php }
}
?>
                                                                        <?php }?>
                                                                    </div>
                                                                </div>
                                                            <?php }?>
                                                            <?php if ($_smarty_tpl->tpl_vars['use_capcha']->value) {?>
                                                                <div class="blog-capcha">
                                                                    <label for="bc-capcha"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Security code: ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</label>
                                                                    <span class="bc-capcha-wrapper">
                                                                        <img rel="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_random_code']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" id="ybc-blog-capcha-img" src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['capcha_image']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                                                        
                                                                        <input class="form-control" name="capcha_code" type="text" id="bc-capcha" value="" />
                                                                        <span id="ybc-blog-capcha-refesh" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refresh code','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
"></span>
                                                                    </span>
                                                                </div>
                                                            <?php }?>
                                                        </div>
                                                    <?php }?>
                                                    <div class="blog-submit">
                                                        <input class="button" type="submit" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Submit Comment','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
" name="bcsubmit" />
                                                    </div>       
                                                    </div>                
                                                    <?php if ($_smarty_tpl->tpl_vars['blog_errors']->value && is_array($_smarty_tpl->tpl_vars['blog_errors']->value)) {?>
                                                        <ul class="alert alert-danger ybc_alert-danger">
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blog_errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
                                                                <li><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['error']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</li>
                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        </ul>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['blog_success']->value) {?>
                                                        <p class="alert alert-success ybc_alert-success"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_success']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>
                                                    <?php }?>
                                                </form>
                                            <?php } else { ?>
                                                <p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in to post comments','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</p>
                                            <?php }?>
                                        </div> 
                                    </div>
                                    <?php if (count($_smarty_tpl->tpl_vars['comments']->value)) {?>
                                        <div class="ybc_blog_free-comments-list">
                                        <h4 class="title_blog">
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Comments ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>

                                            </h4>
                                        <ul class="blog-comments-list">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comments']->value, 'comment');
$_smarty_tpl->tpl_vars['comment']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['comment']->value) {
$_smarty_tpl->tpl_vars['comment']->do_else = false;
?>
                                                
                                                    <li class="blog-comment-line"  itemprop="review" itemscope="" itemtype="http://schema.org/Review">
                                                    <meta itemprop="author" content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['comment']->value['name']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/>                                                                
                                                    <div class="ybc-blog-detail-comment">
                                                        <h5 class="comment-subject"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value['subject'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h5>
                                                        <?php if ($_smarty_tpl->tpl_vars['comment']->value['name']) {?><span class="comment-by"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'By : ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
<b><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['comment']->value['name']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</b></span><?php }?>
                                                        <span class="comment-time"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'On','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
 </span><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( date($_smarty_tpl->tpl_vars['date_format']->value,strtotime($_smarty_tpl->tpl_vars['comment']->value['datetime_added'])),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                                                        <?php if ($_smarty_tpl->tpl_vars['allow_rating']->value && $_smarty_tpl->tpl_vars['comment']->value['rating'] > 0) {?>
                                                            <div class="comment-rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                                                <meta itemprop="worstRating" content="0"/>
                                                                <meta itemprop="ratingValue" content="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( number_format((float)$_smarty_tpl->tpl_vars['comment']->value['rating'],1,'.',''),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/>
                                                                <meta itemprop="bestRating" content="5"/>
                                                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rating: ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                                                <div class="ybc_blog_free_review">
                                                                    <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['comment']->value['rating']+1 - (1) : 1-($_smarty_tpl->tpl_vars['comment']->value['rating'])+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                                                        <div class="star star_on"></div>
                                                                    <?php }
}
?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['comment']->value['rating'] < 5) {?>
                                                                        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - ($_smarty_tpl->tpl_vars['comment']->value['rating']+1) : $_smarty_tpl->tpl_vars['comment']->value['rating']+1-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['comment']->value['rating']+1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                                                            <div class="star"></div>
                                                                        <?php }
}
?>
                                                                    <?php }?> 
                                                                    <span class="ybc-blog-everage-rating"> <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( number_format((float)$_smarty_tpl->tpl_vars['comment']->value['rating'],1,'.',''),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>                                     
                                                                </div>
                                                            </div>
                                                        <?php }?> 
                                                        <?php if ($_smarty_tpl->tpl_vars['allow_report_comment']->value) {?>
                                                            <?php if (!($_smarty_tpl->tpl_vars['reportedComments']->value && is_array($_smarty_tpl->tpl_vars['reportedComments']->value) && in_array($_smarty_tpl->tpl_vars['comment']->value['id_comment'],$_smarty_tpl->tpl_vars['reportedComments']->value))) {?>
                                                                <span class="ybc-block-comment-report comment-report-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value['id_comment'] )), ENT_QUOTES, 'UTF-8');?>
" rel="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value['id_comment'] )), ENT_QUOTES, 'UTF-8');?>
"><i class="fa fa-bolt" aria-hidden="true" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Report this comment as abuse','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
"></i></span>
                                                            <?php }?>
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['comment']->value['comment']) {?><p class="comment-content"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value['comment'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p><?php }?>
                                                        
                                                        <?php if ($_smarty_tpl->tpl_vars['comment']->value['reply']) {?><p class="comment-reply">
                                                            <?php if ($_smarty_tpl->tpl_vars['comment']->value['elastname'] || $_smarty_tpl->tpl_vars['comment']->value['efirstname']) {?>
                                                                <span class="ybc-blog-replied-by">
                                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Replied by : ','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>

                                                                    <span class="ybc-blog-replied-by-name">
                                                                        <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['comment']->value['efirstname']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['comment']->value['elastname']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                                                    </span>
                                                                </span>
                                                            <?php }?>
                                                            <span class="ybc-blog-reply-content">
                                                                <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment']->value['reply'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                                            </span></p>
                                                        <?php }?>
                                                    </div>
                                                    </li>
                                                
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul> 
                                        </div>                 
                                    <?php }?>
                                <?php }?>
                            </div>            
                        </div>
                        <?php } else { ?>
                            <p class="warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No posts found','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</p>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['blog_post']->value['related_posts']) {?>
                            <div class="ybc-blog-related-posts ybc_blog_free_related_posts_type_<?php if ($_smarty_tpl->tpl_vars['blog_related_posts_type']->value) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog_related_posts_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>default<?php }?>">
                                <h4 class="title_blog"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Related posts','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</h4>
                                <div class="ybc-blog-related-posts-wrapper">
                                    <ul class="ybc-blog-related-posts-list">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blog_post']->value['related_posts'], 'rpost');
$_smarty_tpl->tpl_vars['rpost']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rpost']->value) {
$_smarty_tpl->tpl_vars['rpost']->do_else = false;
?>                                            
                                            <li class="ybc-blog-related-posts-list-li thumbnail-container">
                                                <?php if ($_smarty_tpl->tpl_vars['rpost']->value['thumb']) {?>
                                                    <a class="ybc_item_img" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                                        <img src="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['thumb'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                                    </a>                                                    
                                                <?php }?>
                                                <a class="ybc_title_block" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a>
                                                <div class="ybc-blog-sidear-post-meta">
                                                    <?php if ($_smarty_tpl->tpl_vars['rpost']->value['categories']) {?>
                                                        <?php $_smarty_tpl->_assignInScope('ik', 0);?>
                                                        <?php $_smarty_tpl->_assignInScope('totalCat', count($_smarty_tpl->tpl_vars['rpost']->value['categories']));?>                        
                                                        <div class="ybc-blog-categories">
                                                            <span class="be-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Posted in','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
: </span>
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rpost']->value['categories'], 'cat');
$_smarty_tpl->tpl_vars['cat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->do_else = false;
?>
                                                                <?php $_smarty_tpl->_assignInScope('ik', $_smarty_tpl->tpl_vars['ik']->value+1);?>                                        
                                                                <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cat']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ucfirst($_smarty_tpl->tpl_vars['cat']->value['title']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a><?php if ($_smarty_tpl->tpl_vars['ik']->value < $_smarty_tpl->tpl_vars['totalCat']->value) {?>, <?php }?>
                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        </div>
                                                    <?php }?>
                                                    <span class="post-date"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( date($_smarty_tpl->tpl_vars['date_format']->value,strtotime($_smarty_tpl->tpl_vars['rpost']->value['datetime_added'])),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                                                </div>
                                                <?php if ($_smarty_tpl->tpl_vars['allowComments']->value || $_smarty_tpl->tpl_vars['show_views']->value || $_smarty_tpl->tpl_vars['allow_like']->value) {?>
                                                    <div class="ybc-blog-latest-toolbar">                                         
                                                        <?php if ($_smarty_tpl->tpl_vars['show_views']->value) {?>
                                                            <span class="ybc-blog-latest-toolbar-views">
                                                                <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['click_number'] )), ENT_QUOTES, 'UTF-8');?>

                                                                <?php if ($_smarty_tpl->tpl_vars['rpost']->value['click_number'] != 1) {?>
                                                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'views','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                                                <?php } else { ?>
                                                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'view','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                                                <?php }?>
                                                            </span> 
                                                        <?php }?>                       
                                                        <?php if ($_smarty_tpl->tpl_vars['allow_like']->value) {?>
                                                            <span class="ybc-blog-like-span ybc-blog-like-span-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['id_post'] )), ENT_QUOTES, 'UTF-8');?>
 <?php if ((isset($_smarty_tpl->tpl_vars['rpost']->value['liked'])) && $_smarty_tpl->tpl_vars['rpost']->value['liked']) {?>active<?php }?>"  data-id-post="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['id_post'] )), ENT_QUOTES, 'UTF-8');?>
">                        
                                                                <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['likes'] )), ENT_QUOTES, 'UTF-8');?>

                                                                <span class="blog-post-like-text blog-post-like-text-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['id_post'] )), ENT_QUOTES, 'UTF-8');?>
">
                                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Liked','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>

                                                                </span>
                                                            </span>  
                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->tpl_vars['allowComments']->value) {?>
                                                            <span class="ybc-blog-latest-toolbar-comments"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['rpost']->value['comments_num'] )), ENT_QUOTES, 'UTF-8');?>

                                                                <?php if ($_smarty_tpl->tpl_vars['rpost']->value['comments_num'] != 1) {?>
                                                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'comments','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                                                <?php } else { ?>
                                                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'comment','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</span>
                                                                <?php }?>
                                                            </span> 
                                                        <?php }?>
                                                    </div>
                                                <?php }?> 
                                                <?php if ($_smarty_tpl->tpl_vars['rpost']->value['short_description']) {?>
                                                    <div class="blog_description"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( strip_tags((string) $_smarty_tpl->tpl_vars['rpost']->value['short_description']),120,'...' )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['rpost']->value['description']) {?>
                                                    <div class="blog_description"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( strip_tags((string) $_smarty_tpl->tpl_vars['rpost']->value['description']),120,'...' )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                                                <?php }?>
                                                    
                                            </li>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                        
                                    </ul>
                                </div>
                            </div>
                        <?php }?>
                    </div>        
                </div>
                <?php } else { ?>
                    <p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This blog post is not available','mod'=>'ybc_blog_free'),$_smarty_tpl ) );?>
</p>
                <?php }?>
              <?php
}
}
/* {/block "content"} */
/* {block "content_wrapper"} */
class Block_1921955289675b2979b31c16_92666363 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content_wrapper' => 
  array (
    0 => 'Block_1921955289675b2979b31c16_92666363',
  ),
  'content' => 
  array (
    0 => 'Block_1358687274675b2979b33687_01256195',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div id="content-wrapper" class="<?php if ((isset($_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SIDEBAR_POSITION'])) && $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SIDEBAR_POSITION'] == 'left') {?>left-column col-xs-12 col-sm-8 col-md-9<?php } elseif ((isset($_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SIDEBAR_POSITION'])) && $_smarty_tpl->tpl_vars['blog_config']->value['YBC_BLOG_FREE_SIDEBAR_POSITION'] == 'right') {?>right-column col-xs-12 col-sm-8 col-md-9<?php }?>">
              <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1358687274675b2979b33687_01256195', "content", $this->tplIndex);
?>

            </div>
          <?php
}
}
/* {/block "content_wrapper"} */
/* {block "right_column"} */
class Block_1341105550675b2979b9e3d6_92462589 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'right_column' => 
  array (
    0 => 'Block_1341105550675b2979b9e3d6_92462589',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div id="right-column" class="col-xs-12 col-sm-4 col-md-3">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"blogSidebar"),$_smarty_tpl ) );?>

            </div>
          <?php
}
}
/* {/block "right_column"} */
/* {block "footer"} */
class Block_2028259227675b2979b9ef62_78042100 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_2028259227675b2979b9ef62_78042100',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php $_smarty_tpl->_subTemplateRender("file:_partials/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php
}
}
/* {/block "footer"} */
/* {block 'javascript_bottom'} */
class Block_145692466675b2979b9f885_26548913 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'javascript_bottom' => 
  array (
    0 => 'Block_145692466675b2979b9f885_26548913',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php $_smarty_tpl->_subTemplateRender("file:_partials/javascript.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('javascript'=>$_smarty_tpl->tpl_vars['javascript']->value['bottom']), 0, false);
?>
    <?php
}
}
/* {/block 'javascript_bottom'} */
}
