<?php
Yii::import('zii.widgets.CPortlet');
 
class Chat extends CPortlet
{
    public $title='';
    public $maxTags=20;
    
    protected function renderContent()
    {
        
        $this->render('chat');
    }
    protected function renderDecoration()
    {
        Yii::app()->clientScript->registerScript(
          'chat-config-js',
          'var cRefreshUrl = "'. Yii::app()->createUrl('//messages/refresh'). '";',
          CClientScript::POS_HEAD
        );
        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->baseUrl . '/js/chat.js',
        CClientScript::POS_END
        );

        $this->contentCssClass = 'cPortletParrent';
        Yii::app()->getClientScript()->registerCoreScript('jquery');
    }
}
?>