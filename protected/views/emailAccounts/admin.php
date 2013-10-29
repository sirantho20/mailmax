<?php
/* @var $this EmailAccountsController */
/* @var $model EmailAccounts */

$this->breadcrumbs=array(
	'Email Accounts'=>array('index'),
);

$this->menu=array(
	array('label'=>'List EmailAccounts', 'url'=>array('index')),
	array('label'=>'Create EmailAccounts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#email-accounts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php helper::showFlash('alert-clear'); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'email-accounts-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
        'itemsCssClass'=>'table table-bordered table-hover table-condensed',
	'columns'=>array(
            	array(
                    'name'=>'first_name',
                    'type'=>'raw',
                    'value'=>  'CHtml::link($data->first_name,Yii::app()->createUrl(\'emailAccounts/view\',array(\'id\'=>$data->id)))'
                ),
		array(
                    'name'=>'last_name',
                    'type'=>'raw',
                    'value'=>  'CHtml::link($data->last_name,Yii::app()->createUrl(\'emailAccounts/view\',array(\'id\'=>$data->id)))'
                ),
                array(
                    'name'=>'email',
                    'type'=>'raw',
                    'value'=>  'CHtml::link($data->email."@".Yii::app()->user->accountdomain,Yii::app()->createUrl(\'emailAccounts/view\',array(\'id\'=>$data->id)))'
                ),
                array(
                    'name'=>'quota',
                    'type'=>'raw',
                    'value'=>'$data->quota',//array($this,'renderQuota'),
                ),
		array(
                    'name'=>'status',
                    'type'=>'raw',
                    'value'=>array($this,'renderStatus'),
                ),
                array(
                    'name'=>'lastlogon',
                    'value'=>  array($this,'renderLastLogon'),
                ),
		/*
		'quota',
		'account',
		'job_title',
		'department',
		'office',
		
		array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>
