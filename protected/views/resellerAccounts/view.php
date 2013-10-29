<?php
/* @var $this ResellerAccountsController */
/* @var $model ResellerAccounts */

$this->breadcrumbs=array(
	'Reseller Accounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ResellerAccounts', 'url'=>array('index')),
	array('label'=>'Create ResellerAccounts', 'url'=>array('create')),
	array('label'=>'Update ResellerAccounts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ResellerAccounts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResellerAccounts', 'url'=>array('admin')),
);
?>

<h1>View ResellerAccounts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'business_name',
		'reseller_package',
		'email',
		'mobile',
		'status',
	),
)); ?>
