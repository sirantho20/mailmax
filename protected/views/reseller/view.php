<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->business_name,
);

Yii::app()->clientScript->registerScript('resellerSuspendAccount', "
$('.resellerSuspendAccount').click(function(event){
     if(!confirm('Surely change account status?')){event.preventDefault();}
});
");

?>
        <ul class="nav nav-pills">
        <li>
            <a href="<?php echo $this->createUrl('update',array('id'=>$model->id)) ?>">Edit Account</a>
        </li>
        <li><a href="<?php echo $this->createUrl('suspend',array('id'=>$model->id)) ?>" class="resellerSuspendAccount"><?php echo $model->status=='a'?"Suspend Account":"Activate Account" ?></a></li>
        <li><a href="#">Delete Account</a></li>
        </ul>
    <div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
    <li class="active"><a href="#dashboard" data-toggle="tab">Dashboard</a></li>
    <li><a href="#details" data-toggle="tab">Account Details</a></li>
    <li><a href="#users" data-toggle="tab">Users</a></li>
    </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="dashboard">
        <p>
        <div class="container-fluid">
        
        <div class="span6 portlet bs-docs-example-disk">
                <div class="progress progress-warning progress-striped active offset1">
                <div class="bar" style="width: 80%;">80%</div>
                </div>
        </div>
        <div class="span6 portlet bs-docs-example-email">
                <div class="progress progress-success progress-striped active offset1">
                <div class="bar" style="width: 10%;">10%</div>
                </div>
        </div>
        
        </div>
        </p>
    </div>
    <div class="tab-pane" id="details">
    <p>
    
        <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'htmlOptions'=>array('class'=>'table table-condensed'),
                'attributes'=>array(
                        'business_name',
                        'account_package.package_name',
                        'email',
                        'mobile',
                        'signup_date',
                ),
        )); ?>
    </p>

    </div>
    <div class="tab-pane" id="users">

<?php echo $model->getAccountUsers($model->id)->itemCount > 0?'':CHtml::link('Create User',  Yii::app()->createUrl('reseller/usercreate',array('ac'=>$model->id))); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'users-grid',
    'dataProvider'=>$model->getAccountUsers($model->id),
    //'filter'=>$model,
    'columns'=>array(
       // 'id',
        'lastName',
        'firstName',
        'email',
        'mobile',
        array(
            'header'=>'',
            'type'=>'raw',
            'value'=>'CHtml::link("Edit Details",Yii::app()->createUrl(\'reseller/userupdate\',array(\'id\'=>$data->id)),array("alt"=>"Edit Details"))'
        )
        ,
        /*
        'lastName',
        'mobile',
        'account',
        'superAdmin',
        'is_reseller',
       
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'updateButtonUrl'=>  'Yii::app()->createUrl(\'account/userupdate\',array(\'id\'=>$data->id))',
            'updateButtonOptions'=> array('class'=>'updateuserbutton','class'=>'updateuserbutton'),
        ), */
    ),
)); ?> 

    </div>
    </div>
    </div>

