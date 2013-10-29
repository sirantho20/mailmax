<?php
/* @var $this PasswordResetController */
/* @var $model PasswordReset */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'password-reset-resetPassword-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php 
 helper::showPageTitle('Reset Password - '.$model->username);
 helper::showFlash();
        echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'verify'); ?>
		<?php echo $form->textField($model,'verify'); ?>
		<?php echo $form->error($model,'verify'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->