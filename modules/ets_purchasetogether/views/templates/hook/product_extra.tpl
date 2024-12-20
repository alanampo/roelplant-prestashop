{*
* 2007-2015 PrestaShop
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
*  @copyright  2007-2017 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div id="product-purchasetogether" data-id-shop="{$id_shop|intval}" class="{if isset($is17) && !$is17}panel product-tab{/if}" data-url-ajax="{$url_ajax|escape:'html':'UTF-8'}">
    <input name="submitted_tabs[]" value="PurchaseTogether" type="hidden" />
    {if isset($is17) && $is17}<input name="id_product" value="{$product->id|intval}" type="hidden" />{/if}
    <h3>{l s='Frequently purchased together' mod='ets_purchasetogether'}</h3>
    <div class="form-group">
		<label class="control-label col-lg-3" for="product_autocomplete_input_ets">
			<span class="label-tooltip" data-toggle="tooltip"
			title="{l s='You can indicate existing products as purchase for this product.' mod='ets_purchasetogether'}">
			{l s='Frequently purchased together products' mod='ets_purchasetogether'}
			</span>
		</label>
		<div class="col-lg-9">
			<input type="hidden" name="inputPurchaseTogether" id="inputPurchaseTogether" value="{if $purchase_togethers}{foreach from=$purchase_togethers item=purchase}{$purchase.id_product|intval}-{if $purchase.id_product_attribute|intval}{$purchase.id_product_attribute|intval}{else}0{/if},{/foreach}{/if}" />
			<div id="ajax_choose_product">
				<div class="input-group">
					<input type="text" id="product_autocomplete_input_ets" class="ac_input form-control autocomplete search m-b-1 ui-autocomplete-input" name="product_autocomplete_input_ets" autocomplete="off" />
					{if isset($is17) && !$is17}<span class="input-group-addon"><i class="icon-search"></i></span>{/if}
				</div>
                <div class="result-ets">
                    <ul class="item_ets"></ul>
                </div>
			</div>
			<div id="divPurchaseTogether">
			{if $purchase_togethers}
				{foreach from=$purchase_togethers item=purchase}
				<div class="form-control-static">
					<button type="button" class="btn btn-default delPurchaseTogether" data-id-product="{$purchase.id_product|intval}" data-id-product-attribute="{if $purchase.id_product_attribute}{$purchase.id_product_attribute|intval}{else}0{/if}" name="{$purchase.id_product|intval}">
						<span class="purchase_icon_close"></span>
					</button>
                    {if $purchase.image}<img src="{$purchase.image|escape:'html':'UTF-8'}" alt="{$purchase.name|escape:'html':'UTF-8'}" width="80px" height="auto" />{/if}
					<span class="productName">{$purchase.id_product|intval}-{$purchase.name|escape:'html':'UTF-8'}{if !empty($purchase.ref)}&nbsp;{l s='(ref: %s)' mod='ets_purchasetogether'  sprintf=$purchase.ref }{/if}</span>
				</div>
				{/foreach}
			{/if}
			</div>
		</div>
	</div>
</div>