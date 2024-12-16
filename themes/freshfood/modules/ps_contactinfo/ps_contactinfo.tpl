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
<div class="block-contact links wrapper col-sm-3 col-xs-12">
    <div class="title clearfix hidden-sm-up" data-target="#contact_footer" data-toggle="collapse">
        <span class="h3">{l s='About Shop' d='Shop.Theme.CustomerAccount'}</span>
        <span class="pull-xs-right">
          <span class="navbar-toggler collapse-icons">
            <i class="fa fa-angle-double-down add"></i>
            <i class="fa fa-angle-double-up remove"></i>
          </span>
        </span>
    </div>
    <div id="contact_footer" class="contactinfo_footer collapse">
        {if isset($tc_config.YBC_TC_LOGO_FOOTER) && $tc_config.YBC_TC_LOGO_FOOTER}
            <div class="logo_footer">
                <img src="{$tc_module_path|escape:'html':'UTF-8'}images/config/{$tc_config.YBC_TC_LOGO_FOOTER|escape:'html':'UTF-8'}" alt="" title="" />
            </div>
        {/if}
      {if isset($tc_config.YBC_TC_COPYRIGHT_TEXT_EXTRA) && $tc_config.YBC_TC_COPYRIGHT_TEXT_EXTRA}
        <div class="ybc_footer_text">
            {$tc_config.YBC_TC_COPYRIGHT_TEXT_EXTRA nofilter}
        </div>
     {/if}
     <div class="ybc_footer_contact">
     <h4>{l s='Contact Us' d='Shop.Theme.CustomerAccount'}</h4>
      {if isset($tc_config.BLOCKCONTACTINFOS_ADDRESS) && $tc_config.BLOCKCONTACTINFOS_ADDRESS}
            <div class="footer_contact_item">
                {l s='Address:' d='Shop.Theme'}
                {if isset($tc_config.BLOCKCONTACTINFOS_COMPANY) && $tc_config.BLOCKCONTACTINFOS_COMPANY} {$tc_config.BLOCKCONTACTINFOS_COMPANY|escape:'html':'UTF-8'}, {/if} {$tc_config.BLOCKCONTACTINFOS_ADDRESS|escape:'html':'UTF-8'}
            </div>
      {else if (isset($contact_infos.address.address1) && $contact_infos.address.address1) || (isset($contact_infos.address.address2) && $contact_infos.address.address2)}
          {if $contact_infos.address.address1}
              <div class="footer_contact_item">
                {l s='Address: [1]%address1%[/1]'
                  sprintf=[
                  '[1]' => '<span>',
                  '[/1]' => '</span>',
                  '%address1%' => $contact_infos.address.address1
                  ]
                  d='Shop.Theme'
                }
              </div>
          {/if}
          {if $contact_infos.address.address2}
              <div class="footer_contact_item">
                {l s='Address2: [1]%address2%[/1]'
                  sprintf=[
                  '[1]' => '<span>',
                  '[/1]' => '</span>',
                  '%address2%' => $contact_infos.address.address2
                  ]
                  d='Shop.Theme'
                }
              </div>
          {/if}
      {else}
        {if isset($contact_infos.address.formatted) && $contact_infos.address.formatted}
            <div class="footer_contact_item">
                {l s='Address: [1]%address%[/1]'
                  sprintf=[
                  '[1]' => '<span>',
                  '[/1]' => '</span>',
                  '%address%' => $contact_infos.address.formatted
                  ]
                  d='Shop.Theme'
                }
              </div>
        {/if}
      {/if}

      {if isset($tc_config.BLOCKCONTACTINFOS_PHONE_LABEL) && $tc_config.BLOCKCONTACTINFOS_PHONE_LABEL}
        <div class="footer_contact_item">
            <a href="tel: {$tc_config.BLOCKCONTACTINFOS_PHONE_CALL|escape:'html':'UTF-8'}">
              {l s='Phone: ' d='Modules.Contactinfo.Shop'} {$tc_config.BLOCKCONTACTINFOS_PHONE_LABEL|escape:'html':'UTF-8'}
          </a>
        </div>
      {/if}
      {if $contact_infos.fax}
        <div class="footer_contact_item">
            {l s='Fax:' d='Shop.Theme' }{$contact_infos.fax nofilter}
        </div>
      {/if}
      {if $contact_infos.email}
        <div class="footer_contact_item">
            <a href="mailto: {$contact_infos.email|escape:'html':'UTF-8'}">
                {l s='Email: ' d='Shop.Theme' }  {$contact_infos.email|escape:'html':'UTF-8'}
            </a>
        </div>
      {/if}
      {if isset($tc_config.BLOCKCONTACTINFOS_SKYPE) && $tc_config.BLOCKCONTACTINFOS_SKYPE}
        <div class="footer_contact_item">
            <a href="skype:live: {$tc_config.BLOCKCONTACTINFOS_SKYPE|escape:'html':'UTF-8'}?call">
                {l s='Skype:' d='Shop.Theme'}  {$tc_config.BLOCKCONTACTINFOS_SKYPE|escape:'html':'UTF-8'}
            </a>
        </div>
      {/if}
      </div>
    </div>
</div>