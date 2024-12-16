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
{block name='header_top'}
  <div class="mobile_logo">
    <div class="" id="_mobile_logo">
      <a href="{$urls.base_url|escape:'html':'UTF-8'}">
        <img class="logo img-responsive" src="{if isset($tc_dev_mode) && $tc_dev_mode && isset($logo_url)&&$logo_url} {$logo_url|escape:'html':'UTF-8'}{else} {$shop.logo|escape:'html':'UTF-8'}{/if}" alt="{$shop.name|escape:'html':'UTF-8'}">
      </a>
    </div>
  </div>
  <div class="header-top header_type_2">
    <div class="container">
       <div class="row">
       <div class="hidden-sm-up toogle_menu_mobile closed" id="menu-icon">
          <i class="material-icons d-inline menu">menu</i>
        </div>
       <div id="_desktop_contact_link" class="shop_text_nav col-sm-4">
          <div id="contact-link" class="shop_text_nav_config">
            {if isset($tc_config.BLOCKCONTACTINFOS_PHONE_CALL) && $tc_config.BLOCKCONTACTINFOS_PHONE_CALL}
                <i class="fa fa-whatsapp"></i><b>{l s='ORDER ONLINE' d='Modules.Contactinfo.Shop'}</b><br />
                  <a href="tel: {$tc_config.BLOCKCONTACTINFOS_PHONE_CALL|escape:'html':'UTF-8'}">
                       {$tc_config.BLOCKCONTACTINFOS_PHONE_LABEL|escape:'html':'UTF-8'}
                  </a>
            {/if}
          </div>
        </div>
        
        <div class="col-sm-4 hidden-xs-down" id="_desktop_logo">
          <a href="{$urls.base_url|escape:'html':'UTF-8'}">
            <img class="logo img-responsive" src="{if isset($tc_dev_mode) && $tc_dev_mode && isset($logo_url)&&$logo_url} {$logo_url|escape:'html':'UTF-8'}{else} {$shop.logo|escape:'html':'UTF-8'}{/if}" alt="{$shop.name|escape:'html':'UTF-8'}">
          </a>
        </div>
        {hook h='displayTop'}
        
      </div>
    </div>
    <div class="menu_and_cattree">
        <div class="container">
            <div class="row">
                <div class="custom_menu col-md-12 col-sm-12">
                    {hook h='displayMegaMenu'}
                </div>
            </div>
        </div>
    </div>
  </div>
  {hook h='displayNavFullWidth'}
{/block}