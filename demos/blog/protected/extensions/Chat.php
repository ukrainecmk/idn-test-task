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
        $this->contentCssClass = 'cPortletParrent';
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        //will not use title showing
    }
}
?>