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

{foreach from=$contentBlogHooks item=blogHook}
  <section class="container mt-2 mb-2 block-blog-post">
    <div class="row m-0">
        <h4>{$blogHook.name|escape:'html':'UTF-8'}</h4>
    </div>
    <div class="row m-0">
      <div class="gpt-blog-list">
        {foreach from=$blogHook.posts item=post}
          {include file="module:chatgptcontentgenerator/views/templates/front/post.tpl" post=$post}
        {/foreach}
      </div>
    </div>
  </section>
{/foreach}
