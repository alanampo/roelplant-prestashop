{*
* 2007-2023 PrestaShop
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
<h2>{l s='Product History' mod='chatgptcontentgenerator'}</h2>

<div class="history_text">
    <input type="hidden" id="gpt_edited_text" name="is_gpt_edited" value="0">
</div>

<ul class="nav nav-tabs" id="historyTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="product-name-tab" data-toggle="tab" href="#product-name" role="tab" aria-controls="product-name" aria-expanded="true">{l s='Product name' mod='chatgptcontentgenerator'}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="desc-tab" data-toggle="tab" href="#desc" role="tab" aria-controls="desc" aria-expanded="true">{l s='Description' mod='chatgptcontentgenerator'}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="short-desc-tab" data-toggle="tab" href="#short-desc" role="tab" aria-controls="short-desc" aria-expanded="true">{l s='Short Description' mod='chatgptcontentgenerator'}</a>
    </li>
</ul>
<div class="tab-content" id="historyTabContent">
    <div class="tab-pane fade show active" id="product-name" role="tabpanel" aria-labelledby="product-name-tab">
        {foreach from=$languages item=language}
            <div class="language-tab {if $language.iso_code == 'en'}active{else}d-none{/if}" data-lang="{$language.iso_code|escape:'html':'UTF-8'}">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{l s='Product name' mod='chatgptcontentgenerator'}</th>
                        <th>{l s='Timestamp' mod='chatgptcontentgenerator'}</th>
                        <th>{l s='Actions' mod='chatgptcontentgenerator'}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {if isset($productHistoryList) && $productHistoryList}
                        {foreach from=$productHistoryList item=history}
                            {if $history.id_lang == $language.id_lang}
                                <tr>
                                    <th scope="row">{$history.id_product_history|escape:'html':'UTF-8'}</th>
                                    <td>
                                        {$history.name|truncate:300:"..."|escape:'html':'UTF-8'}
                                        {if strlen($history.name) >= 300}
                                            <span class="help-box view-full-text" data-lang-id="{$language.id_lang|escape:'html':'UTF-8'}"></span>
                                            <input class="full-text-hidden" type="hidden" value="{$history.name|escape:'html':'UTF-8'}">
                                        {/if}
                                    </td>
                                    <td>{$history.date_add|escape:'html':'UTF-8'}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-restore" title="{l s='Restore' mod='chatgptcontentgenerator'}"><i class="material-icons">restore</i></button>
                                    </td>
                                </tr>
                            {/if}
                        {/foreach}
                    {else}
                        <tr>
                            <td colspan="5">{l s='No history found' mod='chatgptcontentgenerator'}</td>
                        </tr>
                    {/if}
                    </tbody>
                </table>
            </div>
        {/foreach}
    </div>
    <div class="tab-pane fade" id="desc" role="tabpanel" aria-labelledby="desc-tab">
        {foreach from=$languages item=language}
            <div class="language-tab {if $language.iso_code == 'en'}active{else}d-none{/if}" data-lang="{$language.iso_code|escape:'html':'UTF-8'}">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{l s='Description' mod='chatgptcontentgenerator'}</th>
                        <th>{l s='Timestamp' mod='chatgptcontentgenerator'}</th>
                        <th>{l s='Actions' mod='chatgptcontentgenerator'}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {if isset($productHistoryList) && $productHistoryList}
                        {foreach from=$productHistoryList item=history}
                            {if $history.id_lang == $language.id_lang}
                                <tr>
                                    <th scope="row">{$history.id_product_history|escape:'html':'UTF-8'}</th>
                                    <td>
                                        {$history.description|strip_tags|truncate:300:"..."|escape:'html':'UTF-8'}
                                        {if strlen($history.description) >= 300}
                                            <span class="help-box view-full-text" data-lang-id="{$language.id_lang|escape:'html':'UTF-8'}"></span>
                                            <input class="full-text-hidden" type="hidden" value="{htmlspecialchars($history.description|escape:'html':'UTF-8')}">
                                        {/if}
                                    </td>
                                    <td>{$history.date_add|escape:'html':'UTF-8'}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-restore" title="{l s='Restore' mod='chatgptcontentgenerator'}"><i class="material-icons">restore</i></button>
                                    </td>
                                </tr>
                            {/if}
                        {/foreach}
                    {else}
                        <tr>
                            <td colspan="5">{l s='No history found' mod='chatgptcontentgenerator'}</td>
                        </tr>
                    {/if}
                    </tbody>
                </table>
            </div>
        {/foreach}
    </div>
    <div class="tab-pane fade" id="short-desc" role="tabpanel" aria-labelledby="short-desc-tab">
        {foreach from=$languages item=language}
            <div class="language-tab {if $language.iso_code == 'en'}active{else}d-none{/if}" data-lang="{$language.iso_code|escape:'html':'UTF-8'}">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{l s='Short Description' mod='chatgptcontentgenerator'}</th>
                        <th>{l s='Timestamp' mod='chatgptcontentgenerator'}</th>
                        <th>{l s='Actions' mod='chatgptcontentgenerator'}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {if isset($productHistoryList) && $productHistoryList}
                        {foreach from=$productHistoryList item=history}
                            {if $history.id_lang == $language.id_lang}
                                <tr>
                                    <th scope="row">{$history.id_product_history|escape:'html':'UTF-8'}</th>
                                    <td>
                                        {$history.short_description|strip_tags|truncate:300:"..."|escape:'html':'UTF-8'}
                                        {if strlen($history.short_description) >= 300}
                                            <span class="help-box view-full-text" data-lang-id="{$language.id_lang|escape:'html':'UTF-8'}"></span>
                                            <input class="full-text-hidden" type="hidden" value="{htmlspecialchars($history.short_description|escape:'html':'UTF-8')}">
                                        {/if}
                                    </td>
                                    <td>{$history.date_add|escape:'html':'UTF-8'}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-restore" title="{l s='Restore' mod='chatgptcontentgenerator'}"><i class="material-icons">restore</i></button>
                                    </td>
                                </tr>
                            {/if}
                        {/foreach}
                    {else}
                        <tr>
                            <td colspan="5">{l s='No history found' mod='chatgptcontentgenerator'}</td>
                        </tr>
                    {/if}
                    </tbody>
                </table>
            </div>
        {/foreach}
    </div>
</div>
<input type="hidden" id="currentPage" value="{$currentPage|escape:'html':'UTF-8'}">
<input type="hidden" id="totalPages" value="{$totalPages|escape:'html':'UTF-8'}">
<input type="hidden" id="pageType" value="{$pageType|escape:'html':'UTF-8'}">
<nav aria-label="Pagination" class="pagination-wrapper">
    <ul class="pagination justify-content-center">
    </ul>
</nav>
<div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">Restore Product Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_lang">Language:</label>
                    <select class="form-control" name="id_lang">
                        {foreach from=$languages item=language}
                            <option value="{$language.id_lang|escape:'html':'UTF-8'}">{$language.name|escape:'html':'UTF-8'}</option>
                        {/foreach}
                    </select>
                </div>
                Are you sure you want to restore this data for product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-restore">Restore</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="view-full-text" tabindex="-1" role="dialog" aria-labelledby="view-text" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="view-text">View full text</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
