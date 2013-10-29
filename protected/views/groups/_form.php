<?php
/* @var $this DistributionListFormController */
/* @var $model DistributionListForm */
/* @var $form CActiveForm */
?>

<div class="form modal-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'distribution-list-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'span6','id'=>'groupName')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'email'); ?>
                <div class="input-append">
		<?php echo $form->textField($model,'email',array('class'=>'span6','id'=>'groupEmail')); ?>
                    <span class="add-on">@<?php echo Yii::app()->user->accountdomain; ?></span>
                </div>
		<?php echo $form->error($model,'email'); ?>
	</div>
    <?php if($model->scenario=='update'): ?>
    <div><?php echo CHtml::submitButton('Save Changes',array('class'=>'btn')); ?></div>
    <?php endif; ?>


<?php $this->endWidget(); ?>

</div><!-- form -->