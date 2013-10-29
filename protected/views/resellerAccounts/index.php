<?php
/* @var $this ResellerAccountsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reseller Accounts',
);

$this->menu=array(
	array('label'=>'Create ResellerAccounts', 'url'=>array('create')),
	array('label'=>'Manage ResellerAccounts', 'url'=>array('admin')),
);
?>

<h1>Reseller Accounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
