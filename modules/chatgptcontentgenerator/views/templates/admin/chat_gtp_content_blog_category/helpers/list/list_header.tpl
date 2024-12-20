{*
* 2007-2024 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2024 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{extends file="helpers/list/list_header.tpl"}

{block name=override_header}
	<ul class="breadcrumb cat_bar2">
		{assign var=i value=0}
		{foreach $categories_tree key=key item=category}
			<li>
				{if $i++ == 0}
					<i class="icon-home"></i>
				{/if}

				{if isset($category.id_gptcontent_blog_category)}
					{assign var=params_url value="&id_gptcontent_blog_category={$category.id_gptcontent_blog_category|intval}"}
				{else}
					{assign var=params_url value=""}
				{/if}
				{if isset($category.id_gptcontent_blog_category) && $category.id_gptcontent_blog_category == $categories_tree_current_id}
					{$category.name|escape:'html':'UTF-8'}
					<a href="{$current|escape:'html':'UTF-8'}{$params_url|escape:'html':'UTF-8'}&amp;token={$token|escape:'html':'UTF-8'}&amp;updategptcontent_blog_category"><i class="icon-pencil"></i></a>
				{else}
					<a href="{$current|escape:'html':'UTF-8'}{$params_url|escape:'html':'UTF-8'}&amp;token={$token|escape:'html':'UTF-8'}">{$category.name|escape:'html':'UTF-8'}</a>
				{/if}
			</li>
		{/foreach}
	</ul>
{/block}
