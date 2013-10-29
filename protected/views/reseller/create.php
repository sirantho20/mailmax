<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Manage Account', 'url'=>array('admin')),
);
?>

<?php helper::showPageTitle('Create Account');helper::showFlash(); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php //echo $this->renderPartial('_users', array('model'=>$user)); ?>