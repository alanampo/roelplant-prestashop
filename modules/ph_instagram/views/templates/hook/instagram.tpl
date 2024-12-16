<script type="text/javascript">
    $(".ybc_instagram_fancy").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
</script>
<div class="ybc_instagram footer-block block_instagram col-sm-3 col-xs-12 links">
    <h3 class="h3 title-footer-block hidden-xs-down">{l s='Instagram' mod='ph_instagram'}</h3>
    <div class="title clearfix hidden-sm-up" data-target="#footer_instagram" data-toggle="collapse">
        <span class="h3">{l s='Instagram' mod='ph_instagram'}</span>
        <span class="pull-xs-right">
          <span class="navbar-toggler collapse-icons">
            <i class="fa fa-angle-double-down add"></i>
            <i class="fa fa-angle-double-up remove"></i>
          </span>
        </span>
      </div>
    {if $IMGs}
        <ul id="footer_instagram" class="instagram_list_img toggle-footer collapse">
            {assign var='ik' value=0}
            {foreach $IMGs as $key=>$img}
                {assign var='ik' value=$ik+1}
                {if $ik <= $PH_INSTAGRAM_IMG_NUMBER}
                    <li class="instagram_item_img col-xs-4 col-sm-4 col-md-4">
                        <a class="ybc_instagram_fancy" href="{if $img.is_video}#ph_insta_video_{$key+1}{else} {$img.standard_resolution|escape:'html':'UTF-8'}{/if}" data-media-type="{if $img.is_video}video{else}image{/if}">
                            <img {if $img.caption}alt="{$img.caption|escape:'html':'UTF-8'}"{/if} src="{$img.thumbnail|escape:'html':'UTF-8'}" alt=""/>
                        </a>
                        {if $img.is_video}
                            <video controls style="display: none; padding: 0;" id="ph_insta_video_{$key+1}">
                                <source src="{$img.standard_resolution|escape:'html':'UTF-8'}" type="video/mp4">
                                Your browser doesn't support HTML5 video tag.
                            </video>
                        {/if}
                    </li>
                {/if}
            {/foreach}
        </ul>
    {/if}
</div>