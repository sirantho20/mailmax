<?php
/* @var $this EmailAccountsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Email Accounts',
);

$this->menu=array(
	array('label'=>'Create EmailAccounts', 'url'=>array('create')),
	array('label'=>'Manage EmailAccounts', 'url'=>array('admin')),
);
?>

<h1>Email Accounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
