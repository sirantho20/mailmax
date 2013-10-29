<?php
/* @var $this EmailAccountsController */
/* @var $model EmailAccounts */

$this->breadcrumbs=array(
	'Email Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmailAccounts', 'url'=>array('index')),
	array('label'=>'Manage EmailAccounts', 'url'=>array('admin')),
);
?>

<?php helper::showPageTitle('Create Email Account');helper::showFlash(); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>