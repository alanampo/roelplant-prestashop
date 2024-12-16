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
{if $logged} 
    <div class="nav_link user-info-account">
        <span title="{l s='Mi Cuenta' d='Shop.Theme.CustomerAccount'}" >
            {l s='Mi Cuenta' d='Shop.Theme.Actions'}<i class="fa fa-angle-down"></i>
        </span>
        <ul class="nav_link_dropdown">
            <li>
                <a class="" href="{$my_account_url|escape:'html':'UTF-8'}" title="{l s='Mi Cuenta' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >
                    {l s='Mi Cuenta' d='Shop.Theme.Actions'}
                </a>
            </li>
            {hook h='displaycustom'}
            <li class="user_logged">
                <a class="" href="{$my_account_url|escape:'html':'UTF-8'}" title="{l s='Mi Cuenta' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >
                    {l s='Salir' d='Shop.Theme.Actions'}
                </a>
            </li>
        </ul>
    </div>
    
    <a class="logout nav_link" href="{$logout_url|escape:'html':'UTF-8'}" rel="nofollow" >
        {l s='Salir' d='Shop.Theme.Actions'}
    </a>
{else}
        <div class="nav_link user-info-account">
          <span title="{l s='Mi Cuenta' d='Shop.Theme.CustomerAccount'}" >
                {l s='Mi Cuenta' d='Shop.Theme.Actions'}<i class="fa fa-angle-down"></i>
            </span> 
          <ul class="nav_link_dropdown">
                <li>
                    <a class="" href="{$my_account_url|escape:'html':'UTF-8'}" title="{l s='Mi Cuenta' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >
                        {l s='Mi Cuenta' d='Shop.Theme.Actions'}
                    </a>
                </li>
                {hook h='displaycustom'}
                <li class="user_login">
                    <a class="" href="{$my_account_url|escape:'html':'UTF-8'}" title="{l s='Mi Cuenta' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >
                        {l s='Ingresar' d='Shop.Theme.Actions'}
                    </a>
                </li>
            </ul>
      </div>
      <a class="login nav_link" href="{$my_account_url|escape:'html':'UTF-8'}" title="{l s='Log in to your customer account' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >
        {l s='Ingresar' d='Shop.Theme.Actions'}
      </a>      
{/if}