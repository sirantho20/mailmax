<?php
/* @var $this GroupsController */

$this->breadcrumbs=array(
	'Groups'=>array('/groups'),
	'Create',
);
?>

<?php 

$this->renderPartial('_form',array('model'=>$model)); ?>