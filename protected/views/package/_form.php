<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'package-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model);         helper::showFlash();?>

	<?php echo $form->textFieldRow($model,'package_name',array('class'=>'span3','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'email_limit',array('class'=>'span3')); ?>

        <?php echo $form->labelEx($model,'space_limit'); ?>
        <div class="input-append">
        <?php echo $form->textField($model,'space_limit',array('class'=>'span9')); ?>
        <span class="add-on">MB</span>
        </div>
        
        <?php echo $form->labelEx($model,'duration_months'); ?>
        <div class="input-append">
        <?php echo $form->textField($model,'duration_months',array('class'=>'span9')); ?>
        <span class="add-on">Months</span>
        </div>

	<?php echo $form->textFieldRow($model,'package_price',array('class'=>'span3')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
