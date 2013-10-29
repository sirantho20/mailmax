<?php helper::showPageTitle('Update Account - '.$model->business_name); ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'account-form',
    'enableAjaxValidation'=>false,
)); ?>


    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'business_name',array('class'=>'span5','maxlength'=>45)); ?>

    <?php echo $form->dropDownListRow($model,'package',Package::listPackages(),array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>50)); ?>

    <?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>1)); ?>
    
   <h4>User Account Details<hr /></h4>
    <table cellpadding="6">
        <tbody>
            <tr>
                <td>
                    <?php echo $form->textFieldRow($user,'firstName',array('class'=>'span12','maxlength'=>60)); ?>
                </td>
                <td>
                    <?php echo $form->textFieldRow($user,'lastName',array('class'=>'span12','maxlength'=>60)); ?>
                </td>
            </tr>
        </tbody>
    </table>

    <?php echo $form->textFieldRow($user,'pword',array('class'=>'span5','maxlength'=>200)); ?>

    <?php echo $form->textFieldRow($user,'created',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($user,'email',array('class'=>'span5','maxlength'=>45)); ?>

    <?php echo $form->textFieldRow($user,'mobile',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($user,'account',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($user,'superAdmin',array('class'=>'span5','maxlength'=>1)); ?>

    <?php echo $form->textFieldRow($user,'is_reseller',array('class'=>'span5','maxlength'=>1)); ?>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Create' : 'Save Update',
        )); ?>
    </div>

<?php $this->endWidget(); ?>