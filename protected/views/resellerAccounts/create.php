<?php
/* @var $this ResellerAccountsController */
/* @var $model ResellerAccounts */

$this->breadcrumbs=array(
	'Reseller Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResellerAccounts', 'url'=>array('index')),
	array('label'=>'Manage ResellerAccounts', 'url'=>array('admin')),
);
?>

<h1>Create ResellerAccounts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>