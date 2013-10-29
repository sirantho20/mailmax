<?php
$this->breadcrumbs=array(
	'Packages',
);

$this->menu=array(
	array('label'=>'Create Package','url'=>array('create')),
	array('label'=>'Manage Package','url'=>array('admin')),
);
?>

<h1>Packages</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
