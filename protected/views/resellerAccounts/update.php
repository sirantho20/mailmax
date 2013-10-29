<?php
/* @var $this ResellerAccountsController */
/* @var $model ResellerAccounts */

$this->breadcrumbs=array(
	'Reseller Accounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResellerAccounts', 'url'=>array('index')),
	array('label'=>'Create ResellerAccounts', 'url'=>array('create')),
	array('label'=>'View ResellerAccounts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ResellerAccounts', 'url'=>array('admin')),
);
?>

<h1>Update ResellerAccounts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>