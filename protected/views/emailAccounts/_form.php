<?php
/* @var $this EmailAccountsController */
/* @var $model EmailAccounts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-accounts-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
    <div class="container">
        <div class="span4">
        <div >
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>45,'maxlength'=>45,'class'=>'span11')); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>
    </div>
        <div class="span4">
	<div>
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>45,'maxlength'=>45,'class'=>'span8')); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>
        </div>
    </div>
    
        <div>
		<?php echo $form->labelEx($model,'job_title'); ?>
		<?php echo $form->textField($model,'job_title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'job_title'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'department'); ?>
		<?php echo $form->textField($model,'department',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'department'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'email'); ?>
                <div class="input-append">
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45,'class'=>'span6')); ?>
                    <span class="add-on"><?php echo '@'.Yii::app()->user->accountdomain; ?></span>
		<?php echo $form->error($model,'email'); ?>
	</div>
            <?php if($model->isNewRecord): ?>
        <div>
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
            <?php                 endif; ?>
            
                    <?php if(!$model->isNewRecord): ?>
        <div>
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array('active'=>'Active','locked'=>'Locked','closed'=>'Closed'),array('options'=>array($model->status=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
            <?php                 endif; ?>
            
	<div>
		<?php echo $form->labelEx($model,'quota'); ?>
		<?php echo $form->dropDownList($model,'quota',array(250=>'250MB',500=>'500MB',750=>'750MB',1000=>'1GB',1500=>'1.5GB',2000=>'2GB'),array('prompt'=>'--Select Quota--','options'=>array($model->quota=>array('selected'=>TRUE)))); ?>
		<?php echo $form->error($model,'quota'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Email' : 'Save Update',array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->