/**
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
 *
 * Don't forget to prefix your containers with your own identifier
 * to avoid any conflicts with others containers.
 */
$(document).ready(function () {

    $(document).on('click', '.view-full-text', function() {
        var fullText = $(this).siblings('.full-text-hidden').val();
        var decodedFullText = decodeURIComponent(fullText);
        var viewModal = $('#view-full-text');
        viewModal.find('.modal-body').html(decodedFullText);
        viewModal.modal('show');
    });

    $('#form_switch_language').on('change', function() {
        var selectedLang = $(this).val();
        $('.language-tab').addClass('d-none').removeClass('active');
        $('.language-tab[data-lang="' + selectedLang + '"]').removeClass('d-none').addClass('active');
    });

    $('.js-locale-item, .translationsLocales .nav-link').on('click', function() {
        var selectedLang = $(this).data('locale');
        $('.language-tab').addClass('d-none').removeClass('active');
        $('.language-tab[data-lang="' + selectedLang + '"]').removeClass('d-none').addClass('active');
    });

    var currentPage = parseInt($('#currentPage').val());
    var totalPages = parseInt($('#totalPages').val());
    var pageType = $('#pageType').val();
    var id_entity = null;
    var actionRestore = '';
    var getHistoryPerPage = '';

    switch (pageType) {
        case 'product':
            id_entity = idProduct;
            actionRestore = 'restoreData' + pageType.charAt(0).toUpperCase() + pageType.slice(1);
            getHistoryPerPage = 'getHistoryPerPage' + pageType.charAt(0).toUpperCase() + pageType.slice(1);
            break;
        case 'category':
            id_entity = idCategory;
            actionRestore = 'restoreData' + pageType.charAt(0).toUpperCase() + pageType.slice(1);
            getHistoryPerPage = 'getHistoryPerPage' + pageType.charAt(0).toUpperCase() + pageType.slice(1);
            break;
        case 'cms':
            id_entity = idCms;
            actionRestore = 'restoreData' + pageType.charAt(0).toUpperCase() + pageType.slice(1);
            getHistoryPerPage = 'getHistoryPerPage' + pageType.charAt(0).toUpperCase() + pageType.slice(1);
            break;
        default:
            break;
    }

    $(document).on('click', '.btn-restore', function(e) {
    	e.preventDefault();
        var row = $(this).closest('tr');
        var idHistory = row.find('th').text();
	
        var restoreModal = $('#restoreModal');
        restoreModal.modal('show');

        restoreModal.find('.btn-restore').off('click').on('click', function() {
            var idLang = restoreModal.find('select[name="id_lang"]').val();
	
            $.ajax({
                url: ajaxUrlHistory,
                type: 'POST',
                data: {
                    ajax: 1,
                    action: actionRestore,
                    id_history: idHistory,
                    id_entity: id_entity,
                    id_lang: idLang,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        restoreModal.modal('hide');
                        $.growl.notice({
                            title: 'Success',
                            message: 'Product updated successfully. Please refresh the page.'
                        });
                    } else {
                        $.growl.error({
                            title: 'Error',
                            message: response.message || 'Failed to update product.'
                        });
                    }
                },
                error: function() {
                    $.growl.error({
                        title: 'Error',
                        message: 'An error occurred while restoring the product.'
                    });
                }
            });
        });
    });

    var languageMap = languagesMap.reduce((acc, curr) => {
        acc[curr.id_lang] = curr.iso_code;
        return acc;
    }, {});
    var count_lang = Object.keys(languageMap).length;

    function updateTable(data) {
        $('.language-tab').each(function () {
            var languageCode = $(this).data('lang');
            var tabId = $(this).closest('.tab-pane').attr('id');

            var tbody = $(this).find('tbody');
            tbody.empty();

            data.forEach(function (history) {
                var historyLangCode = languageMap[history.id_lang];

                if (historyLangCode === languageCode) {
                    appendRowContent(pageType, history, tabId, tbody);
                }
            });
        });
    }

    function appendRowContent(pageType, history, tabId, tbody) {
        var content = '';
        var id_entity_history = null;
        if (pageType === 'product') {
            id_entity_history = history.id_product_history;
            if (tabId === 'product-name') {
                content = history.name;
            } else if (tabId === 'desc') {
                content = history.description.replace(/<\/?p>/g, '');
            } else {
                content = history.short_description.replace(/<\/?p>/g, '');
            }
        } else if (pageType === 'category') {
            id_entity_history = history.id_category_history;
            content = tabId === 'category-name' ? history.name : history.description.replace(/<\/?p>/g, '');
        } else if (pageType === 'cms') {
            id_entity_history = history.id_cms_history;
            content = tabId === 'cms-title' ? history.title : history.content.replace(/<\/?p>/g, '');
        }

        var encodedContent = encodeURIComponent(content);

        var truncatedContent = content.length > 300 ? content.substring(0, 300) + '...' : content;
        var viewFullTextButton = content.length > 300 ?
            '<span class="help-box view-full-text" data-field="' + tabId + '" data-lang-id="' + history.id_lang + '"></span>'
            + '<input class="full-text-hidden" type="hidden" value="' + encodedContent + '">' : '';

        var row = `<tr>
	                <th scope="row">${ id_entity_history }</th>
	                <td>
                        ${truncatedContent}
                        ${viewFullTextButton}
                    </td>
                    <td>${history.date_add}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm btn-restore" title="Restore">
                            <i class="material-icons">restore</i>
                        </button>
                    </td>
	            </tr>`;

        tbody.append(row);
    }

    function loadHistoryPage(page) {
        $.ajax({
            url: ajaxUrlHistory,
            type: 'POST',
            data: {
                ajax: 1,
                action: getHistoryPerPage,
                id_entity: id_entity,
                current_page: page,
                count_lang: count_lang,
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    updateTable(response.data);
                    updatePagination(response.page, totalPages);
                    $('#currentPage').val(response.page);
                } else {
                    console.error("Data invalid");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request error: ", status, error);
            }
        });
    }

    function updatePagination(currentPage, totalPages) {
        var paginationList = $('.pagination');
        paginationList.empty();

        if (totalPages <= 1) {
            return;
        }

        var maxPagesShown = 10;
        var startPage = Math.max(1, currentPage - Math.floor(maxPagesShown / 2));
        var endPage = Math.min(totalPages, startPage + maxPagesShown - 1);

        if (startPage > 1) {
            paginationList.append('<li class="page-item"><a class="page-link" href="#" data-page="' + (startPage - 1) + '">&laquo;</a></li>');
        }

        for (var i = startPage; i <= endPage; i++) {
            var active = (i == currentPage) ? 'active' : '';
            paginationList.append('<li class="page-item ' + active + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
        }

        if (endPage < totalPages) {
            paginationList.append('<li class="page-item"><a class="page-link" href="#" data-page="' + (endPage + 1) + '">&raquo;</a></li>');
        }
    }

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        var currentPage = parseInt($('#currentPage').val());
        if (page == currentPage) {
            return
        }
        if (page) {
            loadHistoryPage(page);
        }
    });
    updatePagination(currentPage, totalPages);

})
