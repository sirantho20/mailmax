<?php
/* @var $this LoginFormController */
/* @var $model LoginForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form-index-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="container span3 offset4">
	<?php echo $form->errorSummary($model);     helper::showFlash(); ?>
    
                
		<?php //echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'span12','placeholder'=>'Username','id'=>'focusedInput')); ?>
		
                <?php echo $form->error($model,'username'); ?>
    <div class="clear"></div>
		
                <?php //echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'span12','placeholder'=>'Password')); ?>
		<?php echo $form->error($model,'password'); ?>
	<div class="buttons">
                <button class="btn span3" type="submit"><i class="icon-off"></i></button>
	
		<?php //echo CHtml::submitButton('<i class="icon-ok"></i>',array('class'=>'btn btn-primary')); ?>
	</div>
   
<?php $this->endWidget(); ?>

</div> 
<!-- form -->