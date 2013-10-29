<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'interested-clients-form',
    'focus'=>array($model,'firstname'),
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
)); ?>


    

    <?php echo $form->textFieldRow($model,'firstname',array('class'=>'span12','maxlength'=>45)); ?>
    <?php echo $form->textFieldRow($model,'lastname',array('class'=>'span12','maxlength'=>45)); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span12','maxlength'=>45)); ?>
<div class="help-block error valError"></div>
    <div class="row-fluid">
        <?php echo CHtml::ajaxButton('Done! Sign me up', Yii::app()->createUrl('signup/interest'), array(
            'type'=>'POST',
            'beforeSend'=>'function(){$("#loadingImg").html(\'<img src="'.Yii::app()->baseUrl.'/images/preloader.gif" />\'); }',
            'success'=>'function(result){$(".modal-body").html("<center><span style=\"color:green\">Congratulations! You have successfully registered. Please check your email for details.</span><br /><button data-dismiss=\"modal\" class=\"btn btn-info\">Got It!</button></center>")}',
            'error'=>'function(jx,err,hr){alert(jx.responseText);$(".valError").html("Have you completed all fields?"); $("#loadingImg").html("");}'
            ),array('class'=>'btn btn-large btn-info')); ?><span id="loadingImg"></span>
    </div>

<?php $this->endWidget(); ?>
