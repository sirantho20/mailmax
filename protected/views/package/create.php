<?php
$this->breadcrumbs=array(
	'Packages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Package','url'=>array('index')),
	array('label'=>'Manage Package','url'=>array('admin')),
);
?>

<?php helper::showPageTitle('Create Package');helper::showFlash(); echo $this->renderPartial('_form', array('model'=>$model)); ?>