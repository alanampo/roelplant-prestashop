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
{extends file='page.tpl'}

{block name='page_title'}
    <p class="row">
        <span class="col-md-3"></span>
        <span class="col-md-9" style="padding-top: 25px;">
            {l s='Create an account' d='Shop.Theme.CustomerAccount'}
        </span>
    </p>
{/block}

{block name='page_content'}
    <div class="col-xs-12 col-sm-12">
        {block name='register_form_container'}
          {$hook_create_account_top nofilter}
          <section class="register-form">
            <p class="row">
                <span class="col-md-3"></span>
                <span class="col-md-9">
                {l s='Already have an account?' d='Shop.Theme.CustomerAccount'} <a href="{$urls.pages.authentication|escape:'html':'UTF-8'}">{l s='Log in instead!' d='Shop.Theme.CustomerAccount'}</a>
                </span>
            </p>
            {render file='customer/_partials/customer-form.tpl' ui=$register_form}
          </section>
        {/block}
    </div>
{/block}
