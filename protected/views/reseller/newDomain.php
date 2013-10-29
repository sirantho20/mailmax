<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domain-newDomain-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'domainName'); ?>
		<?php echo $form->textField($model,'domainName'); ?>
		<?php echo $form->error($model,'domainName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vhost'); ?>
		<?php echo $form->textField($model,'vhost'); ?>
		<?php echo $form->error($model,'vhost'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->