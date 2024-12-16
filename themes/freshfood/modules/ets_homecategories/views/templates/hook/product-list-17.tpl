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
{if isset($products) && $products}	
	<!-- Products list -->
	{if $wrapper}<div class="homecat_product_list_wrapper {if isset($class) && $class}hc-wrapper-{$class|escape:'html':'UTF-8'}{/if}"><div{if isset($id) && $id} id="{$id|escape:'html':'UTF-8'}"{/if} class="product_list products grid row{if isset($class) && $class} {$class|escape:'html':'UTF-8'}{/if}">{/if}
	{foreach from=$products item="product"}
          <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product|intval}" data-id-product-attribute="{$product.id_product_attribute|intval}" itemscope itemtype="http://schema.org/Product">
              <div class="thumbnail-container">
                <div class="image_item_product">
                    {block name='product_thumbnail'}
                      <a href="{$product.url|escape:'html':'UTF-8'}" class="thumbnail product-thumbnail">
                        <img src = "{$product.cover.bySize.home_default.url|escape:'html':'UTF-8'}" alt = "{$product.cover.legend|escape:'html':'UTF-8'}" data-full-size-image-url = "{$product.cover.large.url|escape:'html':'UTF-8'}" >
                      </a>
                    {/block}
                    {block name='product_variants'}
                        {if $product.main_variants}
                          {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
                        {/if}
                    {/block}
                </div>
                <div class="product-description">
                  {block name='product_name'}
                    <h3 class="h3 product-title" itemprop="name"><a href="{$product.url|escape:'html':'UTF-8'}">{$product.name|escape:'html':'UTF-8'|truncate:30:'...'}</a></h3>
                  {/block}
                  {if isset($product.description_short) && $product.description_short !=''}
                    <div class="short_description">{$product.description_short|truncate:100:'...' nofilter}</div>
                  {/if}
                  <div class="hook-reviews">
            	      {hook h='displayProductListReviews' product=$product}
            	  </div>
                  {block name='product_price_and_shipping'}
                    {if $product.show_price}
                      <div class="product-price-and-shipping">
                        {hook h='displayProductPriceBlock' product=$product type="before_price"}
                        {if $product.has_discount}
                          {hook h='displayProductPriceBlock' product=$product type="old_price"}
            
                          <span class="regular-price"> {$product.regular_price|escape:'html':'UTF-8'}</span>
                          {*if $product.discount_type === 'percentage'}
                            <span class="discount-percentage"> {$product.discount_percentage|escape:'html':'UTF-8'}</span>
                          {/if*}
                        {/if}
                        <span itemprop="price" class="price"> {$product.price|escape:'html':'UTF-8'}</span>
                        {hook h='displayProductPriceBlock' product=$product type='unit_price'}
                        {hook h='displayProductPriceBlock' product=$product type='weight'}
                      </div>
                    {/if}
                  {/block}
                  <div class="highlighted-informations">
                     <div class="add_to_cart_button atc_div">
                           <input name="qty" type="hidden" class="form-control atc_qty" value="1" onfocus="if(this.value == '1') this.value = '';" onblur="if(this.value == '') this.value = '1';"/>
                            <button class="add_to_cart btn btn-primary" onclick="mypresta_productListCart.add({literal}$(this){/literal});">
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                     </div>
                     {hook h='displayProductListFunctionalButtons' product=$product}
                      <a href="#" class="quick-view" data-link-action="quickview">
                        <i class="material-icons">zoom_in</i>
                      </a>
                    </div>
                </div>
                {block name='product_flags'}
                  <ul class="product-flags">
                    {foreach from=$product.flags item=flag}
                        {if $flag.type != 'discount'}
                          <li class="{$flag.type|escape:'html':'UTF-8'}">
                            <span> {$flag.label|escape:'html':'UTF-8'}</span>
                          </li>
                        {/if}
                    {/foreach}
                    {if $product.show_price}
                        {if $product.has_discount}
                          {if $product.discount_type === 'percentage'}
                            <li class="product-discount">
                                <span class="discount-percen"> {$product.discount_percentage|escape:'html':'UTF-8'}</span>
                            </li>
                          {/if}
                        {/if}
                    {/if}
                  </ul>
                {/block}
            
              </div>
            </article>
    {/foreach}
	{if $wrapper}</div>{if $ETS_HOMECAT_ENBLE_LOAD_MORE && count($products) >= (int)$ETS_HOMECAT_PER_PAGE}<div data-product-count="{count($products)|intval}" data-id-category="{$id_category|escape:'html':'UTF-8'}" class="homecat-load-more homecat-load-more-{$id_category|escape:'html':'UTF-8'}">{l s='Load more products' mod='ets_homecategories'}<i class="material-icons">&#xE315;</i></div>{/if}</div>{/if}
{else $wrapper}
    <div class="homecat_product_list_wrapper {if isset($class) && $class}hc-wrapper-{$class|escape:'html':'UTF-8'}{/if}">
        <div class="col-sm-12 col-xs-12"><div class="clearfix"></div><span class="alert alert-warning">{l s='No products available' mod='ets_homecategories'}</span></div>
    </div>     
{/if}