<?php
$this->breadcrumbs=array(
	'Packages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Package','url'=>array('index')),
	array('label'=>'Create Package','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('package-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
helper::showPageTitle('Manage Packages');
helper::showFlash();
?>
<?php echo CHtml::link('Create Package', $this->createUrl('create')); ?>
<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'package-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
        'itemsCssClass'=>'table table-bordered table-hover table-condensed',
	'columns'=>array(
		array(
                    'name'=>'package_name',
                    'type'=>'raw',
                    'value'=>  'CHtml::link($data->package_name,Yii::app()->createUrl(\'package/update\',array(\'id\'=>$data->id)))'
                ),
		'email_limit',
		'space_limit',
                array(
                    'name' => 'duration_months',
                    'type' => 'raw',
                    'value' => '$data->duration_months." months"'
                ),
		/*
		'package_price',
		'account',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'viewButtonUrl' => 'Yii::app()->createUrl(\'package/update\',array(\'id\'=>$data->id))'
		),
	),
)); ?>
