<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/chat.css" />
<div class="cBox">
    <div class="cContent">
        <div class="cToggleButton">&nbsp;</div>
        <div class="cMessages">
            <div class="cMessagesText"></div>
            <div class="cInputBox">
                <?php 
                $model=new Messages;
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'messages-form',
                    'enableAjaxValidation'=>false,
                ));
                echo $form->textField($model, 'msg',array('size'=>60,'maxlength'=>100));
                echo CHtml::hiddenField('ajax', 1);
                echo CHtml::ajaxSubmitButton('', Yii::app()->createUrl('//messages/create'), array(
                    'success' => 'cSuccessAdd',
                    'beforeSend' => 'cBeforeAdd',
                    'dataType' => 'json',
                ));
                $this->endWidget();
                ?>
            </div>
        </div>
    </div>
</div>
<div style="clear: both"></div>