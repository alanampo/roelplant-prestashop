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
    var reviewsPage = 2;
    function displayMoreReviews() {
        var limit = 5;
        $.get(gpt_reviews_ajax_url, {
                limit: limit,
                page: reviewsPage,
                action: 'getReviews',
            })
            .done((response) => {
                if (!!response.success == true) {
                    reviewsPage = response.page + 1;

                    let d = document.createElement('div');
                    d.innerHTML = response.reviewsHtml;
                    document.querySelector('.gpt-reviews-list')
                        && document.querySelector('.gpt-reviews-list').append(d);

                    if (response.page * limit >= response.total) {
                        // hide view more button
                        document.getElementById('btn-view-more-gpt-reviews').style.display = 'none';
                    }
                }
            })
            .fail((err) => {
            })
            .always(() => {
            });
    }

    document.getElementById('btn-view-more-gpt-reviews')
        && document.getElementById('btn-view-more-gpt-reviews').addEventListener('click', function (e) {
            e.preventDefault();

            displayMoreReviews();
        });
});
