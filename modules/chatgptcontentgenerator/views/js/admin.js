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

const gptPageSettings = {
    productsList: {
        words: 400,
        minWords: 100,
        maxWords: 1000,
        step: 1,
        replaceContent: false,
        skipExistingDescription: true, // generate new content if empty
        skipExistingTitle: true,
    },
    productForm: {
        words: 400,
        minWords: 100,
        maxWords: 1000,
        step: 1,
        replaceContent: false,
        skipExistingDescription: false, // generate new content if empty
        skipExistingTitle: false,
        spinOffStockCommon: spinOffStockCommon,
        spinOffStockIndividual: spinOffStockIndividual,
        spinOffStock: spinOffStock,
    },
    categoriesList: {
        words: 180,
        minWords: 10,
        maxWords: 1000,
        step: 1,
        skipExistingDescription: true,
        skipExistingTitle: true,
        replaceContent: false,
    },
    categoryForm: {
        words: 180,
        minWords: 10,
        maxWords: 1000,
        step: 1,
    },
    cmsForm: {
        words: 1000,
        minWords: 100,
        maxWords: 2000,
        step: 1,
    },
    postForm: {
        words: 300,
        minWords: 100,
        maxWords: 1000,
        step: 1,
        replaceContent: false,
        skipExistingDescription: false, // generate new content if empty
        skipExistingTitle: false,
    },
};

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

    // function renderLoaderlayer(el) {
    //     el.length > 0 && el.css('position', 'relative')
    //             .append('<div id="gpt_description_loader" class="content-loader-layer"><div class="loader-wrapper"><div class="content-loader"></div></div></div>');
    // }
    var renderLoaderlayer = ChatGptContent.renderLoaderlayer;

    function getWordsFiled(value, min, max, step) {
        return '<div class="col-md-4">'+
                    '<div class="input-group">' +
                        '<input type="number" id="gpt_description_length" title="' + gptI18n.maxLength + '" class="form-control" min="' + min + '" step="' + step + '" max="' + max + '" value="' + value + '">' +
                        '<div class="input-group-append">' +
                            '<span class="input-group-text"> ' + gptI18n.words + '</span>' +
                        '</div>' +
                    '</div>' +
                '</div>';
    }

    function getInfoButton(message) {
        return '<a class="btn tooltip-link delete pl-0 pr-0">' +
                '<span class="help-box gpt-tooltip" data-toggle="popover" data-content="' + message.replace(/\"/g, "\'") + '" data-original-title="" title=""></span>' +
            '</a>';
    }

    var removeLoaderLayer = ChatGptContent.removeLoaderLayer;

    function renderAlertMessage(messageText, element) {
        var object = $('<div class="alert alert-danger mt-2" role="alert">' +
                        '<p class="alert-text">' + messageText + '</p>' +
                    '</div>');
        if (!!element && element.length) {
            element.append(object);
        }
    }

    function renderCustomRequestForm (element, options) {
        options = Object.assign({}, {
            contentWrapperSelector: '',
            contentEditorPreffix: '',
            entity: '',
        }, options);

        var customRequestObject = new ChatGptCustomRequest({}, function (instance) {
            async function customRequest () {
                var content = new ChatGptContent(),
                    idLang = content.getPageLanguageId();
		var gptEditedtext = document.querySelector('#gpt_edited_text');
                renderLoaderlayer(instance.getWrapper());
                var response = await content.customRequest(instance.getText(), {entity: options.entity});
                if (typeof response.inQueue != 'undefined' && response.inQueue) {
                    response = await content.awaitRequestResponse(response.requestId);

                    // display error message if the request is failure
                    if (response && response.status != 'success') {
                        if (response.status == 'quota_over') {
                            window.showErrorMessage(gptI18n.subscriptionLimitЕxceeded);
                        } else {
                            window.showErrorMessage(response.text);
                        }
                        removeLoaderLayer();
                        return;
                    }
                }

                if (response && response.text) {
                    content.setContentIntoEditor(
                        content.convertTextToHtml(response.text),
                        {format: 'html'},
                        tinymce.get(options.contentEditorPreffix + idLang)
                    );

                    window.showSuccessMessage(gptI18n.successMessage.replace(/\%words\%/g, response.nbWords));
                }
                gptEditedtext.value = 1;
                removeLoaderLayer();
            }

            var currentContent = tinymce.get(options.contentEditorPreffix + (new ChatGptContent()).getPageLanguageId())
                                    .getContent({format: 'text'})
                                    .trim();

            if (currentContent !== '') {
                (new ChatGptModal)
                    .setHeader(gptI18n.modalTitle)
                    .setBody(gptI18n.confirmCustomRequest)
                    .addAction({
                            title: gptI18n.buttonCancel,
                            class: 'btn btn-outline-secondary'
                        }, function (actionInstance) {
                            actionInstance.getModal().destroy();
                        })
                    .addAction({
                            title: '<i class="material-icons">send</i> ' + gptI18n.buttonSend,
                        }, function (actionInstance) {
                            customRequest();
                            actionInstance.getModal().destroy();
                        })
                    .open();
                return;
            }

            customRequest();
        }).renderInto(element);
    }

    // init description form //////////////////////////////////////
    var descriptionModal = new ChatGptModal({
        closable: false,
        keyboard: false,
        backdrop: false,
        class: 'black-modal modal-with-tabs'
    });

    descriptionModal
        .setHeader(gptI18n.bulkGeneratingDescription)
        .setBody(
            '<div>' + ChatGptForm.descriptionForm() + '</div>'
        )
    ;
    // END init description form //////////////////////////////////////

    // init translation form //////////////////////////////////////
    var trasnalationModal = new ChatGptModal({
        closable: false,
        keyboard: false,
        backdrop: false,
        class: 'black-modal modal-with-tabs'
    });

    trasnalationModal
        .setHeader(gptI18n.translatingSettings)
        .setBody(
            '<div>' + ChatGptForm.traslationForm() + '</div>'
        )
    ;
    // END init translation form //////////////////////////////////////

    // init rewrite form //////////////////////////////////////
    var rewriteModal = new ChatGptModal({
        closable: false,
        keyboard: false,
        backdrop: false,
        class: 'black-modal modal-with-tabs'
    });

    rewriteModal
        .setHeader(gptI18n.bulkRewriteTitle)
        .setBody(
            '<div>' + ChatGptForm.rewriteForm() + '</div>'
        )
    ;
    // END init rewrite form //////////////////////////////////////

    // init post form //////////////////////////////////////
    var productPostModal = new ChatGptModal({
        closable: false,
        keyboard: false,
        backdrop: false,
        class: 'black-modal modal-with-tabs product-post-modal'
    });

    productPostModal
        .setHeader(gptI18n.productPostTitle)
        .setBody(
            '<div>' + ChatGptForm.productPostForm() + '</div>'
        )
    ;
    // END init post form //////////////////////////////////////

    // init meta title form ////////////////////////////////////
    var metaTitleModal = new ChatGptModal({
        closable: false,
        keyboard: false,
        backdrop: false,
        class: 'black-modal modal-with-tabs'
    });

    metaTitleModal
        .setHeader(gptI18n.generateMetaTitle)
        .setBody(
            '<div>' + ChatGptForm.metaDataForm() + '</div>'
        )
    ;
    // END init meta title form //////////////////////////////////

    // init meta description form ////////////////////////////////////
    var metaDescriptionModal = new ChatGptModal({
        closable: false,
        keyboard: false,
        backdrop: false,
        class: 'black-modal modal-with-tabs'
    });

    metaDescriptionModal
        .setHeader(gptI18n.generateMetaDescription)
        .setBody(
            '<div>' + ChatGptForm.metaDataForm() + '</div>'
        )
    ;
    // END init meta description form //////////////////////////////////

    // init seo tags form ////////////////////////////////////
    var seoTagsModal = new ChatGptModal({
        closable: false,
        keyboard: false,
        backdrop: false,
        class: 'black-modal modal-with-tabs'
    });

    seoTagsModal
        .setHeader(gptI18n.generateSeoTags)
        .setBody(
            '<div>' + ChatGptForm.metaDataForm() + '</div>'
        )
    ;
    // END init seo tags form //////////////////////////////////

    function translateEventHandler (e) {
        e.preventDefault();

        var button = $(this);

        trasnalationModal.setBody(
            '<div>' + ChatGptForm.traslationForm() + '</div>'
        ).setActions([])
        .addAction({
            title: gptI18n.buttonCancel,
            class: 'btn btn-outline-secondary'
        }, function (cancelButton) {
            cancelButton.getModal().destroy();
        }).addAction({
            title: gptI18n.buttonTranslate,
        }, async function (actionInstance) {
            try {
                // define translate options
                var options = {
                    replace: true,
                    originLanguageId: +$('input[name="origin_language"]:checked').val(),
                    targetLanguages: [],
                };

                if (isNaN(options.originLanguageId) || options.originLanguageId == 0) {
                    alert('Please choose the origin language');
                    return;
                }

                // define selected languages
                $('.gpt-languages-list').each(function () {
                    var value = +($(this).is(':checked') ? this.value : 0);
                    if (
                        value != 0 &&
                        options.targetLanguages.indexOf(value) == -1 &&
                        value != options.originLanguageId // ignore origin language
                    ) {
                        options.targetLanguages.push(value);
                    }
                });

                if (options.targetLanguages.length == 0) {
                    alert(gptI18n.pleaseSelectLanguages);
                    return;
                }

                var contentEditorPreffix = button.data('content-editor-preffix');
                if (!!contentEditorPreffix == false) {
                    console.warn('The content editor is not set');
                    return;
                }
		var gptEditedtext = document.querySelector('#gpt_edited_text');

                ChatGptContent.renderLoaderlayer($('body'));
                try {
                    for (var langIndex = 0; langIndex < options.targetLanguages.length; langIndex ++) {
                        var content = new ChatGptContent();
                        var editor = document.getElementById(contentEditorPreffix + options.originLanguageId);
                        var text = content.getContentFromEditor(editor, 'html');

                        var translatedContent = await content.translateText(text, {
                            fromLangauge: content.getLanguageById(options.originLanguageId).iso_code,
                            toLanguage: content.getLanguageById(options.targetLanguages[langIndex]).iso_code,
                            entity: button.data('entity')
                        }, true);

                        if (typeof translatedContent.inQueue != 'undefined' && translatedContent.inQueue) {
                            translatedContent = await content.awaitRequestResponse(translatedContent.requestId);

                            if (translatedContent && translatedContent.status != 'success') {
                                if (translatedContent.status == 'quota_over') {
                                    var errorMessage = gptI18n.subscriptionLimitЕxceeded;
                                } else {
                                    var errorMessage = translatedContent.text;
                                }
                                handleModalError(
                                    actionInstance.getModal(),
                                    'Language: ' + content.getLanguageById(options.targetLanguages[langIndex]).name + '<br/>' + errorMessage
                                );

                                ChatGptContent.removeLoaderLayer();
                                return;
                            }
                        }

                        if (translatedContent && translatedContent.text) {
                            editor = document.getElementById(contentEditorPreffix + options.targetLanguages[langIndex]);
                            content.setContentIntoEditor(
                                (editor.tagName == 'INPUT' ? translatedContent.text : content.convertTextToHtml(translatedContent.text)),
                                {format: 'html'},
                                editor
                            );

                            var editorId = editor.getAttribute('id');
                            if (editorId.includes('_seo_tags_')) {
                                content.setContentIntoTags(translatedContent.text, editor);
                            }

                            window.showSuccessMessage('Language: ' + content.getLanguageById(options.targetLanguages[langIndex]).iso_code.toUpperCase() + ': ' + gptI18n.successMessage.replace(/\%words\%/g, translatedContent.nbWords));
                        }
                        gptEditedtext.value = 1;
                    }
                } catch (err) {
                    ChatGptContent.removeLoaderLayer();
                    handleModalError(
                        actionInstance.getModal(),
                        'Language: ' + (new ChatGptContent()).getLanguageById(options.targetLanguages[langIndex]).name + '<br/>' + err
                    );
                    return;
                }
            } catch (err) {
                ChatGptContent.removeLoaderLayer();
                handleModalError(actionInstance.getModal(), err);
                return;
            }

            ChatGptContent.removeLoaderLayer();
            actionInstance.getModal().destroy();
        });

        trasnalationModal.open();
    };

    window.GptTranslateEventHandler = translateEventHandler;

    function rewriteEventHandler (e) {
        e.preventDefault();

        var button = $(this);

        rewriteModal.setBody(
            '<div>' + ChatGptForm.rewriteForm() + '</div>'
        ).setActions([])
        .addAction({
            title: gptI18n.buttonCancel,
            class: 'btn btn-outline-secondary'
        }, function (cancelButton) {
            cancelButton.getModal().destroy();
        }).addAction({
            title: gptI18n.buttonRewrite,
        }, async function (actionInstance) {
            try {
                // define translate options
                var options = {
                    entity: button.data('entity'),
                    replace: +$("#allow_gen_content_0").is(':checked'),
                    fieldName: button.data('field-name'),
                    languages: [],
                };

                // define selected languages
                $('.gpt-languages-list').each(function () {
                    var value = +($(this).is(':checked') ? this.value : 0);
                    if (value != 0 && options.languages.indexOf(value) == -1) {
                        options.languages.push(value);
                    }
                });

                if (options.languages.length == 0) {
                    alert(gptI18n.pleaseSelectLanguages);
                    return;
                }

                var contentEditorPreffix = button.data('content-editor-preffix');
                if (!!contentEditorPreffix == false) {
                    console.warn('The content editor is not set');
                    return;
                }
		var gptEditedtext = document.querySelector('#gpt_edited_text');
                ChatGptContent.renderLoaderlayer($('body'));
                try {
                    for (var langIndex = 0; langIndex < options.languages.length; langIndex ++) {
                        var content = new ChatGptContent();
                        var editor = document.getElementById(contentEditorPreffix + options.languages[langIndex]);
                        var text = content.getContentFromEditor(editor, 'html');
                        options.idLang = options.languages[langIndex];

                        var rewriteContent = await content.rewriteText(text, options, true);

                        if (typeof rewriteContent.inQueue != 'undefined' && rewriteContent.inQueue) {
                            rewriteContent = await content.awaitRequestResponse(rewriteContent.requestId);

                            if (rewriteContent && rewriteContent.status != 'success') {
                                if (rewriteContent.status == 'quota_over') {
                                    var errorMessage = gptI18n.subscriptionLimitЕxceeded;
                                } else {
                                    var errorMessage = rewriteContent.text;
                                }
                                handleModalError(
                                    actionInstance.getModal(),
                                    'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + errorMessage
                                );

                                ChatGptContent.removeLoaderLayer();
                                return;
                            }
                        }

                        if (rewriteContent && rewriteContent.text) {
                            editor = document.getElementById(contentEditorPreffix + options.languages[langIndex]);

                            var newText = '';
                            if (editor.tagName == 'INPUT') {
                                newText = rewriteContent.text;
                            } else {
                                newText = content.convertTextToHtml(rewriteContent.text);
                            }

                            if (options.replace == false) {
                                newText = content.getContentFromEditor(editor, 'html') + ' ' + newText;
                            }

                            content.setContentIntoEditor(
                                newText,
                                {format: 'html'},
                                editor
                            );

                            window.showSuccessMessage('Language: ' + content.getLanguageById(options.languages[langIndex]).iso_code.toUpperCase() + ': ' + gptI18n.successMessage.replace(/\%words\%/g, rewriteContent.nbWords));
                        }
                        gptEditedtext.value = 1;
                    }
                } catch (err) {
                    ChatGptContent.removeLoaderLayer();
                    handleModalError(
                        actionInstance.getModal(),
                        'Language: ' + (new ChatGptContent()).getLanguageById(options.languages[langIndex]).name + '<br/>' + err
                    );
                    return;
                }
            } catch (err) {
                ChatGptContent.removeLoaderLayer();
                handleModalError(actionInstance.getModal(), err);
                return;
            }

            ChatGptContent.removeLoaderLayer();
            actionInstance.getModal().destroy();
        });

        rewriteModal.open(function () {
            // init tooltips
            $(".gpt-tooltip").popover();
        });
    };

    window.GptRewriteEventHandler = rewriteEventHandler;

    /**
     * Handle error and print in modal body
     */
    function handleModalError (modal, errorMessage) {
        if (!!modal.find('.progress-bar') && modal.find('.progress-bar').length) {
            progressBar = modal.find('.progress-bar');
            progressBar.removeClass('progress-bar-success');
            progressBar.addClass('progress-bar-danger');
            modal.find('#process_translate_status').text(gptI18n.bulkTranslationProcessFail);
            modal.find("#process_translate_error_log").show().text(errorMessage);
        } else {
            // clean body
            modal.find('body').html('');
            // render message
            renderAlertMessage(errorMessage, modal.find('body'));
        }

        // render close button
        modal
            .setActions([])
            .addAction({
                    title: gptI18n.buttonClose,
                    class: 'btn btn-outline-secondary'
                }, function (closeButton) {
                    closeButton.getModal().destroy();
                })
            .renderActions();
    }

    function displayRenewLimitsModal (message) {
        ChatGptForm.displayRenewLimitsModal(message);
    }

    if (adminPageName == 'productForm') {
        if (!gptShopInfo.subscription || gptShopInfo.subscription.availableProductWords == 0) {
            if (!gptShopInfo.subscription || !gptShopInfo.subscription.plan) {
                // renderAlertMessage(gptI18n.subscriptionNotAvaialable, $("#description"));
                renderAlertMessage(gptI18n.subscriptionNotAvaialable, $(gptVarVersion.selectors.pfDescription));
                displayRenewLimitsModal(gptI18n.subscriptionNotAvaialable);
            } else if (gptShopInfo.subscription.plan.productWords == 0) {
                // renderAlertMessage(gptI18n.subscriptionPlanNoFeature, $("#description"));
                renderAlertMessage(gptI18n.subscriptionPlanNoFeature, $(gptVarVersion.selectors.pfDescription));
                displayRenewLimitsModal(gptI18n.subscriptionPlanNoFeature);
            }  else if (gptShopInfo.subscription.availableProductWords == 0) {
                // renderAlertMessage(gptI18n.subscriptionLimitЕxceeded + ' ' + gptI18n.renewOrOrderSubscription, $("#description"));
                renderAlertMessage(gptI18n.subscriptionLimitЕxceeded + ' ' + gptI18n.renewOrOrderSubscription, $(gptVarVersion.selectors.pfDescription));
                displayRenewLimitsModal(gptI18n.subscriptionLimitЕxceeded);
            }
            return;
        } else if (gptShopInfo.subscription.ownApiKey && gptShopInfo.hasGptApiKey == false) {
            renderAlertMessage(gptI18n.gptApiKeyNotSet, $(gptVarVersion.selectors.pfDescription));
            // displayRenewLimitsModal(gptI18n.gptApiKeyNotSet);
            return;
        }

        $(".summary-description-container").css('overflow', 'visible');

        var actionObject = (new ChatGptAction({
            id: "gpt_description_button",
            title: gptI18n.buttonName,
            type: 'single'
        }))
            // .renderInto($("#description"));
            .renderInto($(gptVarVersion.selectors.pfDescription));

        var generateProductMetaTitleObject = (new ChatGptAction({
            id: "gpt_generate_meta_title_button",
            title: gptI18n.buttonGenerate,
            type: 'single',
        }))
            .renderInto($('#product_seo_meta_title_help'), 'after');

        var generateProductMetaDescriptionObject = (new ChatGptAction({
            id: "gpt_generate_meta_description_button",
            title: gptI18n.buttonGenerate,
            type: 'single',
        }))
            .renderInto($('#product_seo_meta_description_help'), 'after');

        var generateProductSeoTagsObject = (new ChatGptAction({
            id: "gpt_generate_tags_button",
            title: gptI18n.buttonGenerate,
            contentEditorPreffix: 'product_seo_tags_',
            type: 'single',
        }))
            .renderInto($('#product_seo_tags_help'), 'after');

        // $(".gpt-tooltip").popover();

        if (gptShopInfo.subscription.plan.customRequest) {
            // renderCustomRequestForm($("#description"), {
            //     contentEditorPreffix: 'form_step1_description_',
            renderCustomRequestForm($(gptVarVersion.selectors.pfDescription), {
                contentEditorPreffix: gptVarVersion.contentEditorPreffix.description,
                entity: 'product',
            });
        }

        //rewrite product short description button
        var rewriteProductShortDescriptionObject = (new ChatGptAction({
            entity: 'product',
            id: "gpt_rewrite_description_short_button",
            title: gptI18n.buttonRewrite,
            type: 'single',
            // contentEditorPreffix: 'form_step1_description_short_',
            contentEditorPreffix: gptVarVersion.contentEditorPreffix.descriptionShort,
            fieldName: 'description'
        }))
            // .renderInto($("#description_short"));
            .renderInto($(gptVarVersion.selectors.pfDescriptionShort));

        //rewrite product description button
        var rewriteProductDescriptionObject = (new ChatGptAction({
            entity: 'product',
            id: "gpt_rewrite_description_button",
            title: gptI18n.buttonRewrite,
            type: 'button',
            // contentEditorPreffix: 'form_step1_description_',
            contentEditorPreffix: gptVarVersion.contentEditorPreffix.description,
            fieldName: 'description'
        }))
            // .renderInto($("#description .gpt-button-wraper"));
            .renderInto($(gptVarVersion.selectors.pfDescription + " .gpt-button-wraper"));

        rewriteProductShortDescriptionObject.getButton().on('click', rewriteEventHandler);
        rewriteProductDescriptionObject.getButton().on('click', rewriteEventHandler);

        if (gptLanguages.length > 1) {
            // translate product name button
            var translateProductNameObject = new ChatGptTranslateAction({
                entity: 'product',
                languages: gptLanguages,
                wrapperSelector: '#form_step1_name',
                // contentEditorPreffix: 'form_step1_name_',
                contentEditorPreffix: gptVarVersion.contentEditorPreffix.name,
                type: 'button',
                title: gptI18n.buttonTranslate,
                buttonClass: 'btn btn-primary mt-2',
            });
                // .renderInto($("#form_step1_names").closest('.row').parent(), 'append');

            if (gptIsNewVersion) {
                translateProductNameObject.renderInto($("#product_header .product-type-preview"), 'before');
            } else {
                translateProductNameObject.renderInto($("#form_step1_names").closest('.row').parent(), 'append');
            }

            // translate product short description button
            var translateProductShortDescriptionObject = new ChatGptTranslateAction({
                entity: 'product',
                languages: gptLanguages,
                // wrapperSelector: '#description_short',
                // contentEditorPreffix: 'form_step1_description_short_',
                wrapperSelector: gptVarVersion.selectors.pfDescriptionShort,
                contentEditorPreffix: gptVarVersion.contentEditorPreffix.descriptionShort,
                buttonClass: 'btn btn-primary mr-2',
                type: 'button',
                title: gptI18n.buttonTranslate
            })
                // .renderInto($("#description_short .gpt-button-wraper"), 'prepend');
                .renderInto($(gptVarVersion.selectors.pfDescriptionShort + " .gpt-button-wraper"), 'prepend');

            // translate product description button
            var translateProductDescriptionObject = new ChatGptTranslateAction({
                entity: 'product',
                languages: gptLanguages,
                wrapperSelector: gptVarVersion.selectors.pfDescription,
                contentEditorPreffix: gptVarVersion.contentEditorPreffix.description,
                buttonClass: 'btn btn-primary ml-2 mr-2',
                type: 'button',
                title: gptI18n.buttonTranslate
            })
                // .renderInto($("#description #gpt_description_button"), 'after');
                .renderInto($(gptVarVersion.selectors.pfDescription + " #gpt_description_button"), 'after');

            // translate product seo meta title
            var translateProductSeoMetaTitleObject = new ChatGptTranslateAction({
                entity: 'product',
                languages: gptLanguages,
                wrapperSelector: gptVarVersion.selectors.pfMetaTitle,
                contentEditorPreffix: gptVarVersion.contentEditorPreffix.meta_title,
                buttonClass: 'btn btn-primary ml-2 mr-2',
                type: 'button',
                title: gptI18n.buttonTranslate
            })
                .renderInto($('#gpt_generate_meta_title_button'), 'after');

            // translate product seo meta description
            var translateProductMetaDescriptionObject = new ChatGptTranslateAction({
                entity: 'product',
                languages: gptLanguages,
                wrapperSelector: gptVarVersion.selectors.pfMetaDescription,
                contentEditorPreffix: gptVarVersion.contentEditorPreffix.meta_description,
                buttonClass: 'btn btn-primary ml-2 mr-2',
                type: 'button',
                title: gptI18n.buttonTranslate
            })
                .renderInto($('#gpt_generate_meta_description_button'), 'after');

            //translate product seo tags
            var translateProductSeoTagsObject = new ChatGptTranslateAction({
                entity: 'product',
                languages: gptLanguages,
                wrapperSelector: gptVarVersion.selectors.pfSeoTags,
                contentEditorPreffix: gptVarVersion.contentEditorPreffix.seo_tags,
                buttonClass: 'btn btn-primary ml-2 mr-2',
                type: 'button',
                title: gptI18n.buttonTranslate
            })
                .renderInto($('#gpt_generate_tags_button'), 'after');

            translateProductSeoMetaTitleObject.getButton().on('click', translateEventHandler);
            translateProductMetaDescriptionObject.getButton().on('click', translateEventHandler);
            translateProductSeoTagsObject.getButton().on('click', translateEventHandler);

            translateProductShortDescriptionObject.getButton().on('click', translateEventHandler);
            translateProductNameObject.getButton().on('click', translateEventHandler);
            translateProductDescriptionObject.getButton().on('click', translateEventHandler);
            // actionObject.setActions([{element:translateProductDescriptionObject.renderHtml(), callback: translateEventHandler}]);
        }

        //product post
        var productPostObject = (new ChatGptAction({
            entity: 'product',
            id: "gpt_product_post_button",
            title: 'Generate blog post for product',
            type: 'button',
            class: 'btn btn-primary ' + (gptLanguages.length > 1 ? 'ml-2' : '') + ' mt-2',
            contentEditorPreffix: '',
            fieldName: false
        }));
            // .renderInto($("#form_step1_names").closest('.row').parent(), 'append');
        if (gptIsNewVersion) {
            productPostObject.renderInto($("#product_header .product-type-preview"), 'before');
        } else {
            productPostObject.renderInto($("#form_step1_names").closest('.row').parent(), 'append');
        }

        productPostObject.getButton().on('click', function () {
            GptPostContent.productPostEventHandler(productPostModal, function (modal) {
                var content = new ChatGptContent(),
                    idDefaultCategory = 0;
                $('input.default-category').each(function () {
                    if ($(this).is(':checked')) {
                        idDefaultCategory = +this.value
                    }
                });

                return {
                    productName: $("#form_step1_name_" + content.getPageLanguageId()).val(),
                    idDefaultCategory: idDefaultCategory,
                    idBrand: !!+$("#form_step1_id_manufacturer").val() && $("#form_step1_id_manufacturer").val(),
                }
            }, function (modal, posts, products) {
                // close current modal
                modal.destroy();

                // display new popup with the posts list
                var postsModal = new ChatGptModal({
                    closable: false,
                    keyboard: false,
                    backdrop: false,
                    class: 'black-modal modal-with-tabs product-post-modal'
                });

                postsModal
                    .setHeader(gptI18n.productPostTitle)
                    .setBody(
                            '<div class="alert alert-success" role="alert">' +
                                '<p class="alert-text">' + gptI18n.bulkGenerationProcessCompleted + '</p>' +
                            '</div>' +
                            '<table class="table">' +
                                '<thead>' +
                                    '<tr>' +
                                        '<th>' + 'Id' + '</th>' +
                                        '<th>' + 'Title' + '</th>' +
                                        '<th></th>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                    (function () {
                                        var output = '';
                                        for (var i = 0; i < posts.length; i ++) {
                                            output += '<tr>' +
                                                            '<td>' + posts[i].id + '</td>' +
                                                            '<td>' + posts[i].title + '</td>' +
                                                            '<td><a href="' + gptPostEditUrl + '&id_gptcontent_post=' + posts[i].id + '" target="_blank">edit</a></td>' +
                                                        '</tr>';
                                        }
                                        return output;
                                    }()) +
                                '</tbody>' +
                            '</table>'
                        )
                    .addAction({
                            title: gptI18n.buttonCancel,
                            class: 'btn btn-outline-secondary'
                        }, function (cancelButton) {
                            cancelButton.getModal().destroy();
                        })
                    .open(function () {
                        // init tooltips
                        $(".gpt-tooltip").popover();
                    })
                ;
            });
        });

        actionObject.getButton().on('click', function (e) {
            e.preventDefault();

            descriptionModal.setBody(
                '<div>' + ChatGptForm.descriptionForm() + '</div>'
            ).setActions([])
            .addAction({
                title: gptI18n.buttonCancel,
                class: 'btn btn-outline-secondary'
            }, function (cancelButton) {
                cancelButton.getModal().destroy();
            }).addAction({
                title: gptI18n.buttonRegenerate,
            }, async function (actionInstance) {
                // define bulk options
                var options = {
                    replace: +$("#allow_gen_content_0").is(':checked'),
                    skipExistingContent: 0, // +$("#skip_existing_content_1").is(':checked'),
                    maxWords: +$("#gpt_description_length").val(),
                    languages: [],
                    useProductCategory: +$("#use_product_category_1").is(':checked'),
                    useProductBrand: +$("#use_product_brand_1").is(':checked'),
                    useProductEan: +$("#use_product_ean_1").is(':checked'),
                    contentType: $('input[name="desc_or_characteristics"]:checked').val(),
                    idDefaultCategory: 0,
                    // idBrand: !!+$("#form_step1_id_manufacturer").val() && $("#form_step1_id_manufacturer").val(),
                    idBrand: !!+$(gptVarVersion.selectors.pfManufacturerId).val() && $(gptVarVersion.selectors.pfManufacturerId).val(),
                    idContentTemplate: +$('select#id_content_template').val()
                };

                if (options.idContentTemplate > 0) {
                    options.languages = gptContentTemplates[options.idContentTemplate].langs;
                } else {
                    // define selected languages
                    $('.gpt-languages-list').each(function () {
                        var value = +($(this).is(':checked') ? this.value : 0);
                        if (value != 0 && options.languages.indexOf(value) == -1) {
                            options.languages.push(value);
                        }
                    });
                }

                if (isNaN(options.maxWords) || options.maxWords < gptPageSettings[adminPageName].minWords) {
                    alert(gptI18n.maxWordsNotValid.replace('%min_words%', gptPageSettings[adminPageName].minWords));
                    return;
                }

                if (options.languages.length == 0) {
                    alert(gptI18n.pleaseSelectLanguages);
                    return;
                }

                $('input.default-category').each(function () {
                    if ($(this).is(':checked')) {
                        options.idDefaultCategory = +this.value
                    }
                });

                var content = new ChatGptContent(),
                    productName = '';

                ChatGptContent.renderLoaderlayer($('body'));

                for (var langIndex = 0; langIndex < options.languages.length; langIndex ++) {
                    try {
                        options.idLang = options.languages[langIndex];
                        // productName = $("#form_step1_name_" + options.idLang).val();
                        productName = $(gptVarVersion.selectors.pfName + options.idLang).val();
                        var description = await content.getProductDescription(productName, options, true);

			var gptEditedtext = document.querySelector('#gpt_edited_text');

                        if (typeof description.inQueue != 'undefined' && description.inQueue) {
                            description = await content.awaitRequestResponse(description.requestId);

                            // display error message if the request is failure
                            if (description && description.status != 'success') {
                                if (description.status == 'quota_over') {
                                    var errorMessage = gptI18n.subscriptionLimitЕxceeded;
                                } else {
                                    var errorMessage = description.text;
                                }

                                handleModalError(
                                    actionInstance.getModal(),
                                    'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + errorMessage
                                );

                                ChatGptContent.removeLoaderLayer();
                                return;
                            }
                        }

                        if (description && description.text) {
                            var text = content.convertTextToHtml(description.text);
                            if (options.replace == false) {
                                // text = content.getContentFromEditor(document.getElementById('form_step1_description_' + options.languages[langIndex]), 'html') + text;
                                text = content.getContentFromEditor(document.getElementById(gptVarVersion.contentEditorPreffix.description + options.languages[langIndex]), 'html') + text;
                            }

                            content.setContentIntoEditor(
                                text,
                                {format: 'html'},
                                // tinymce.get('form_step1_description_' + options.languages[langIndex])
                                tinymce.get(gptVarVersion.contentEditorPreffix.description + options.languages[langIndex])
                            );

                            window.showSuccessMessage('Language: ' + content.getLanguageById(options.languages[langIndex]).iso_code.toUpperCase() + ': ' + gptI18n.successMessage.replace(/\%words\%/g, description.nbWords));
                        }
                        gptEditedtext.value = 1;
                    } catch (err) {
                        ChatGptContent.removeLoaderLayer();
                        handleModalError(
                            actionInstance.getModal(),
                            'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + err
                        );
                        return;
                    }
                }
                ChatGptContent.removeLoaderLayer();
                actionInstance.getModal().destroy();
            });

            descriptionModal.open(function () {
                // init tooltips
                $(".gpt-tooltip").popover();
            });
        });
        generateProductMetaTitleObject.getButton().on('click', function (e) {
            e.preventDefault();

            metaTitleModal.setBody(
                '<div>' + ChatGptForm.metaDataForm() + '</div>'
            ).setActions([])
                .addAction({
                    title: gptI18n.buttonCancel,
                    class: 'btn btn-outline-secondary'
                }, function (cancelButton) {
                    cancelButton.getModal().destroy();
                }).addAction({
                title: gptI18n.buttonRegenerate,
            }, async function (actionInstance) {
                // define bulk options
                var options = {
                    languages: [],
                    useProductDescription: +$("#use_product_description_1").is(':checked'),
                    entity: 'product',
                };

                $('.gpt-languages-list').each(function () {
                    var value = +($(this).is(':checked') ? this.value : 0);
                    if (value != 0 && options.languages.indexOf(value) == -1) {
                        options.languages.push(value);
                    }
                });

                if (options.languages.length == 0) {
                    alert(gptI18n.pleaseSelectLanguages);
                    return;
                }

                var content = new ChatGptContent(),
                    productName = '';

                var productDescription = '';

                ChatGptContent.renderLoaderlayer($('body'));

                for (var langIndex = 0; langIndex < options.languages.length; langIndex ++) {
                    var requestText = 'Generate meta title for product. Generated text length have not exceed 70 characters. Generate text in a language: ' + content.getLanguageById(options.languages[langIndex]).name + '. ';
                    try {
                        options.idLang = options.languages[langIndex];
                        // productName = $("#form_step1_name_" + options.idLang).val();
                        productName = $(gptVarVersion.selectors.pfName + options.idLang).val();
                        productDescription = $('#product_description_description_' + options.idLang).val();
                        if (options.useProductDescription) {
                            requestText += 'Generate text based on product description: ' + productDescription + '. ';
                            var meta_title = await content.customRequest(requestText, options, true);
                        } else {
                            requestText += 'Generate text based on product name: ' + productName + '. ';
                            var meta_title = await content.customRequest(requestText, options, true);
                        }

                        if (typeof meta_title.inQueue != 'undefined' && meta_title.inQueue) {
                            meta_title = await content.awaitRequestResponse(meta_title.requestId);

                            // display error message if the request is failure
                            if (meta_title && meta_title.status != 'success') {
                                if (meta_title.status == 'quota_over') {
                                    var errorMessage = gptI18n.subscriptionLimitЕxceeded;
                                } else {
                                    var errorMessage = meta_title.text;
                                }

                                handleModalError(
                                    actionInstance.getModal(),
                                    'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + errorMessage
                                );

                                ChatGptContent.removeLoaderLayer();
                                return;
                            }
                        }

                        if (meta_title && meta_title.text) {
                            var text = content.convertTextToHtml(meta_title.text);

                            content.setContentIntoEditor(
                                meta_title.text,
                                {format: 'html'},
                                'product_seo_meta_title_' + options.languages[langIndex]
                            );

                            window.showSuccessMessage('Language: ' + content.getLanguageById(options.languages[langIndex]).iso_code.toUpperCase() + ': ' + gptI18n.successMessage.replace(/\%words\%/g, meta_title.nbWords));
                        }
                    } catch (err) {
                        ChatGptContent.removeLoaderLayer();
                        handleModalError(
                            actionInstance.getModal(),
                            'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + err
                        );
                        return;
                    }
                }
                ChatGptContent.removeLoaderLayer();
                actionInstance.getModal().destroy();
            });

            metaTitleModal.open(function () {
                // init tooltips
                $(".gpt-tooltip").popover();
            });
        });

        generateProductMetaDescriptionObject.getButton().on('click', function (e) {
            e.preventDefault();

            metaDescriptionModal.setBody(
                '<div>' + ChatGptForm.metaDataForm() + '</div>'
            ).setActions([])
                .addAction({
                    title: gptI18n.buttonCancel,
                    class: 'btn btn-outline-secondary'
                }, function (cancelButton) {
                    cancelButton.getModal().destroy();
                }).addAction({
                title: gptI18n.buttonRegenerate,
            }, async function (actionInstance) {
                // define bulk options
                var options = {
                    languages: [],
                    useProductDescription: +$("#use_product_description_1").is(':checked'),
                    entity: 'product',
                };

                $('.gpt-languages-list').each(function () {
                    var value = +($(this).is(':checked') ? this.value : 0);
                    if (value != 0 && options.languages.indexOf(value) == -1) {
                        options.languages.push(value);
                    }
                });

                if (options.languages.length == 0) {
                    alert(gptI18n.pleaseSelectLanguages);
                    return;
                }

                var content = new ChatGptContent(),
                    productName = '';

                var productDescription = '';

                ChatGptContent.renderLoaderlayer($('body'));

                for (var langIndex = 0; langIndex < options.languages.length; langIndex ++) {
                    var requestText = 'Generate meta description for product. Generated text length have not exceed 160 characters. Generate text in a language: ' + content.getLanguageById(options.languages[langIndex]).name + '. ';
                    try {
                        options.idLang = options.languages[langIndex];
                        // productName = $("#form_step1_name_" + options.idLang).val();
                        productName = $(gptVarVersion.selectors.pfName + options.idLang).val();
                        productDescription = $('#product_description_description_' + options.idLang).val();
                        if (options.useProductDescription) {
                            requestText += 'Generate text based on product description: ' + productDescription + '. ';
                            var meta_description = await content.customRequest(requestText, options, true);
                        } else {
                            requestText += 'Generate text based on product name: ' + productName + '. ';
                            var meta_description = await content.customRequest(requestText, options, true);
                        }

                        if (typeof meta_description.inQueue != 'undefined' && meta_description.inQueue) {
                            meta_description = await content.awaitRequestResponse(meta_description.requestId);

                            // display error message if the request is failure
                            if (meta_description && meta_description.status != 'success') {
                                if (meta_description.status == 'quota_over') {
                                    var errorMessage = gptI18n.subscriptionLimitЕxceeded;
                                } else {
                                    var errorMessage = meta_description.text;
                                }

                                handleModalError(
                                    actionInstance.getModal(),
                                    'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + errorMessage
                                );

                                ChatGptContent.removeLoaderLayer();
                                return;
                            }
                        }

                        if (meta_description && meta_description.text) {
                            var text = content.convertTextToHtml(meta_description.text);

                            content.setContentIntoEditor(
                                meta_description.text,
                                {format: 'html'},
                                'product_seo_meta_description_' + options.languages[langIndex]
                            );

                            window.showSuccessMessage('Language: ' + content.getLanguageById(options.languages[langIndex]).iso_code.toUpperCase() + ': ' + gptI18n.successMessage.replace(/\%words\%/g, meta_description.nbWords));
                        }
                    } catch (err) {
                        ChatGptContent.removeLoaderLayer();
                        handleModalError(
                            actionInstance.getModal(),
                            'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + err
                        );
                        return;
                    }
                }
                ChatGptContent.removeLoaderLayer();
                actionInstance.getModal().destroy();
            });

            metaDescriptionModal.open(function () {
                // init tooltips
                $(".gpt-tooltip").popover();
            });

        });

        generateProductSeoTagsObject.getButton().on('click', function (e) {
            e.preventDefault();
            var button = $(this);
            seoTagsModal.setBody(
                '<div>' + ChatGptForm.metaDataForm() + '</div>'
            ).setActions([])
                .addAction({
                    title: gptI18n.buttonCancel,
                    class: 'btn btn-outline-secondary'
                }, function (cancelButton) {
                    cancelButton.getModal().destroy();
                }).addAction({
                title: gptI18n.buttonRegenerate,
            }, async function (actionInstance) {
                // define bulk options
                var options = {
                    languages: [],
                    useProductDescription: +$("#use_product_description_1").is(':checked'),
                    entity: 'product',
                };

                $('.gpt-languages-list').each(function () {
                    var value = +($(this).is(':checked') ? this.value : 0);
                    if (value != 0 && options.languages.indexOf(value) == -1) {
                        options.languages.push(value);
                    }
                });

                if (options.languages.length == 0) {
                    alert(gptI18n.pleaseSelectLanguages);
                    return;
                }
                var contentEditorPreffix = button.data('content-editor-preffix');

                var content = new ChatGptContent(),
                    productName = '';

                var productDescription = '';

                ChatGptContent.renderLoaderlayer($('body'));

                for (var langIndex = 0; langIndex < options.languages.length; langIndex ++) {
                    var requestText = 'Generate keywords tags for product. Format of tags must be: ' + 'word1,word2,word3...etc' + '. The number of generated tags have not exceed 15 tags. Generate keywords tags in a language: ' + content.getLanguageById(options.languages[langIndex]).name + '. ';
                    try {
                        var editor = document.getElementById(contentEditorPreffix + options.languages[langIndex]);
                        options.idLang = options.languages[langIndex];
                        // productName = $("#form_step1_name_" + options.idLang).val();
                        productName = $(gptVarVersion.selectors.pfName + options.idLang).val();
                        productDescription = $('#product_description_description_' + options.idLang).val();
                        if (options.useProductDescription) {
                            requestText += 'Generate keywords tags based on product description: ' + productDescription + '. ';
                            var seo_tags = await content.customRequest(requestText, options, true);
                        } else {
                            requestText += 'Generate keywords tags based on product name: ' + productName + '. ';
                            var seo_tags = await content.customRequest(requestText, options, true);
                        }

                        if (typeof seo_tags.inQueue != 'undefined' && seo_tags.inQueue) {
                            seo_tags = await content.awaitRequestResponse(seo_tags.requestId);

                            // display error message if the request is failure
                            if (seo_tags && seo_tags.status != 'success') {
                                if (seo_tags.status == 'quota_over') {
                                    var errorMessage = gptI18n.subscriptionLimitЕxceeded;
                                } else {
                                    var errorMessage = seo_tags.text;
                                }

                                handleModalError(
                                    actionInstance.getModal(),
                                    'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + errorMessage
                                );

                                ChatGptContent.removeLoaderLayer();
                                return;
                            }
                        }

                        if (seo_tags && seo_tags.text) {

                            content.setContentIntoTags(
                                seo_tags.text,
                                editor,
                            );

                            window.showSuccessMessage('Language: ' + content.getLanguageById(options.languages[langIndex]).iso_code.toUpperCase() + ': ' + gptI18n.successMessage.replace(/\%words\%/g, seo_tags.nbWords));
                        }
                    } catch (err) {
                        ChatGptContent.removeLoaderLayer();
                        handleModalError(
                            actionInstance.getModal(),
                            'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + err
                        );
                        return;
                    }
                }
                ChatGptContent.removeLoaderLayer();
                actionInstance.getModal().destroy();
            });

            seoTagsModal.open(function () {
                // init tooltips
                $(".gpt-tooltip").popover();
            });
        });

    } else if (adminPageName == 'categoryForm') {
        var gptWidgetSettings = {
            descriptionWrapper: $("#category_description"),
            descriptionEditorPrefix: 'category_description_',
            descriptionWrapperSelector: '#category_description',
            nameWrapper: $('label[for="category_name"] + div'),
            nameWrapperSelector: 'label[for=\'category_name\'] + div',
            nameEditorPrefix: 'category_name_',
        };
        if (isLegacyController) {
            gptWidgetSettings.descriptionWrapper = $("#description_" + (new ChatGptContent).getPageLanguageId())
                .closest('.translatable-field')
                .parent()
                .addClass('category-description-wrapper');
            gptWidgetSettings.descriptionWrapperSelector = '.category-description-wrapper';
            gptWidgetSettings.descriptionEditorPrefix = 'description_';
            gptWidgetSettings.nameWrapper = $("#name_" + (new ChatGptContent).getPageLanguageId())
                .closest('.translatable-field')
                .parent()
                .addClass('category-name-wrapper');
            gptWidgetSettings.nameWrapperSelector = '.category-name-wrapper';
            gptWidgetSettings.nameEditorPrefix = 'name_';
        }
        if (!gptShopInfo.subscription || gptShopInfo.subscription.availableCategoryWords == 0) {
            if (!gptShopInfo.subscription || !gptShopInfo.subscription.plan) {
                renderAlertMessage(gptI18n.subscriptionNotAvaialable, gptWidgetSettings.descriptionWrapper);
                displayRenewLimitsModal(gptI18n.subscriptionNotAvaialable);
            } else if (gptShopInfo.subscription.plan.categoryWords == 0) {
                renderAlertMessage(gptI18n.subscriptionPlanNoFeature, gptWidgetSettings.descriptionWrapper);
                displayRenewLimitsModal(gptI18n.subscriptionPlanNoFeature);
            }  else if (gptShopInfo.subscription.availableCategoryWords == 0) {
                renderAlertMessage(gptI18n.subscriptionLimitЕxceeded + ' ' + gptI18n.renewOrOrderSubscription, gptWidgetSettings.descriptionWrapper);
                displayRenewLimitsModal(gptI18n.subscriptionLimitЕxceeded);
            }
            return;
        } else if (gptShopInfo.subscription.ownApiKey && gptShopInfo.hasGptApiKey == false) {
            renderAlertMessage(gptI18n.gptApiKeyNotSet, gptWidgetSettings.descriptionWrapper);
            // displayRenewLimitsModal(gptI18n.gptApiKeyNotSet);
            return;
        }

        var contentAction = (new ChatGptAction({
            id: "gpt_description_button",
            title: gptI18n.buttonName,
            type: 'single'
        }))
            .renderInto(gptWidgetSettings.descriptionWrapper);

        //rewrite category description button
        var rewriteCategoryDescriptionObject = (new ChatGptAction({
            entity: 'category',
            id: "gpt_rewrite_description_button",
            title: gptI18n.buttonRewrite,
            type: 'button',
            class: isLegacyController ? 'btn btn-primary ml-2' : 'btn btn-primary',
            contentEditorPreffix: gptWidgetSettings.descriptionEditorPrefix,
            fieldName: 'description'
        }))
            .renderInto(gptWidgetSettings.descriptionWrapper.find('.gpt-button-wraper'));

        rewriteCategoryDescriptionObject.getButton().on('click', rewriteEventHandler);

        if (gptLanguages.length > 1) {
            // translate category name button
            var translateNameObject = new ChatGptTranslateAction({
                entity: 'category',
                languages: gptLanguages,
                wrapperSelector: gptWidgetSettings.nameWrapperSelector,
                contentEditorPreffix: gptWidgetSettings.nameEditorPrefix,
                title: gptI18n.buttonTranslate,
                type: 'single'
            })
                .renderInto(gptWidgetSettings.nameWrapper, 'append');

            // translate category description button
            var translateCategoryDescriptionObject = new ChatGptTranslateAction({
                entity: 'category',
                languages: gptLanguages,
                wrapperSelector: gptWidgetSettings.descriptionWrapperSelector,
                contentEditorPreffix: gptWidgetSettings.descriptionEditorPrefix,
                buttonClass: 'btn btn-primary ml-2 mr-2',
                type: 'button',
                title: gptI18n.buttonTranslate
            })
                .renderInto(gptWidgetSettings.descriptionWrapper.find('#gpt_description_button'), 'after');

            translateNameObject.getButton().on('click', translateEventHandler);
            translateCategoryDescriptionObject.getButton().on('click', translateEventHandler);
            // contentAction.setActions([{element:translateCategoryDescriptionObject.renderHtml(), callback: translateEventHandler}]);
        }

        if (gptShopInfo.subscription.plan.customRequest) {
            renderCustomRequestForm(gptWidgetSettings.descriptionWrapper, {
                contentEditorPreffix: gptWidgetSettings.descriptionEditorPrefix,
                entity: 'category',
            });
        }

        contentAction.getButton().on('click', function (e) {
            e.preventDefault();

            descriptionModal.setBody(
                '<div>' + ChatGptForm.descriptionForm() + '</div>'
            ).setActions([])
            .addAction({
                title: gptI18n.buttonCancel,
                class: 'btn btn-outline-secondary'
            }, function (cancelButton) {
                cancelButton.getModal().destroy();
            }).addAction({
                title: gptI18n.buttonRegenerate,
            }, async function (actionInstance) {
                // define bulk options
                var options = {
                    replace: +$("#allow_gen_content_0").is(':checked'),
                    skipExistingContent: 0,
                    maxWords: +$("#gpt_description_length").val(),
                    languages: [],
                    idContentTemplate: +$('select#id_content_template').val(),
                };

                if (options.idContentTemplate > 0) {
                    options.languages = gptContentTemplates[options.idContentTemplate].langs;
                } else {
                    // define selected languages
                    $('.gpt-languages-list').each(function () {
                        var value = +($(this).is(':checked') ? this.value : 0);
                        if (value != 0 && options.languages.indexOf(value) == -1) {
                            options.languages.push(value);
                        }
                    });
                }

                if (isNaN(options.maxWords) || options.maxWords < gptPageSettings[adminPageName].minWords) {
                    alert(gptI18n.maxWordsNotValid.replace('%min_words%', gptPageSettings[adminPageName].minWords));
                    return;
                }

                if (options.languages.length == 0) {
                    alert(gptI18n.pleaseSelectLanguages);
                    return;
                }

                var content = new ChatGptContent(),
                    categoryName = '';

		var gptEditedtext = document.querySelector('#gpt_edited_text');

                ChatGptContent.renderLoaderlayer($('body'));

                for (var langIndex = 0; langIndex < options.languages.length; langIndex ++) {
                    try {
                        options.idLang = options.languages[langIndex];
                        categoryName = $("#" + gptWidgetSettings.nameEditorPrefix + options.idLang).val();

                        var description = await content.getCategoryDescription(categoryName, options, true);

                        if (typeof description.inQueue != 'undefined' && description.inQueue) {
                            description = await content.awaitRequestResponse(description.requestId);

                            // display error message if the request is failure
                            if (description && description.status != 'success') {
                                if (description.status == 'quota_over') {
                                    var errorMessage = gptI18n.subscriptionLimitЕxceeded;
                                } else {
                                    var errorMessage = description.text;
                                }

                                handleModalError(
                                    actionInstance.getModal(),
                                    'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + errorMessage
                                );

                                ChatGptContent.removeLoaderLayer();
                                return;
                            }
                        }

                        if (description && description.text) {
                            var text = content.convertTextToHtml(description.text);
                            if (options.replace == false) {
                                text = content.getContentFromEditor(document.getElementById(gptWidgetSettings.descriptionEditorPrefix + options.languages[langIndex]), 'html') + text;
                            }
                            content.setContentIntoEditor(
                                text,
                                {format: 'html'},
                                tinymce.get(gptWidgetSettings.descriptionEditorPrefix + options.languages[langIndex])
                            );

                            window.showSuccessMessage('Language: ' + content.getLanguageById(options.languages[langIndex]).iso_code.toUpperCase() + ': ' + gptI18n.successMessage.replace(/\%words\%/g, description.nbWords));
                        }
                        gptEditedtext.value = 1;
                    } catch (err) {
                        ChatGptContent.removeLoaderLayer();
                        handleModalError(
                            actionInstance.getModal(),
                            'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + err
                        );
                        return;
                    }
                }
                ChatGptContent.removeLoaderLayer();
                actionInstance.getModal().destroy();
            });

            descriptionModal.open(function () {
                // init tooltips
                $(".gpt-tooltip").popover();
            });
        });
    }  else if (adminPageName == 'cmsForm') {
        var gptWidgetSettings = {
            descriptionWrapper: $("#cms_page_content"),
            descriptionEditorPrefix: 'cms_page_content_',
            descriptionWrapperSelector: '#cms_page_content',
            nameWrapper: $('label[for="category_name"] + div'),
            nameWrapperSelector: 'label[for=\'category_name\'] + div',
            nameEditorPrefix: 'cms_page_title_',
        };
        if (isLegacyController) {
            gptWidgetSettings.descriptionWrapper = $("#content_" + (new ChatGptContent).getPageLanguageId())
                .closest('.translatable-field')
                .parent()
                .addClass('cms-description-wrapper');
            gptWidgetSettings.descriptionWrapperSelector = '.cms-description-wrapper';
            gptWidgetSettings.descriptionEditorPrefix = 'content_';
            gptWidgetSettings.nameWrapper = $("#name_" + (new ChatGptContent).getPageLanguageId())
                .closest('.translatable-field')
                .parent()
                .addClass('cms-name-wrapper');
            gptWidgetSettings.nameWrapperSelector = '.cms-name-wrapper';
            gptWidgetSettings.nameEditorPrefix = 'name_';
        }

        if (!gptShopInfo.subscription || gptShopInfo.subscription.availablePageWords == 0) {
            var alertMessage = '';
            if (!gptShopInfo.subscription || !gptShopInfo.subscription.plan) {
                alertMessage = gptI18n.subscriptionNotAvaialable;
                displayRenewLimitsModal(gptI18n.subscriptionNotAvaialable);
            } else if (gptShopInfo.subscription.plan.productWords == 0) {
                alertMessage = gptI18n.subscriptionPlanNoFeature;
                displayRenewLimitsModal(gptI18n.subscriptionPlanNoFeature);
            }  else if (gptShopInfo.subscription.availablePageWords == 0) {
                alertMessage = gptI18n.subscriptionLimitЕxceeded + ' ' + gptI18n.renewOrOrderSubscription;
                displayRenewLimitsModal(gptI18n.subscriptionLimitЕxceeded);
            }
            renderAlertMessage(alertMessage, gptWidgetSettings.descriptionWrapper);
            return;
        } else if (gptShopInfo.subscription.ownApiKey && gptShopInfo.hasGptApiKey == false) {
            renderAlertMessage(gptI18n.gptApiKeyNotSet, gptWidgetSettings.descriptionWrapper);
            // displayRenewLimitsModal(gptI18n.gptApiKeyNotSet);
            return;
        }

        var contentAction = (new ChatGptAction({
            id: "gpt_description_button",
            title: gptI18n.buttonName,
            type: 'single'
        }))
            .renderInto(gptWidgetSettings.descriptionWrapper);

        if (gptShopInfo.subscription.plan.customRequest) {
            renderCustomRequestForm(gptWidgetSettings.descriptionWrapper, {
                contentEditorPreffix: gptWidgetSettings.descriptionEditorPrefix,
                entity: 'page',
            });
        }

        // define wrapper for translate action
        var translateWrapper = $("#" + gptWidgetSettings.nameEditorPrefix + (new ChatGptContent).getPageLanguageId()).closest('.input-container');
        if (isLegacyController) {
            translateWrapper = $("#" + gptWidgetSettings.nameEditorPrefix + (new ChatGptContent).getPageLanguageId())
                .closest('.form-group');
        }

        //rewrite category name button
        var rewriteCategoryNameObject = (new ChatGptAction({
            entity: 'page',
            id: "gpt_rewrite_name_button",
            title: gptI18n.buttonRewrite,
            type: 'single',
            class: isLegacyController ? 'btn btn-primary ml-2' : 'btn btn-primary',
            contentEditorPreffix: gptWidgetSettings.nameEditorPrefix,
            fieldName: 'name'
        }))
            .renderInto(translateWrapper);

        //rewrite category description button
        var rewriteCategoryDescriptionObject = (new ChatGptAction({
            entity: 'page',
            id: "gpt_rewrite_description_button",
            title: gptI18n.buttonRewrite,
            type: 'button',
            class: isLegacyController ? 'btn btn-primary ml-2' : 'btn btn-primary',
            contentEditorPreffix: gptWidgetSettings.descriptionEditorPrefix,
            fieldName: 'content'
        }))
            .renderInto(gptWidgetSettings.descriptionWrapper.find('.gpt-button-wraper'));

        rewriteCategoryNameObject.getButton().on('click', rewriteEventHandler);
        rewriteCategoryDescriptionObject.getButton().on('click', rewriteEventHandler);

        if (gptLanguages.length > 1) {
            // translate page title button
            var translateTitleObject = new ChatGptTranslateAction({
                entity: 'page',
                languages: gptLanguages,
                contentEditorPreffix: gptWidgetSettings.nameEditorPrefix,
                buttonClass: 'btn btn-primary mr-2',
                title: gptI18n.buttonTranslate,
                type: 'button'
            })
                .renderInto(translateWrapper.find('.gpt-button-wraper'), 'prepend');

            translateTitleObject.getButton().on('click', translateEventHandler);

            // translate page content button
            var translatePageContentObject = new ChatGptTranslateAction({
                entity: 'page',
                languages: gptLanguages,
                wrapperSelector: gptWidgetSettings.descriptionWrapperSelector,
                contentEditorPreffix: gptWidgetSettings.descriptionEditorPrefix,
                buttonClass: 'btn btn-primary ml-2 mr-2',
                type: 'button',
                title: gptI18n.buttonTranslate
            })
                .renderInto(gptWidgetSettings.descriptionWrapper.find('#gpt_description_button'), 'after');

            translatePageContentObject.getButton().on('click', translateEventHandler);
        }

        contentAction.getButton().on('click', function (e) {
            e.preventDefault();

            descriptionModal.setHeader(gptI18n.titlePageConentGeneration)
            .setBody(
                '<div>' + ChatGptForm.descriptionForm() + '</div>'
            ).setActions([])
            .addAction({
                title: gptI18n.buttonCancel,
                class: 'btn btn-outline-secondary'
            }, function (cancelButton) {
                cancelButton.getModal().destroy();
            }).addAction({
                title: gptI18n.buttonRegenerate,
            }, async function (actionInstance) {
                // define bulk options
                var options = {
                    replace: +$("#allow_gen_content_0").is(':checked'),
                    skipExistingContent: 0,
                    maxWords: +$("#gpt_description_length").val(),
                    languages: [],
                    idContentTemplate: +$('select#id_content_template').val(),
                };

                if (options.idContentTemplate > 0) {
                    options.languages = gptContentTemplates[options.idContentTemplate].langs;
                } else {
                    // define selected languages
                    $('.gpt-languages-list').each(function () {
                        var value = +($(this).is(':checked') ? this.value : 0);
                        if (value != 0 && options.languages.indexOf(value) == -1) {
                            options.languages.push(value);
                        }
                    });
                }

                if (isNaN(options.maxWords) || options.maxWords < gptPageSettings[adminPageName].minWords) {
                    alert(gptI18n.maxWordsNotValid.replace('%min_words%', gptPageSettings[adminPageName].minWords));
                    return;
                }

                if (options.languages.length == 0) {
                    alert(gptI18n.pleaseSelectLanguages);
                    return;
                }

                var content = new ChatGptContent(),
                    pageName = '';

		var gptEditedtext = document.querySelector('#gpt_edited_text');

                ChatGptContent.renderLoaderlayer($('body'));

                for (var langIndex = 0; langIndex < options.languages.length; langIndex ++) {
                    try {
                        options.idLang = options.languages[langIndex];
                        pageName = $("#" + gptWidgetSettings.nameEditorPrefix + options.idLang).val();

                        var pageContent = await content.getPageContent(pageName, options, true);

                        if (typeof pageContent.inQueue != 'undefined' && pageContent.inQueue) {
                            pageContent = await content.awaitRequestResponse(pageContent.requestId);

                            // display error message if the request is failure
                            if (pageContent && pageContent.status != 'success') {
                                if (pageContent.status == 'quota_over') {
                                    var errorMessage = gptI18n.subscriptionLimitЕxceeded;
                                } else {
                                    var errorMessage = pageContent.text;
                                }

                                handleModalError(
                                    actionInstance.getModal(),
                                    'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + errorMessage
                                );

                                ChatGptContent.removeLoaderLayer();
                                return;
                            }
                        }

                        if (pageContent && pageContent.text) {
                            var text = content.convertTextToHtml(pageContent.text);
                            if (options.replace == false) {
                                var existingContent = content.getContentFromEditor(document.getElementById(gptWidgetSettings.descriptionEditorPrefix + options.languages[langIndex]), 'html');
                                text = (!!existingContent ? existingContent : '') + text;
                            }
                            content.setContentIntoEditor(
                                text,
                                {format: 'html'},
                                tinymce.get(gptWidgetSettings.descriptionEditorPrefix + options.idLang)
                            );

                            window.showSuccessMessage('Language: ' + content.getLanguageById(options.languages[langIndex]).iso_code.toUpperCase() + ': ' + gptI18n.successMessage.replace(/\%words\%/g, pageContent.nbWords));
                        }
                        gptEditedtext.value = 1;
                    } catch (err) {
                        ChatGptContent.removeLoaderLayer();
                        handleModalError(
                            actionInstance.getModal(),
                            'Language: ' + content.getLanguageById(options.languages[langIndex]).name + '<br/>' + err
                        );
                        return;
                    }
                }
                ChatGptContent.removeLoaderLayer();
                actionInstance.getModal().destroy();
            });

            descriptionModal.open(function () {
                // init tooltips
                $(".gpt-tooltip").popover();
            });
        });
    }
});

