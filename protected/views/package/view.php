<?php
$this->breadcrumbs=array(
	'Packages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Package','url'=>array('index')),
	array('label'=>'Create Package','url'=>array('create')),
	array('label'=>'Update Package','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Package','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Package','url'=>array('admin')),
);
?>

<h1>View Package #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'package_name',
		'email_limit',
		'space_limit',
		'duration_months',
		'package_price',
		'account',
	),
)); ?>
