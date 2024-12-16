{foreach from=$reviews item=review}
    <div class="gpt-reviews-item row">
        <div class="col-sm-3 review-infos">
            <div class="review-rating">
                <div class="grade-stars" data-grade="{$review.rate}">
                    <div class="star-content star-empty clearfix">
                        {for $star=1 to 5}
                            <div class="star" {if $star <= $review.rate}style="visibility: hidden;"{/if}></div>
                        {/for}
                    </div>
                    <div class="star-content star-full clearfix">
                        {for $star=1 to 5}
                            <div {if $star <= $review.rate}class="star-on"{/if}></div>
                        {/for}
                    </div>
                </div>
            </div>
            <div class="review-date">{$review.public_date}</div>
            {if $review.author}
                <div class="review-author">{l s='By %1$s' sprintf=[$review.author] d='Modules.Chatgptcontentgenerator.Shop'}</div>
            {/if}
        </div>
        <div class="col-sm-9 review-content">
            <p>{$review.description}</p>
        </div>
    </div>
{/foreach}
