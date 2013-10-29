<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'account-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
)); 




?>

<fieldset style="margin-top: 25px;"><legend>Account Setup</legend></fieldset>
    <?php echo $form->errorSummary($model); 
    helper::showFlash(); ?>

    <?php echo $form->textFieldRow($model,'business_name',array('class'=>'span5','maxlength'=>45)); ?>
    <?php echo $form->textFieldRow($model,'domain',array('class'=>'span5','maxlength'=>45)); ?>
    
    <?php echo $form->textFieldRow($model,'vhost',array('class'=>'span5','maxlength'=>45)); ?>
    <?php echo $form->dropDownListRow($model,'package',  Package::listPackages(),array('class'=>'span5','prompt'=>'select a package')); ?>

    <?php echo $form->dropDownListRow($model,'duration',array(12=>'1year',24=>'2years',36=>'3years',48=>'4years',60=>'5years'),array('class'=>'span5')); ?>
    <?php //echo CHtml::activeLabel($model, 'Are you human?'); ?>
    <?php //$this->widget('application.extensions.recaptcha.EReCaptcha', 
//          array('model'=>$model, 'attribute'=>'validation',
//         'theme'=>'white', 'language'=>'es_ES', 
//         'publicKey'=>'6LdyAeQSAAAAAP_-pN0zONnsY5-Ezamk3cCKFQdi ')) ?>
    <?php //echo CHtml::error($model, 'validation',array('class'=>'help-block error')); ?>
    <div>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? 'Signup' : 'Save',
            'htmlOptions'=>array('class'=>'btn btn-large')
        )); ?>
    </div>

<?php $this->endWidget(); ?>