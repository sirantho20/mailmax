
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'account-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'business_name',array('class'=>'span5','maxlength'=>45)); ?>
    <?php echo $form->textFieldRow($model,'domain',array('class'=>'span5','maxlength'=>45)); ?>
    <?php echo $form->textFieldRow($model,'vhost',array('class'=>'span5','maxlength'=>45,'placeholder'=>'Example: mail.yourdomain.com')); ?>
    <?php echo $form->dropDownListRow($model,'package',  Package::listPackages(),array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>50)); ?>
        <div>
        <?php echo $form->labelEx($model,'mobile'); ?>
        <div class="input-prepend">
        <span class="add-on">+233</span>
        <?php echo $form->textField($model,'mobile',array('class'=>'span12')); ?>
        </div>
        <?php echo $form->error($model,'mobile'); ?>
    </div>
    <?php //echo $form->textFieldRow($model,'mobile',array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($model,'signup_date',array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>1)); ?>

    <?php //echo $form->textFieldRow($model,'cos',array('class'=>'span5','maxlength'=>45)); ?>

    <?php //echo $form->textFieldRow($model,'resellerAccount',array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($user,'username',array('class'=>'span5','maxlength'=>45)); ?>

    <?php //echo $form->textFieldRow($user,'firstName',array('class'=>'span5','maxlength'=>45)); ?>

    <?php //echo $form->textFieldRow($user,'pword',array('class'=>'span5','maxlength'=>200)); ?>

    <?php //echo $form->textFieldRow($user,'created',array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($user,'email',array('class'=>'span5','maxlength'=>45)); ?>

    <?php //echo $form->textFieldRow($user,'lastName',array('class'=>'span5','maxlength'=>45)); ?>

    <?php //echo $form->textFieldRow($user,'mobile',array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($user,'account',array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($user,'superAdmin',array('class'=>'span5','maxlength'=>1)); ?>

    <?php //echo $form->textFieldRow($user,'is_reseller',array('class'=>'span5','maxlength'=>1)); ?>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
