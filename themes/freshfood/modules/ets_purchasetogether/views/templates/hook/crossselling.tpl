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
{if isset($orderProducts) && count($orderProducts) > 0}
	<div class="crossseling-content">
		<h2>{l s='Customers who bought this product also bought:' mod='blockcart'}</h2>
		<div id="blockcart_list">
			<ul id="blockcart_caroucel">
				{foreach from=$orderProducts item='orderProduct' name=orderProduct}
					<li>
						<div class="product-image-container">
							<a href="{$orderProduct.link|escape:'html':'UTF-8'}" title="{$orderProduct.name|htmlspecialchars}" class="lnk_img">
								<img class="img-responsive" src="{$orderProduct.image|escape:'html':'UTF-8'}" alt="{$orderProduct.name|htmlspecialchars}" />
							</a>
						</div>
						<p class="product-name">
							<a href="{$orderProduct.link|escape:'html':'UTF-8'}" title="{$orderProduct.name|htmlspecialchars}">
								{$orderProduct.name|truncate:15:'...'|escape:'html':'UTF-8'}
							</a>
						</p>
						{if $orderProduct.show_price == 1 AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
							<span class="price_display">
								<span class="price">{convertPrice price=$orderProduct.displayed_price}</span>
							</span>
						{/if}
					</li>
				{/foreach}
			</ul>
		</div>
	</div>
{/if}