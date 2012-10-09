<style type="text/css">
    .cPortletParrent {
        width: 540px;
        height: 304px;
        /*float: left;*/
        /*background-color: #FFFFFF;*/
        top: 130px;
        position: absolute;
        left: -330px;
        top: -110px;
        overflow: hidden;
    }
    .cBox div {
        border: 2px solid #298DCD;
        background-color: #FFFFFF;
    }
    .cToggleButton {
        width: 20px;
        text-align: center;
        font-size: 36px;
        color: #298DCD;
        font-weight: bold;
        line-height: 275px;
        cursor: pointer;
        float: left;
        height: 296px;
    }
    .cContent {
        /*width: 512px;*/ /*hidden at the begining*/
        /*float: left;*/
        /*display: none;*/
    }
    .cContent {
        height: 300px;
    }
    .cMessages {
        height: 260px;
        overflow-y: scroll;
        width: 508px;
        float: right;
    }
    .cInputBox {
        height: 32px;;
        float: right;
        width: 508px;
    }
    .cFormElementBox {
        float: left;
        margin: 3% 10% 0 10%;
    }
    .cLoader {
        background-image: url(<?php echo Yii::app()->baseUrl?>/images/loader.gif);
        width: 16px;
        height: 16px;
        
    }
    .cErrors {
        color: red;
        font-weight: bold;
        border: none !important;
    }
    .cMsgList {
        font-size: 12px;
    }
    .cPortletParrent {
        position: relative;
    }
</style>
<script type="text/javascript">
// <!--
jQuery(document).ready(function(){
    jQuery('.cToggleButton').click(function(){
        //jQuery('.cBox').show("slide", { direction: "left" }, 1000);
        var hide = jQuery('.cBox').width() == 540 ? true : false;  //show or hide content
        jQuery(this).html( hide ? '<' : '>');
       /* jQuery('.cBox').animate({
            width: hide ? 20 : 540
        }, 1000, function(){
            if(hide) {
                jQuery('.cContent').hide();
            }
        });*/
        jQuery('.cContent').animate({
            marginLeft: hide ? 220 : 540
        }, 1000, function(){
            if(hide) {
                //jQuery('.cContent').hide();
            }
        });
         if(!hide) {
            //jQuery('.cContent').show();
            cScrollChat();
        }
    });
    jQuery('.cFormAddMsg').submit(function(){
        return false;
    });
});
function cRefreshMessages() {
    jQuery.ajax({
        url: '<?php echo Yii::app()->createUrl('//messages/refresh')?>',
        success: function(res) {
            jQuery('.cMessages').html(res);
            cScrollChat();
        }
    });
}
function cSuccessAdd(res) {
    jQuery('.cErrors').removeClass('cLoader');
    if(res.errors.length == 0) {
        jQuery('#Messages_msg').val('');
        cRefreshMessages();
    } else {
        for(var el in res.errors) {
            jQuery('.cErrors').append(res.errors[el]+ '<br />');
        }
    }
}
function cBeforeAdd() {
    jQuery('.cErrors').html('');
    jQuery('.cErrors').addClass('cLoader');
}
function cScrollChat() {
    jQuery('.cMessages').animate({
        scrollTop: jQuery('.cMessages').height()
    }, 10);
}
// -->
</script>
<div class="cBox">
    <div class="cContent">
        <div class="cToggleButton"><</div>
        <div class="cMessages"></div><br stile="clear: both;" />
        <div class="cInputBox">
            <?php 
            $model=new Messages;
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'messages-form',
                'enableAjaxValidation'=>false,
            ));
            echo $form->textField($model, 'msg',array('size'=>60,'maxlength'=>100));
            echo CHtml::hiddenField('ajax', 1);
            echo CHtml::ajaxSubmitButton('Send', Yii::app()->createUrl('//messages/create'), array(
                'success' => 'cSuccessAdd',
                'beforeSend' => 'cBeforeAdd',
                'dataType' => 'json',
            ));
            $this->endWidget();
            ?>
            <div class="cErrors"></div>
        </div>
    </div>
</div>
<div style="clear: both"></div>