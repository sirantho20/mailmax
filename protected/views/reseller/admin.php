<?php
//die(Yii::app()->user->reselleraccountid);
//echo Yii::app()->user->reselleraccountid;die();
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index')
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle().slow();
	return false;
});
$('.search-form form').submit(function(){
	$('#account-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php helper::showPageTitle('Manage Accounts'); helper::showFlash();?>
<ul class="nav nav-pills">
        <li>
            <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
        </li>
        <li>
            <?php echo CHtml::link('Create Account',$this->createUrl('create')) ?>
        </li>
        
        </ul>

<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array('model'=>$model,)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'account-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
        'itemsCssClass'=>'table table-bordered table-hover table-condensed',
        'summaryCssClass'=>'summary',
        'pager'=>array('htmlOptions'=>array('class'=>'pagination')),
	'columns'=>array(
		array(
                    'name'=>'business_name',
                    'type'=>'raw',
                    'value'=>  'CHtml::link($data->business_name,  Yii::app()->createUrl("reseller/view",array(\'id\'=>$data->id)))',
                ),
		/* array(
                    'name'=>'package.package_name',
                    'value'=>'$data->account_package->package_name',
                ),*/
		'email',
		'mobile',
                array(
                    'name'=>'status',
                    'type'=>'raw',
                    'value'=>'$data->status=="a"?"<span class=\"label label-success\">active</span>":"<span class=\"label label-warning\">suspended</span>"'
                ),
		array(
                    'name'=>'signup_date',
                    'value'=>  'Yii::app()->dateFormatter->format(\'dd MM yyyy\', $data->signup_date)',
                ),
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		), 
	),
)); ?>
