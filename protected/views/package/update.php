<?php
$this->breadcrumbs=array(
	'Packages'=>array('index'),
	$model->package_name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Package','url'=>array('index')),
	array('label'=>'Create Package','url'=>array('create')),
	array('label'=>'View Package','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Package','url'=>array('admin')),
);
?>



<?php helper::showPageTitle('Update package - '.$model->package_name); echo $this->renderPartial('_form',array('model'=>$model)); ?>