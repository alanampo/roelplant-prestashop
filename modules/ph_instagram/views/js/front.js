var phInstaFront = {
    checkTokenLiveTime: function(){
        $.ajax({
            url: PH_INSTA_LINK_AJAX,
            type: 'POST',
            dataType: 'json',
            data:{
                token: PH_INSTA_TOKEN,
                phInstaCheckTokenLiveTime: 1
            }
        });
    }
};
$(document).ready(function () {
    //phInstaFront.checkTokenLiveTime();
    $('.ybc_instagram_fancy').fancybox();
});