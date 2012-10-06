<style type="text/css">
    .cBox {
        width: 540px;
        height: 300px;
        float: right;
    }
    .cBox div {
        border: 2px solid #298DCD;
    }
    .cToggleButton {
        width: 20px;
        text-align: center;
        font-size: 36px;
        color: #298DCD;
        font-weight: bold;
        line-height: 275px;
        cursor: pointer;
        float: right;
    }
    .cContent {
        width: 512px; /*hidden at the begining*/
        float: right;
        /*display: none;*/
    }
    .cToggleButton, .cContent {
        height: 300px;
    }
    .cMessages {
        height: 240px;
    }
    .cInputBox {
        height: 52px;;
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
</style>
<script type="text/javascript">
// <!--
jQuery(document).ready(function(){
    jQuery('.cToggleButton').click(function(){
        var hide = jQuery('.cContent').width() ? true : false;  //show or hide content
        jQuery(this).html( hide ? '<' : '>');
        jQuery('.cContent').animate({
            width: hide ? 0 : 512
        }, 1000, function(){
            if(hide) {
                jQuery('.cContent').hide();
            }
        });
         if(!hide) {
            jQuery('.cContent').show();
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
        }
    });
}
function cSuccessAdd(res) {
    jQuery('.cErrors').removeClass('cLoader');
    if(res.errors.length == 0) {
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
// -->
</script>
<div class="cBox">
    <div class="cContent">
        <div class="cMessages"></div>
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
    <div class="cToggleButton"><</div>
</div>
<div style="clear: both"></div>