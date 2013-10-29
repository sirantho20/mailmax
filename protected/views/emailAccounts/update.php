<?php
/* @var $this EmailAccountsController */
/* @var $model EmailAccounts */

$this->breadcrumbs=array(
	'Email Accounts'=>array('index'),
	$model->email.'@'.Yii::app()->user->accountdomain=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmailAccounts', 'url'=>array('index')),
	array('label'=>'Create EmailAccounts', 'url'=>array('create')),
	array('label'=>'View EmailAccounts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EmailAccounts', 'url'=>array('admin')),
);
?>

<?php helper::showPageTitle('Update Email - '.$model->email.'@'.Yii::app()->user->accountdomain); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>