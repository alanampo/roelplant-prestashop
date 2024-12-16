{*
* 2007-2022 ETS-Soft
*
* NOTICE OF LICENSE
*
* This file is not open source! Each license that you purchased is only available for 1 wesite only.
* If you want to use this file on more websites (or projects), you need to purchase additional licenses. 
* You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
* 
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs, please contact us for extra customization service at an affordable price
*
*  @author ETS-Soft <etssoft.jsc@gmail.com>
*  @copyright  2007-2022 ETS-Soft
*  @license    Valid for 1 website (or project) for each purchase of license
*  International Registered Trademark & Property of ETS-Soft
*}
{if isset($purchase_together) && $purchase_together}
    <ul class="list-purchase">
    {foreach from=$purchase_together item=product}
        <li class="item-product-ajax">
            <div class="left-block-ets product-image-container layer_cart_img">
				<a class="product_img_link" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
					<img class="replace-2x img-responsive" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'medium_default')|escape:'html':'UTF-8'}" alt="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" title="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width|escape:'html':'UTF-8'}" height="{$homeSize.height|escape:'html':'UTF-8'}"{/if} itemprop="image" />
				</a>
            </div>
            <div class="right-block-ets layer_cart_product_info">
        		<h5 itemprop="name">
					<a class="product-name" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url" >
						{$product.name|truncate:45:'...'|escape:'html':'UTF-8'}
					</a>
				</h5>
                <span class="attribute-small">{if isset($product.attribute_small) && $product.attribute_small} {$product.attribute_small|escape:'html':'UTF-8'}{/if}</span>
                <div class="content_price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
	                 <span itemprop="price" class="price product-price">
						{hook h="displayProductPriceBlock" product=$product type="before_price"}
						{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
					</span>
					<meta itemprop="priceCurrency" content="{$currency->iso_code|escape:'html':'UTF-8'}" />
					{if $product.price_without_reduction > 0 && isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
						{hook h="displayProductPriceBlock" product=$product type="old_price"}
						<span class="old-price product-price">
							{displayWtPrice p=$product.price_without_reduction}
						</span>
						{if $product.specific_prices.reduction_type == 'percentage'}
							<span class="price-percent-reduction">-{($product.specific_prices.reduction * 100)|escape:'html':'UTF-8'}%</span>
						{/if}
					{/if}
					{hook h="displayProductPriceBlock" product=$product type="price"}
					{hook h="displayProductPriceBlock" product=$product type="unit_price"}
				</div>
                {if isset($product.errors) && $product.errors}
                    <ul class="errors-add-cart">
                        {foreach from=$product.errors item=error}
                            <li><span class="label label-danger"> {$error|escape:'html':'UTF-8'}</span></li>
                        {/foreach}
                    </ul>
                {*else}
                    <span class="label label-success">{l s='Product successfully added to your shopping cart.' mod="ets_purchasetogether"}</span>
                *}
                {/if}
            </div>
        </li>
    {/foreach}
    </ul>
{/if}