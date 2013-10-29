<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'email-accounts-newEmail-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
            'validateOnType'=>true,
        )

)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name'); ?>
        <?php echo $form->error($model,'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'middle_name'); ?>
        <?php echo $form->textField($model,'middle_name'); ?>
        <?php echo $form->error($model,'middle_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name'); ?>
        <?php echo $form->error($model,'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
       <div class="input-prepend"> <?php echo $form->textField($model,'email'); ?>
        <span class="add-on">@</span>
        <?php echo CHtml::dropDownList('emailDomain', '', Domain::getDomains(),array()); ?>
        </div>
        <?php echo $form->error($model,'email'); ?>
    </div>
    
    <div class="row">
        <?php echo CHtml::label('Password', 'pword') ?>
        <?php echo CHtml::passwordField('pword','',array('name'=>'pword','class'=>'pword')); ?>
    </div>
    
    <div class="row">
        <?php echo CHtml::label('Repeat Password', 'pword') ?>
        <?php echo CHtml::passwordField('rpword','',array('name'=>'rpword','class'=>'rpword')); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-info')); ?>
    </div>

<?php $this->endWidget(); ?>