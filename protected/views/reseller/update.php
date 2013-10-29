<?php helper::showPageTitle('Update Account - '.$model->business_name); ?>
<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->business_name=>array('view','id'=>$model->id),
	'Update',
);

helper::showFlash();

?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>