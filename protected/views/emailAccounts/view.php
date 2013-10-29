<?php
/* @var $this EmailAccountsController */
/* @var $model EmailAccounts */

$this->breadcrumbs=array(
	'Email Accounts'=>array('index'),
	$model->email.'@'.Yii::app()->user->accountdomain,
);

$this->menu=array(
	array('label'=>'List EmailAccounts', 'url'=>array('index')),
	array('label'=>'Create EmailAccounts', 'url'=>array('create')),
	array('label'=>'Update EmailAccounts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EmailAccounts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmailAccounts', 'url'=>array('admin')),
);
?>

<?php helper::showPageTitle('Email Details -'.$model->email.'@'.Yii::app()->user->accountdomain); ?>
    <ul class="nav nav-pills">
        <li><a href="<?php echo $this->createUrl('update',array('id'=>$model->id)); ?>">Edit</a></li>
        <li><?php echo CHtml::link('Delete', $this->createUrl('delete',array('id'=>$model->email.'@'.Yii::app()->user->accountdomain)),array('confirm'=>'You are about to permanently delete '.$model->email.'@'.Yii::app()->user->accountdomain.'. Note this action cannot be reversed. Do you want to continue?')); ?></li>
    <li><?php echo CHtml::ajaxLink('Reset Password', $this->createUrl('resetAccountPassword',array('account'=>$model->email)),
            array(
                'type'=>'post',
                'data'=>array('account'=>$model->email),
                'beforeSend'=>'function(){$("#resetAccountPassword").html(\'<img src="/images/sending.gif" />\');}',
                //'success'=>'function($data){$("#resetAccountPassword").removeClass("hidden");$("#resetAccountPassword").html(data);}',
                'update'=>'#resetAccountPassword',
                
                
                )); ?></li><span style="padding-left: 15px;" id="resetAccountPassword"></span>
    </ul>
<div class="container-fluid">
    <div class="container span6">
        <div class="portlet bs-docs-example-emailQuota"><center style="font-size:90%;"><?php echo 'Disk Quota '.$quota.'MB'; ?></center>
                <div class="progress progress-success progress-striped active offset1" style="height: 40px;">
                <div class="bar" style="width: <?php echo $quotaused;?>; padding-top: 10px;"><?php echo $quotaused.' used';?></div>
                </div>
        </div>
    </div>
    <div class="container span6">
        <div class="portlet bs-docs-example-emailAcountDetails">
        <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions'=>array('class'=>'table table-bordered table-hover table-condensed'),
	'attributes'=>array(
		'first_name',
		'last_name',
		array(
                    'name'=>'email',
                    'type'=>'raw',
                    'value'=>$model->email.'@'.Yii::app()->user->accountdomain(),
                ),
		'created',
		'job_title',
		'department',
	),
)); ?>
        </div>
    </div>
</div>

