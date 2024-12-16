/**
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
 * needs please contact us for extra customization service at an affordable price
 *
 *  @author ETS-Soft <etssoft.jsc@gmail.com>
 *  @copyright  2007-2022 ETS-Soft
 *  @license    Valid for 1 website (or project) for each purchase of license
 *  International Registered Trademark & Property of ETS-Soft
 */
$(document).ready(function(){
    $('.is_parent_cat_li').addClass('active');
    $('.is_parent_cat_li > .homecat_ajax_tab_list').addClass('active');
    $('.homecat_tabs > .homecat_product_list_wrapper:first-child').addClass('active').children('.product_list').addClass('active');
    $('.homecat_ajax_tab_list').click(function(){
        var id_parent = $(this).parents('.is_parent_cat_li').data('id-category');
        var id_category = $(this).data('id-category');
        $(this).parents('.is_parent_cat_li').removeClass('active').find('.homecat_ajax_tab_list').removeClass('active').parent('li').removeClass('active');
        $(this).addClass('active').parent('li').addClass('active');
        if($('.homecat_tabs_'+id_parent+' .hc-wrapper-homecat-tab-'+id_category).length > 0)
        {
            $('.homecat_tabs_'+id_parent+' .homecat_product_list_wrapper').removeClass('active').children('ul').removeClass('active');
            $('.homecat_tabs_'+id_parent+' .hc-wrapper-homecat-tab-'+id_category).addClass('active').children('ul').addClass('active');
        }
        else
        {
           if(!$(this).hasClass('loading'))
           {
                $(this).addClass('loading');
                $('.homecat_tabs_'+id_parent).addClass('loading');
                $.ajax({
                    url: homecat_ajax_link,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id_category: $(this).data('id-category')!='all' ? parseInt($(this).data('id-category')) : 0, 
                        homecateajax: true, 
                        ets_homecat_order_seed: ets_homecat_order_seed,  
                        id_parent: id_parent,   
                        ets_homecat_order: $('.is_parent_cat_li_'+id_parent+' .homecat_sort_by').val(),                 
                    },
                    success: function(json)
                    {
                        $('.homecat_tabs_'+json.id_parent).append(json.html);
                        $('.is_parent_cat_li_'+json.id_parent).find('.homecat_ajax_tab_list_'+json.id_category).removeClass('loading');                                                
                        if($('.is_parent_cat_li_'+json.id_parent).find('.homecat_ajax_tab_list_'+json.id_category).hasClass('active'))
                        {
                            $('.homecat_tabs_'+json.id_parent).removeClass('loading');
                            $('.homecat_tabs_'+json.id_parent+' .homecat_product_list_wrapper').removeClass('active').children('.product_list').removeClass('active');
                            if($('.homecat_tabs_'+json.id_parent+' .hc-wrapper-homecat-tab-'+json.id_category).length > 0)
                                $('.homecat_tabs_'+json.id_parent+' .hc-wrapper-homecat-tab-'+json.id_category).addClass('active').children('.product_list').addClass('active');    
                        }
                        if(ETS_HOMECAT_ENBLE_CAROUSEL && $('.homecat_tabs_'+json.id_parent+' .hc-wrapper-homecat-tab-'+json.id_category+' .product_list').length > 0)
                            $('.is_parent_cat_li > .homecat_tabs_'+json.id_parent+':not(.homecat_tabs_all) .hc-wrapper-homecat-tab-'+json.id_category+' .product_list').owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 3 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });
                            $('.is_parent_cat_li > .banner_inline_listproduct .homecat_tabs_'+json.id_parent+':not(.homecat_tabs_all) .hc-wrapper-homecat-tab-'+json.id_category+' .product_list').owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 3 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });
                            $('.homecat_tabs_'+json.id_parent+'.homecat_tabs_all .hc-wrapper-homecat-tab-'+json.id_category+' .product_list').owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 4 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });                                                  
                    },
                    error: function()
                    {
                        $('.homecat_ajax_tab_list').removeClass('loading');
                        $('.homecat_tabs').removeClass('loading');
                    }
                });     
           } 
           else
                $('.homecat_tabs_'.id_parent).addClass('loading'); 
        }
        return false;
    });
    
    //Sort products
    $('.homecat_sort_by').prop("disabled", false);
    $('.homecat_sort_by').change(function(){
        if(!(typeof $(this).attr('disabled') !== typeof undefined && $(this).attr('disabled') !== false && $(this).attr('disabled')=='disabled'))
        {
            $(this).attr('disabled','disabled');
            var id_parent = $(this).parents('.is_parent_cat_li').data('id-category');
            var id_category = $(this).parents('.is_parent_cat_li').eq(0).find('.homecat_ajax_tab_list.active').length > 0 ? $(this).parents('.is_parent_cat_li').find('.homecat_ajax_tab_list.active').eq(0).data('id-category') : 0;
            $('.homecat_tabs_'+id_parent).addClass('loading');
            $.ajax({
                url: homecat_ajax_link,
                type: 'post',
                dataType: 'json',
                data: {
                    id_category: id_category, 
                    homecateajaxsort: true,  
                    sort_by: $(this).val(),  
                    ets_homecat_order_seed: ets_homecat_order_seed, 
                    id_parent: id_parent,                  
                },
                success: function(json)
                {
                    if(!json.error)
                    {
                        $('.homecat_tabs_'+json.id_parent+' .homecat_product_list_wrapper').remove();
                        $('.homecat_tabs_'+json.id_parent).prepend(json.html);
                        $('.is_parent_cat_li_'+json.id_parent).removeClass('active').children('.homecat_ajax_tab_list').removeClass('active').parent('li').removeClass('active');
                        $('.is_parent_cat_li_'+json.id_parent+' .homecat_ajax_tab_list_'+json.id_category).addClass('active').parent('li').addClass('active');                        
                        $('.homecat_tabs_'+json.id_category + ' .homecat_product_list_wrapper').removeClass('active');
                        if($('.homecat_tabs_'+json.id_parent + ' .hc-wrapper-homecat-tab-'+json.id_category).length > 0)
                            $('.homecat_tabs_'+json.id_parent + ' .hc-wrapper-homecat-tab-'+json.id_category).addClass('active').children('.product_list').addClass('active');
                        if(ETS_HOMECAT_ENBLE_CAROUSEL && $('.homecat_tabs_'+json.id_parent + ' .hc-wrapper-homecat-tab-'+json.id_category + ' .product_list').length > 0)
                            $('.is_parent_cat_li > .homecat_tabs_'+json.id_parent + ':not(.homecat_tabs_all) .hc-wrapper-homecat-tab-'+json.id_category + ' .product_list').owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 4 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });
                            $('.is_parent_cat_li > .banner_inline_listproduct .homecat_tabs_'+json.id_parent + ':not(.homecat_tabs_all) .hc-wrapper-homecat-tab-'+json.id_category + ' .product_list').owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 3 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });  
                            $('.homecat_tabs_'+json.id_parent + '.homecat_tabs_all .hc-wrapper-homecat-tab-'+json.id_category + ' .product_list').owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 4 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });    
                    }
                    $('.homecat_tabs_'+json.id_parent).removeClass('loading'); 
                    $('#homecat_sort_by_'+json.id_parent).prop("disabled", false);                                               
                },
                error: function()
                {                    
                    $('.homecat_tabs').removeClass('loading');
                    $('.homecat_sort_by').prop("disabled", false);
                }
            }); 
        }             
    });
    
    //Load more
    $(document).on('click','.homecat-load-more',function(){
        if(!$(this).hasClass('active'))
        {
            var id_category = $(this).data('id-category')!='all' ? parseInt($(this).data('id-category')) : 0;
            var id_parent = $(this).parents('.is_parent_cat_li').data('id-category');
            $(this).addClass('active');            
            $.ajax({
                url: homecat_ajax_link,
                type: 'post',
                dataType: 'json',
                data: {
                    id_category: id_category, 
                    homecateajaxloadmore: true,  
                    product_count: parseInt($(this).attr('data-product-count')),  
                    ets_homecat_order_seed: ets_homecat_order_seed,       
                    id_parent: id_parent, 
                    ets_homecat_order: $('.is_parent_cat_li_'+id_parent+' .homecat_sort_by').val(),                     
                },
                success: function(json)
                {
                    if(json.html)
                    {
                        $('.homecat_tabs_'+id_parent+' .homecat-tab-'+json.id_category).append(json.html);
                    }
                    $('.homecat_tabs_'+id_parent+' .homecat-load-more-'+json.id_category).attr('data-product-count',json.productCount); 
                    if(json.nomore)
                        $('.homecat_tabs_'+id_parent+' .homecat-load-more-'+json.id_category).addClass('hidden');
                    $('.homecat_tabs_'+id_parent+' .homecat-load-more-'+json.id_category).removeClass('active');
                    if(ETS_HOMECAT_ENBLE_CAROUSEL && $('.homecat_tabs_'+id_parent+' .homecat-tab-'+json.id_category).length > 0)
                            
                            $('.is_parent_cat_li > .homecat_tabs.homecat_tabs_'+id_parent+':not(.homecat_tabs_all) .homecat-tab-'+json.id_category).owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 3 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });
                            $('.is_parent_cat_li > .banner_inline_listproduct .homecat_tabs.homecat_tabs_'+id_parent+':not(.homecat_tabs_all) .homecat-tab-'+json.id_category).owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 3 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });
                            $('.homecat_tabs.homecat_tabs_'+id_parent+'.homecat_tabs_all .homecat-tab-'+json.id_category).owlCarousel({
                                items : 4,
                                responsive : {
                                    0 : { items : 1 },
                                    545 : { items : 2 },
                                    801 : { items : 3 },
                                    1200 : { items : 4 }
                                },
                                navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
                            });                                              
                },
                error: function()
                {                    
                    $('.homecat-load-more').removeClass('active');     
                }
            }); 
        }  
    }); 
    if($('.homecat_product_list_wrapper > .product_list').length > 0 && ETS_HOMECAT_ENBLE_CAROUSEL){
        
         $('.banner_inline + .content_list_cat .homecat_product_list_wrapper > .product_list').owlCarousel({
            items : 4,
            responsive : {
                0 : { items : 1 },
                545 : { items : 2 },
                801 : { items : 2 },
                1200 : { items : 3 }
            },
            navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
         });
      }
         
         $('.homecat_product_list_wrapper > .product_list').owlCarousel({
            items : 4,
            responsive : {
                0 : { items : 1 },
                545 : { items : 2 },
                801 : { items : 3 },
                1200 : { items : 4 }
            },
            navText: ["<i class='material-icons'>&#xE314;</i>","<i class='material-icons'>&#xE315;</i>"]
         });
         
         
         
              
});