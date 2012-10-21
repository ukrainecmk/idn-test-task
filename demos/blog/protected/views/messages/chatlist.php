<?php
/* @var $this MessagesController */
/* @var $dataProvider CActiveDataProvider */
$data = $dataProvider->getData();
if(!empty($data)) { ?>
<table class="cMsgList">
    <?php for($i = count($data)-1; $i >= 0; $i--) { ?>
        <tr>
            <td width="20%">
                <i>
                    <?php echo $data[$i]->author->username?><?php if($data[$i]->isCurrentUser) {?> <b style="color: green;">[Me]</b> <?php }?>: 
                </i>
            </td>
            <td width="50%" align="left"><?php echo $data[$i]->msg?></td>
            <td width="40%" align="right"><?php echo date('G:i:s (m/d/Y)', $data[$i]->create_time)?></td>
        </tr>
    <?php }?>
</table>
<?php }?>