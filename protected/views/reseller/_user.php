<?php
    $this->breadcrumbs=array(
	'Accounts'=>array('admin'),  Yii::app()->user->businessname=>array('view','id'=>  Yii::app()->user->mainaccountid()),'User',
);
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'users-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php helper::showPageTitle('Account User - '.Yii::app()->user->businessname); 
          // create user
          
          helper::showFlash();
    ?>

    <?php echo $form->errorSummary($model); ?>

    
    <?php //echo $form->textFieldRow($model,'account',array('class'=>'span5','maxlength'=>45)); ?>
    <?php echo $form->textFieldRow($model,'firstName',array('class'=>'span5','maxlength'=>45)); ?>
    
    <?php echo $form->textFieldRow($model,'lastName',array('class'=>'span5','maxlength'=>45)); ?>
    
    <?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>45)); ?>
    <?php if($model->scenario =='Createnew'): ?>
    <?php echo $form->textFieldRow($model,'pword',array('class'=>'span5','maxlength'=>200)); ?>
    <?php endif; ?>
    <?php //echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>45)); ?>

    

    <?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($model,'account',array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($model,'superAdmin',array('class'=>'span5','maxlength'=>1)); ?>

    <?php //echo $form->textFieldRow($model,'is_reseller',array('class'=>'span5','maxlength'=>1)); ?>
<p><?php if(!$model->isNewRecord): ?><?php echo CHtml::ajaxLink('Reset Password', $this->createUrl('resetAccountPassword',array('id'=>$model->id)),
        array(
            'type'=>'post',
            'data'=>array('id'=>$model->id),
            'beforeSend'=>'function(){$("#pword-ajax-notice").html(\'<img src="/images/sending.gif" />\');}',
            'success'=>'function(data,status,hq){$("#pword-ajax-notice").html(data);}',
            'error'=>'function(jq,status,err){alert(status);}'
            
            )); 
?>
    <?php endif; ?>
    <span id="pword-ajax-notice" style="padding-left: 10px;"></span></p>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Create User' : 'Save Updates',
        )); ?>
    </div>

<?php $this->endWidget(); ?>