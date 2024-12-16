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
{if $ETS_HOMECAT_DISPLAY_CATEGORY_BANNER=='inline'}
    {assign var = 'thumb_cat' value=$urls.img_cat_url|cat:$category->id_category|cat:'_thumb.jpg'}
    {assign var = 'thumb_cat_dir' value='img/c/'|cat:$category->id_category|cat:'_thumb.jpg'}
    {if file_exists($thumb_cat_dir)}
        <div class="banner_inline col-xs-12 col-sm-6 col-md-3">
            <a class="homecat_image" href="{$link->getCategoryLink($category->id)|escape:'html':'UTF-8'}">
                <img src="{$urls.img_cat_url|escape:'html':'UTF-8'} {$category->id_category|escape:'html':'UTF-8'}_thumb.jpg" alt="{$category->name|escape:'html':'UTF-8'}"/>
            </a>
        </div>
    {else}
        <div class="banner_inline col-xs-12 col-sm-6 col-md-3">
            <a class="homecat_image" href="{$link->getCategoryLink($category->id)|escape:'html':'UTF-8'}">
                <img src="{$urls.img_ps_url|escape:'html':'UTF-8'}tmp/category_{$category->id_category|escape:'html':'UTF-8'}-thumb.jpg" alt="{$category->name|escape:'html':'UTF-8'}"/>
            </a>
        </div>
    {/if}
{else if $ETS_HOMECAT_DISPLAY_CATEGORY_BANNER=='below'}
    <a class="homecat_image homecat_image_below" href="{$link->getCategoryLink($category->id)|escape:'html':'UTF-8'}">
        <img src="{$link->getCatImageLink($category->link_rewrite, $category->id_image, false)|escape:'html':'UTF-8'}" alt="{$category->name|escape:'html':'UTF-8'}"/>
    </a>
{else}
    <a class="homecat_image homecat_image_above" href="{$link->getCategoryLink($category->id)|escape:'html':'UTF-8'}">
        <img src="{$link->getCatImageLink($category->link_rewrite, $category->id_image, false)|escape:'html':'UTF-8'}" alt="{$category->name|escape:'html':'UTF-8'}"/>
    </a>
{/if}
