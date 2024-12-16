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
{if isset($children) && $children}
    <ul class="homcat_tab_sub_categroies{if $sort_options} inline_sortby{/if}">
        {foreach from=$children item='category'}
            <li>
                <a class="homcat_tab_{$category.id_category|intval} {if !$ETS_HOMECAT_OPEN_CAT_BY_LINK}homecat_ajax_tab{if !$ETS_HOMECAT_TABS_GROUPED}_list{/if} homecat_ajax_tab_{if !$ETS_HOMECAT_TABS_GROUPED}list_{/if}{$category.id_category|intval}{/if} is_sub_cat homecat_tab_name" href="{$link->getCategoryLink($category.id_category)|escape:'html':'UTF-8'}" data-id-category="{$category.id_category|intval}">{$category.name|escape:'html'}</a>                
            </li>
        {/foreach}
    </ul>
{/if}