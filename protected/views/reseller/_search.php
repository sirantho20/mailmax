<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>
<p><small>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
    </small></p>
 <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'account-form',
    'enableAjaxValidation'=>false,
)); ?>
<div class="row-fluid wall form-actions">
<table border="0" style="width: 100%" class="">
    <tbody>
        <tr>
            <td><?php echo $form->textFieldRow($model,'id'); ?></td>
            <td><?php echo $form->textFieldRow($model,'business_name',array('size'=>45,'maxlength'=>45)); ?></td>
            <td><?php echo $form->dropDownListRow($model,'package',array('package')); ?></td>
            
            
        </tr>
        <tr>
            <td><?php echo $form->textFieldRow($model,'email',array('size'=>50,'maxlength'=>50)); ?></td>
            <td><?php echo $form->textFieldRow($model,'mobile'); ?></td>
            <td><?php echo $form->textFieldRow($model,'signup_date'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->textFieldRow($model,'status',array('size'=>1,'maxlength'=>1)); ?></td>
            <td></td>
            <td><div class=" buttons">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn')); ?>
	</div></td>
        </tr>
    </tbody>
</table>
</div>
<div class="wide form">

        

	

	

	

	

	

	

	

<?php $this->endWidget(); ?>

</div><!-- search-form -->