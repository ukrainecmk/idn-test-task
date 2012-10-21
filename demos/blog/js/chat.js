var cChatHidden = true;
jQuery(document).ready(function(){
    jQuery('.cToggleButton').click(function(){
        cChatHidden = jQuery('.cContent').css('marginLeft') != '520px' ? true : false;  //show or hide content
        if(cChatHidden) {
            jQuery('.cToggleButton').removeClass('cButtonOpened');
        } else {
            jQuery('.cToggleButton').addClass('cButtonOpened');
        }
        jQuery('.cContent').animate({
            marginLeft: cChatHidden ? 520 : 0
        }, 1000, function(){
            if(!cChatHidden) {
                cScrollChat();
            }
        });
    });
    jQuery('.cFormAddMsg').submit(function(){
        return false;
    });
    cRefreshMessages();
});
function cRefreshMessages(ignoreTimer) {
    if(typeof(ignoreTimer) == 'undefined')
        ignoreTimer = false;
    jQuery.ajax({
        url: cRefreshUrl,   //Defined at extensions/Chat /'<?php echo Yii::app()->createUrl('//messages/refresh')?>',
        success: function(res) {
            jQuery('.cMessagesText').html(res);
            cScrollChat();
            if(!ignoreTimer)
                setTimeout(cRefreshMessages, 5000);
        }
    });
}
function cSuccessAdd(res) {
    jQuery('.cInputBox input[type=submit]').removeClass('cLoader');
    if(res.errors.length == 0) {
        jQuery('#Messages_msg').val('');
        cRefreshMessages(true);
    } else {
        for(var el in res.errors) {
            alert(res.errors[el]);
            break;
        }
    }
}
function cBeforeAdd() {
    jQuery('.cInputBox input[type=submit]').addClass('cLoader');
}
function cScrollChat() {
    jQuery('.cMessagesText').animate({
        scrollTop: jQuery('.cMessages').height()
    }, 10);
}