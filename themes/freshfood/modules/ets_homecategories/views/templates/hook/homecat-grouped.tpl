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
<!-- MODULE Home categories PRO -->
<div class="block products_block ets_home_categories clearfix col-xs-12 col-sm-12 homecat-tab-grouped {if $ETS_HOMECAT_LOADING_ENABLED}loading-enabled{else}loading-disabled{/if}">	
	{if $ETS_HOMECAT_ENBLE_ALL_PRODUCT_TAB || $ETS_HOMECAT_DISPLAY_SUB && $categories}
        <ul class="ets_homecat_category_list sang">
        {if $ETS_HOMECAT_ENBLE_ALL_PRODUCT_TAB}
            <li>
                <span data-id-category="all" class="{if !$ETS_HOMECAT_OPEN_CAT_BY_LINK}homecat_ajax_tab{/if} homecat_tab_name homcat_tab_all">{l s='All products' mod='ets_homecategories'}</span>
                {if $ETS_HOMECAT_DISPLAY_SUB}
                    {hook h='displaySubCategories' id_category=2}
                {/if}
            </li>
        {/if}
        {foreach from=$categories item='category'}
            <li><a class="{if !$ETS_HOMECAT_OPEN_CAT_BY_LINK}homecat_ajax_tab{/if} homecat_tab_name homcat_tab_{$category.id_category|intval}" href="{$link->getCategoryLink($category.id_category)|escape:'html':'UTF-8'}" data-id-category="{$category.id_category|intval}">{$category.name|escape:'html'}</a>
                {if $ETS_HOMECAT_DISPLAY_SUB}
                    {hook h='displaySubCategories' id_category=$category.id_category}
                {/if}
            </li>
        {/foreach}
        </ul>             
        {include file="./product-block-grouped.tpl"}
    {/if}
</div>
<script type="text/javascript">
    var homecat_ajax_link = '{$base_dir|escape:'html':'UTF-8'}';
    var ETS_HOMECAT_ENBLE_CAROUSEL = {$ETS_HOMECAT_ENBLE_CAROUSEL|intval};
    var ets_homecat_order_seed = {if isset($ets_homecat_order_seed)&&(int)$ets_homecat_order_seed>0&&(int)$ets_homecat_order_seed<=10000}{$ets_homecat_order_seed|intval}{else}1{/if};
</script>
<!-- /MODULE Home categories PRO -->
