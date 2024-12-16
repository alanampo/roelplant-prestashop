{if $nbComments > 0}
    <div class="gpt-reviews-box">
        <div class="gpt-reviews-header">
            <div><i class="material-icons chat" data-icon="chat"></i> {l s='Reviews' d='Modules.Chatgptcontentgenerator.Shop'} ({$nbComments})</div>
        </div>

        <div class="gpt-reviews-list">
            {include file='module:chatgptcontentgenerator/vendor/chatgptcontentgenerator/productreviews/resources/hook/reviews.tpl' reviews=$reviews}
        </div>

        {if $nbComments > 5}
            <div class="gpt-reviews-more">
                <a href="javascript:void(0);" rel="nofollow" class="btn btn-secondary" id="btn-view-more-gpt-reviews">{l s='View more' d='Modules.Chatgptcontentgenerator.Shop'}</a>
            </div>
        {/if}
    </div>
{/if}