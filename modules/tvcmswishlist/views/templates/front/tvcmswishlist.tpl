{**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2022 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{strip}
<div id="wishlist_block" class="block account">
	<h4 class="title_block">
		<a href="{$link->getModuleLink('tvcmswishlist', 'mywishlist', array(), true)|addslashes|escape:'htmlall':'UTF-8'}" title="{l s='Mi Lista de Deseos' mod='tvcmswishlist'}" rel="nofollow">{l s='Wishlist' mod='tvcmswishlist'}</a>
	</h4>
	<div class="block_content">
		<div id="wishlist_block_list" class="expanded">
		{if $wishlist_products}
			<dl class="products">
			{foreach from=$wishlist_products item=product name=i}
				<dt class="{if $smarty.foreach.i.first}first_item{elseif $smarty.foreach.i.last}last_item{else}item{/if}">
					<span class="quantity-formated"><span class="quantity">{$product.quantity|intval|escape:'htmlall':'UTF-8'}</span>x</span>
					<a class="cart_block_product_name" href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category_rewrite) |escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">{$product.name|truncate:30:'...'|escape:'html':'UTF-8'}</a>
					<a class="ajax_cart_block_remove_link" href="javascript:;" onclick="javascript:WishlistCart('wishlist_block_list', 'delete', '{$product.id_product|escape:'htmlall':'UTF-8'}', {$product.id_product_attribute|escape:'htmlall':'UTF-8'}, '0', '{if isset($token)}{$token|escape:'htmlall':'UTF-8'}{/if}');" title="{l s='remove this product from my wishlist' mod='tvcmswishlist'}" rel="nofollow"><img src="{$img_dir|escape:'htmlall':'UTF-8'}icon/delete.gif" width="12" height="12" alt="{l s='Delete' mod='tvcmswishlist'}" class="icon" /></a>
				</dt>
				{if isset($product.attributes_small)}
				<dd class="{if $smarty.foreach.i.first}first_item{elseif $smarty.foreach.i.last}last_item{else}item{/if}">
					<a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='tvcmswishlist'}">{$product.attributes_small|escape:'html':'UTF-8'}</a>
				</dd>
				{/if}
			{/foreach}
			</dl>
		{else}
			<dl class="products">
				<dt>{l s='No products' mod='tvcmswishlist'}</dt>
			</dl>
		{/if}
		</div>
		<p class="lnk">
		{if $wishlists}
			<select name="wishlists" id="wishlists" onchange="WishlistChangeDefault('wishlist_block_list', $('#wishlists').val());">
			{foreach from=$wishlists item=wishlist name=i}
				<option value="{$wishlist.id_wishlist|escape:'htmlall':'UTF-8'}"{if $id_wishlist eq $wishlist.id_wishlist or ($id_wishlist == false and $smarty.foreach.i.first)} selected="selected"{/if}>{$wishlist.name|truncate:22:'...'|escape:'html':'UTF-8'}</option>
			{/foreach}
			</select>
		{/if}
			<a href="{$link->getModuleLink('tvcmswishlist', 'mywishlist', array(), true)|addslashes|escape:'htmlall':'UTF-8'}" title="{l s='Mi Lista de Deseos' mod='tvcmswishlist'}" rel="nofollow">&raquo; {l s='Mi Lista de Deseos' mod='tvcmswishlist'}</a>
		</p>
	</div>
</div>
{/strip}