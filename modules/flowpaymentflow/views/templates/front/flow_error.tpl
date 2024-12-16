
{extends file='page.tpl'}

{block name='page_content'}
    <div class="row">
        <div class="col-md-12">
            <h3 class="h3 card-title">{l s='Error'}</h3>
        </div>
        <div class="col-md-12">
            {if $errorMessage }
                <div class="alert alert-danger" role="alert">
                {$errorMessage nofilter}
                </div>      
            {/if}
        </div>
    </div>
{/block}