/**
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
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/

$(function () {
    if (typeof adminPageName == 'undefined') {
        return;
    }

    if (typeof gptShopInfo == 'undefined' || !!gptShopInfo === false) {
        console.error('The gptShopInfo is not defined. Make sure that the the shop data is agreement on the module configuration page');
        return;
    }

    if (typeof ChatGptContent == 'undefined') {
        console.error('The ChatGptContent is not defined.');
        return;
    }

    /** generate reviews action */
    var bulkGenerateReviews = new ChatGptModalBulkAction({
        title: '<i class="material-icons mi-chat">chat</i> ' + gptI18nReviews.bulkGenerateReviewsButtonName,
        class: 'dropdown-item'
    }, function (bulkActionButton) {
        // init reviews form //////////////////////////////////////
        var modal = new ChatGptModal({
            closable: false,
            keyboard: false,
            backdrop: false,
            class: 'black-modal modal-with-tabs product-reviews-modal'
        });

        let radioClass = 'radio-' + (new Date()).getTime();
        let idLangDefault = (new ChatGptContent()).getPageLanguageId();
        let radioLanguagesList = '';
        for (let i = 0; i < gptLanguages.length; i++) {
            radioLanguagesList +=
                '<tr>' +
                    '<td>' +
                        '<div class="radio">' +
                            '<div class="m-0 form-check-radio"><label class="form-check-label"><input type="radio" class="' + radioClass + '" name="reviews_language" value="' + gptLanguages[i].id_lang + '" ' + (gptLanguages[i].id_lang == idLangDefault ? 'checked="checked"' : '') +'><i class="form-check-round"></i>' + gptLanguages[i].name + '</label></div>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
        }

        modal
            .setHeader(gptI18nReviews.reviewsModalTitle)
            .setBody(
                '<div class="tabs js-tabs">' +
                    '<ul class="nav nav-tabs js-nav-tabs" id="form-nav" role="tablist">' +
                        '<li id="tab_step1" class="nav-item"><a href="#gptgeneral" role="tab" data-toggle="tab" class="font-weight-bold nav-link active" aria-selected="true">General</a></li>' +
                    '</ul>' +
                '</div>' +
                '<div class="tab-content" style="border: 1px solid #25b9d7;">' +

                    '<div class="row form-inline mb-3 template-hide-form">' +
                        '<label class="control-label col-md-6 justify-content-end text-right">' + gptI18nReviews.nbReviewsPerProductLabel + ':</label>' +
                        '<div class="col-md-6">' +
                            '<div class="input-group">' +
                                '<input type="number" id="gpt_nb_reviews_per_product" class="form-control" min="1" step="1" max="100" value="1">' +
                                '<div class="input-group-append">' +
                                    '<span class="input-group-text"> ' + gptI18nReviews.reviews + '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row form-inline mb-3">' +
                        '<label class="control-label col-md-6 justify-content-end text-right">' + gptI18nReviews.minRateLabel + ':</label>' +
                        '<div class="col-md-6">' +
                            '<select class="form-control" id="gpt_reviews_min_rate" style="width:100%">' +
                                '<option value="1">1 - negative</option>' +
                                '<option value="2">2 - negative</option>' +
                                '<option value="3">3 - neutral</option>' +
                                '<option value="4">4 - good</option>' +
                                '<option value="5">5 - excellent</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row form-inline mb-3">' +
                        '<label class="control-label col-md-6 justify-content-end text-right">' + gptI18nReviews.maxRateLabel + ':</label>' +
                        '<div class="col-md-6">' +
                            '<select class="form-control" id="gpt_reviews_max_rate" style="width:100%">' +
                                '<option value="1">1 - negative</option>' +
                                '<option value="2">2 - negative</option>' +
                                '<option value="3">3 - neutral</option>' +
                                '<option value="4">4 - good</option>' +
                                '<option value="5" selected="selected">5 - excellent</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row form-inline mb-3 template-hide-form">' +
                        '<label class="control-label col-md-6 justify-content-end text-right">' + gptI18n.maxNumberWords + ':</label>' +
                        '<div class="col-md-6">' +
                            '<div class="input-group">' +
                                '<input type="number" id="gpt_reviews_length" class="form-control" min="10" step="1" max="1000" value="50">' +
                                '<div class="input-group-append">' +
                                    '<span class="input-group-text"> ' + gptI18n.words + '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row type-choice mb-3 gpt-modal-languages">' +
                        '<label class="control-label col-md-6 justify-content-end text-right">' + gptI18nReviews.contentLanguageLabel + ':</label>' +
                        '<div class="col-md-6">' +
                            '<div class="type-choice">' +
                                // '<div class="col-md-6">' +
                                    '<div class="choice-table pl-1px">' +
                                        '<table class="table table-bordered mb-0">' +
                                            '<thead>' +
                                                '<tr>' +
                                                    '<th class="checkbox">Select one</th>' +
                                                '</tr>' +
                                            '</thead>' +
                                            '<tbody>' +
                                                radioLanguagesList +
                                            '</tbody>' +
                                        '</table>' +
                                    '</div>' +
                                // '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row form-inline mb-3">' +
                        '<label class="control-label col-md-6 justify-content-end text-right">' + gptI18nReviews.reviewsStatusLabel + ':</label>' +
                        '<div class="col-md-3">' +
                            '<div class="input-group">' +
                                '<span class="ps-switch">' +
                                    '<input id="gpt_reviews_status_0" class="ps-switch" name="gpt_reviews_status" value="0" type="radio" aria-label="No">' +
                                    '<label for="gpt_reviews_status_0">' + gptI18nReviews.disabled + '</label>' +
                                    '<input id="gpt_reviews_status_1" class="ps-switch" name="gpt_reviews_status" value="1" checked="checked" type="radio" aria-label="Yes">' +
                                    '<label for="gpt_reviews_status_1">' + gptI18nReviews.enabled + '</label>' +
                                    '<span class="slide-button"></span>' +
                                '</span>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row form-inline mb-3">' +
                        '<label class="control-label col-md-6 justify-content-end text-right" for="gpt_reviews_date_start">' + gptI18nReviews.startCreationDateLabel + ':</label>' +
                        '<div class="col-md-6">' +
                            '<div class="input-group datepicker">' +
                                '<input type="text" id="gpt_reviews_date_start" class="form-control w-100" autocomlete="off">' +
                                '<div class="input-group-append"><div class="input-group-text"><i class="material-icons">date_range</i></div></div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row form-inline mb-3">' +
                        '<label class="control-label col-md-6 justify-content-end text-right">' + gptI18nReviews.endCreationDateLabel + ':</label>' +
                        '<div class="col-md-6">' +
                            '<div class="input-group datepicker">' +
                                '<input type="text" id="gpt_reviews_date_end" class="form-control w-100" autocomlete="off">' +
                                '<div class="input-group-append"><div class="input-group-text"><i class="material-icons">date_range</i></div></div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                '</div>'
            )
        ;

        // bulkRewriteMenu.setModal(modal);
        // END init reviews form //////////////////////////////////////

        modal
            .addAction({
                    title: gptI18n.buttonCancel,
                    class: 'btn btn-outline-secondary'
                }, function (cancelButton) {
                    cancelButton.getModal().destroy();
                })
            .addAction({
                    title: gptI18nReviews.buttonGenerate,
                }, async function (actionInstance) {
                    var contentInstance = new ChatGptContent();

                    var items = [];
                    var inputs = $('input:checked[name="' + gptVarVersion.selectors.plBulkSelectedName + '"]', $('#' + gptVarVersion.selectors.plProductFormId + ''));

                    inputs.each(function () { items.push(+this.value); });

                    if (items.length == 0) {
                        alert(gptI18n.pleaseSelectItems);
                        return;
                    }

                    var modal = actionInstance.getModal();                    
                    var nbReviews = +modal.find('#gpt_nb_reviews_per_product').val();
                    var contentLangId = +$('[name="reviews_language"]:checked').val();
                    var rateMin = +modal.find('#gpt_reviews_min_rate').val();
                    var rateMax = +modal.find('#gpt_reviews_max_rate').val();
                    var reviewStatus = +modal.find('#gpt_reviews_status_1').is(':checked');
                    var dateStart = modal.find('#gpt_reviews_date_start').val();
                    var dateEnd = modal.find('#gpt_reviews_date_end').val();
                    var maxWords = +modal.find('#gpt_reviews_length').val();
                    var totalRequest = nbReviews * items.length;
                    var completedRequests = 1;

                    dateStart = dateStart ? new Date(dateStart) : new Date((new Date()).setDate((new Date()).getDate() - 1));
                    dateEnd = dateEnd ? new Date(dateEnd) : new Date();

                    modal.find('body').html(
                        '<div>' +
                            '<span>Generating in progress...</span>' +
                            '<span id="process_generate_status" style="color: darkred;"></span>' +
                            '<div id="process_generate_warning_log" class="alert alert-warning mt-2" style="display: none;"><p class="alert-text"></p></div>' +
                            '<div class="progress mt-2" style="width: 100%">' +
                                '<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%">' +
                                    '<span>0 %</span>' +
                                '</div>' +
                            '</div>' +
                            '<div id="process_generate_error_log" class="alert alert-danger mt-2" style="display: none;"><p class="alert-text"></p></div>' +
                            '<div id="process_generate_success_log" class="alert alert-success mt-2" style="display: none;"><p class="alert-text"></p></div>' +
                        '</div>'
                    );

                    modal
                        .setActions([])
                        .addAction({
                                title: gptI18n.buttonCancel,
                                class: 'btn btn-outline-secondary'
                            }, function (actionInstance) {
                                contentInstance.stopCurrentProcess();
                                actionInstance.getModal().find('#process_generate_status').text(gptI18n.textCanceled);

                                actionInstance
                                    .getModal()
                                    .setActions([])
                                    .addAction({
                                            title: gptI18n.buttonClose,
                                            class: 'btn btn-outline-secondary'
                                        }, function (actionInstance) {
                                            actionInstance.getModal().destroy();
                                        })
                                    .renderActions();
                            })
                        .renderActions();
                    
                    var progressBar = modal.find('.progress-bar');
                    function minMaxInt(min, max) {
                        return Math.floor(Math.random() * (max - min + 1)) + min;
                    }
                    for (let i = 0; i < items.length; i ++) {
                        for (let k = 0; k < nbReviews; k++, completedRequests++) {
                            try {
                                let response = await contentInstance.generateReviewByProductId({
                                    idProduct: items[i],
                                    idLang: contentLangId,
                                    maxWords: maxWords,
                                    rate: minMaxInt(rateMin, rateMax),
                                    status: reviewStatus,
                                    publicDate: minMaxInt(Math.floor(dateStart.getTime() / 1000), Math.floor(dateEnd.getTime() / 1000)),
                                }, true);

                                if (response && typeof response.warning != 'undefined' && response.warning) {
                                    modal.find("#process_generate_warning_log").show().html(response.warning);
                                }
                            } catch (err) {
                                ChatGptContent.removeLoaderLayer();
                                ChatGptForm.handleModalError(actionInstance.getModal(), err);

                                modal.find('#process_generate_status').html(gptI18nReviews.generationProcessFailed);
                                modal.find("#process_generate_error_log").show().html(err);
                                return;
                            }

                            // let completedRequests = nbReviews * i + (languageIndex + 1);
                            progressBar.css('width', `${completedRequests * 100 / totalRequest}%`);
                            progressBar.find('span').html(`${(i+1)} / ${items.length} (${(completedRequests * 100 / totalRequest).toFixed(2)}%)`);

                            if ((completedRequests * 100 / totalRequest) >= 100) {
                                modal
                                    .setActions([])
                                    .addAction({
                                            title: gptI18n.buttonClose,
                                            class: 'btn btn-outline-secondary'
                                        }, function (actionInstance) {
                                            actionInstance.getModal().destroy();
                                        })
                                    .renderActions();

                                modal.find('#process_generate_success_log').show().text(gptI18n.bulkGenerationProcessCompleted);
                            }
                        }
                    }
                })
            .open(function () {
                // init tooltips
                $(".gpt-tooltip").popover();

                // init datepicker
                $('#gpt_reviews_date_start, #gpt_reviews_date_end').datetimepicker({
                    sideBySide: true,
                    format: 'YYYY-MM-DD',
                    locale: window.full_language_code || 'en-us',
                });
            });
    });
    /** END generate reviews action */

    var availableProductDescriptionFeature = gptShopInfo.subscription && gptShopInfo.subscription.availableProductWords > 0;

    if (adminPageName == 'productsList' && availableProductDescriptionFeature) {
        var bulkMenu = $(gptVarVersion.selectors.plBulkMenu);
        bulkMenu.prepend($('<div class="dropdown-divider"></div>'));
        bulkGenerateReviews.renderInto(bulkMenu, true);
    }
});
