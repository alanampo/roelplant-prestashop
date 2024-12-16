{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}

 {function name="blogCategories" nodes=[] depth=0}
  {strip}
    {if $nodes|count}
      <ul class="blog-category-sub-menu">
        {foreach from=$nodes item=node}
          <li data-depth="{$depth|intval}">
            {if $depth===0}
              <a href="{$node.link|escape:'html':'UTF-8'}">{$node.name|escape:'html':'UTF-8'}</a>
              {if $node.children}
                <div class="navbar-toggler collapse-icons" data-toggle="collapse" data-target="#exBlogCatCollapsingNavbar{$node.id|intval}">
                  <i class="material-icons add">&#xE145;</i>
                  <i class="material-icons remove">&#xE15B;</i>
                </div>
                <div class="collapse" id="exBlogCatCollapsingNavbar{$node.id|intval}">
                  {blogCategories nodes=$node.children depth=$depth+1}
                </div>
              {/if}
            {else}
              <a class="blog-category-sub-link" href="{$node.link|escape:'html':'UTF-8'}">{$node.name|escape:'html':'UTF-8'}</a>
              {if $node.children}
                <span class="arrows" data-toggle="collapse" data-target="#exBlogCatCollapsingNavbar{$node.id|intval}">
                  <i class="material-icons arrow-right">&#xE315;</i>
                  <i class="material-icons arrow-down">&#xE313;</i>
                </span>
                <div class="collapse" id="exBlogCatCollapsingNavbar{$node.id|intval}">
                  {blogCategories nodes=$node.children depth=$depth+1}
                </div>
              {/if}
            {/if}
          </li>
        {/foreach}
      </ul>
    {/if}
  {/strip}
{/function}

<div class="block-blog-categories">
  <ul class="blog-category-top-menu">
    <li><a class="text-uppercase h6" href="{$categories.link|escape:'html':'UTF-8'}">{$categories.name|escape:'html':'UTF-8'}</a></li>
    {if !empty($categories.children)}
      <li>{blogCategories nodes=$categories.children}</li>
    {/if}
  </ul>
</div>
