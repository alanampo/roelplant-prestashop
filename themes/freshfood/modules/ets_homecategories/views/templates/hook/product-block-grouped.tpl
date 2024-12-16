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
{if $sort_options}
    <form action="{$base_dir|escape:'html':'UTF-8'}" method="post">
        <label for="homecat_sort_by">{l s='Sort by' mod='ets_homecategories'}</label>
        <select name="homecat_sort_by" id="homecat_sort_by" class="homecat_sort_by">
            {foreach from=$sort_options item='option'}
                <option {if $sort_by==$option.id_option}selected="selected"{/if} value="{$option.id_option|escape:'html':'UTF-8'}">{$option.name|escape:'html':'UTF-8'}</option>
            {/foreach}
        </select>
    </form>
{/if}        
<div class="homecat_tabs {if $ETS_HOMECAT_ENBLE_CAROUSEL}homecat_tab_carousel_enabled{else}homecat_tab_type_list{/if} {if !$ETS_HOMECAT_DISPLAY_SUB && !$sort_options}no_subcat_sort{/if}">
    
    
    {if $ETS_HOMECAT_ENBLE_ALL_PRODUCT_TAB}
        {hook h='displayProductList' id_category=false wrapper=true}
    {/if}
    {if !$ETS_HOMECAT_ENBLE_ALL_PRODUCT_TAB || $categories &&(!$ETS_HOMECAT_ENBLE_ALL_PRODUCT_TAB || !$ETS_HOMECAT_INITIATE_FIRST_TAB_ONLY || !$ETS_HOMECAT_TABS_GROUPED)}
        {assign var='ik' value=0}
        {foreach from=$categories item='category'}
            {assign var='ik' value=$ik+1}                  
            {if !$ETS_HOMECAT_INITIATE_FIRST_TAB_ONLY || !$ETS_HOMECAT_ENBLE_ALL_PRODUCT_TAB && $ik==1 || !$ETS_HOMECAT_TABS_GROUPED}
                {hook h='displayProductList' id_category=$category.id_category wrapper=true}
            {/if}
        {/foreach}
    {/if}
    {if $ETS_HOMECAT_LOADING_ENABLED}
        <div class="sk-fading-circle">
          <div class="sk-circle1 sk-circle"></div>
          <div class="sk-circle2 sk-circle"></div>
          <div class="sk-circle3 sk-circle"></div>
          <div class="sk-circle4 sk-circle"></div>
          <div class="sk-circle5 sk-circle"></div>
          <div class="sk-circle6 sk-circle"></div>
          <div class="sk-circle7 sk-circle"></div>
          <div class="sk-circle8 sk-circle"></div>
          <div class="sk-circle9 sk-circle"></div>
          <div class="sk-circle10 sk-circle"></div>
          <div class="sk-circle11 sk-circle"></div>
          <div class="sk-circle12 sk-circle"></div>
        </div>
    {/if}
</div>