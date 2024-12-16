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

document.addEventListener('DOMContentLoaded', () => {
    // extend ChatGptContent
    ChatGptContent.prototype.generateReviewByProductId = async function (options, throwError) {
        var _options = Object.assign({}, {
                idProduct: 0,
                idLang: 0,
                maxWords: 0,
                publicDate: 0,
                status: 0,
                rate: 5,
                author: '',
            }, options);

        var response = await ChatGptContent.sendRequest({
            url: gptReviewsAjaxUrl,
            data: {
                ajax: 1,
                action: 'generateReviewByProductId',
                id_product: _options.idProduct,
                id_language: _options.idLang,
                length: _options.maxWords,
                status: _options.status,
                rate: _options.rate,
                author: _options.author,
                public_date: _options.publicDate,
            }
        });

        if (typeof response.success != 'undefined' && response.success) {
            return {
                requestId: (typeof response.requestId != 'undefined' ? response.requestId : false),
                inQueue: (typeof response.inQueue != 'undefined' ? response.inQueue : false),
                text: response.text,
                length: response.text.length,
                nbWords: response.nbWords,
                warning: (typeof response.warning != 'undefined' ? response.warning : false),
            }
        } else if (typeof response.success != 'undefined' && !response.success) {
            var message = ChatGptModule.renderErrorMessage(response, 'generateReviewByProductId');
            if (!!throwError === true) {
                throw new Error(message);
                return false;
            }
            window.showErrorMessage(message);
        }

        return false;
    }
    ChatGptContent.prototype.bulkProductReviews = async function(productIds, idLang, callback) {
        return;
        if (typeof productIds == 'undefined' && productIds.length == 0) {
            return;
        }

        var result = [];

        // var idLang = this.getPageLanguageId(),
        //     result = [],
        //     _options = Object.assign({}, {
        //         useProductCategory: 1,
        //         useProductBrand: 1,
        //         useProductEan: 0,
        //         contentType: contentType,
        //         replace: gptPageSettings.productsList.replaceContent,
        //         skipExistingContent: gptPageSettings.productsList.generateIfEmpty,
        //         maxWords: gptPageSettings.productsList,
        //         languages: [idLang],
        //         idContentTemplate: 0,
        //     }, options);

        for (var i = 0; i < productIds.length; i++) {
            if (this.getProcessStatus() === false) {
                console.warn('The process has been stopped');
                this.setProcessStatus(true); // allow to run the another process
                return result;
                break;
            }

            if (this.getCancelAllProcessStatus() === true) {
                console.warn('All processes are stopped');
                return;
            }

            continue;

            var uniqueId = 1;
            for (var langIndex = 0; langIndex < _options.languages.length; langIndex ++) {
                

                

                var response = await request({
                    url: this.getOptions().endPoint,
                    data: {
                        ajax: 1,
                        action: 'bulkProductDescription',
                        replace: +_options.replace,
                        skip_existing_description: +_options.skipExistingContent,
                        ids: products[i],
                        id_language: +_options.languages[langIndex],
                        length: _options.maxWords,
                        use_category: _options.useProductCategory,
                        use_brand: _options.useProductBrand,
                        use_ean: _options.useProductEan,
                        content_type: _options.contentType,
                        id_content_template: _options.idContentTemplate,
                        unique_id: uniqueId,
                    }
                });

                uniqueId = 0;

                if (typeof callback == 'function') {
                    await callback(products[i], i, response, +_options.languages[langIndex], langIndex, this);
                }
            }

            if (typeof response.success != 'undefined' && response.success) {
                result.push({
                    idProduct: products[i],
                    error: false,
                    requestId: (typeof response.products[0].requestId != 'undefined' ? response.products[0].requestId : false),
                    inQueue: (typeof response.products[0].inQueue != 'undefined' ? response.products[0].inQueue : false),
                    text: response.products[0].text,
                    length: response.products[0].text.length,
                    nbWords: response.products[0].nbWords
                });
            } else if (typeof response.success != 'undefined' && !response.success) {
                var errorMessage = ChatGptModule.renderErrorMessage(response, 'bulkProductDescription');
                if (typeof response.error.code != 'undefined' && response.error.code == 18) {
                    errorMessage = gptI18n.subscriptionLimitЕxceeded + ' ' + gptI18n.renewOrOrderSubscription;
                } else if (typeof response.error.code != 'undefined' && response.error.code == 314) {
                    errorMessage = gptI18n.gptApiKeyNotSet;
                }
                result.push({
                    idProduct: products[i],
                    error: true,
                    message: errorMessage
                });
            }
        }

        return result;
    };
});
