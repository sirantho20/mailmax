<?php
/* @var $this DashboardController */
//Yii::app()->clientScript->registerScriptFile('https://www.google.com/jsapi');

Yii::app()->clientScript->registerScript('googleVisualisationAccountDashboard', "
 
");
if ( $emailsCreated > 0):
?>
<div class="row-fluid">
    <div class="container span6">
        <div class="portlet bs-docs-example-domainDiskUsage"><center style="font-size:90%;"><?php echo 'Used '.  Yii::app()->numberFormatter->format('',$domainUsedDisk).' out of '.$provisioned.'MB available'; ?></center>
                <div class="progress progress-success progress-striped <?php if($percent <= 70){echo 'progress-success';}elseif($percent >=71 && $percent <=90){echo 'progress-warning';}else{echo 'progress-danger';}?> active offset1" style="height: 40px;">
                <div class="bar" style="width: <?php echo $percent.'%';?>; padding-top: 10px;"><?php echo $percent.'% used';?></div>
                </div>
        </div>
    </div>
    <div class="span6">
        <div class="bs-docs-example-emailAllocation"><center style="font-size:90%;"><?php echo 'Created '.$emailsCreated.' emails out of '.$emailLimit.' available'; ?></center>
            <div class="progress progress-success progress-striped <?php if($emailsCreated <= 70){echo 'progress-success';}elseif($emailsCreated >=71 && $emailsCreated <=90){echo 'progress-warning';}else{echo 'progress-danger';}?> active offset1" style="height: 40px;">
                <div class="bar" style="width: <?php echo $emailsCreatedPercent.'%';?>; padding-top: 10px;"><?php echo $emailsCreatedPercent.'% used';?></div>
                </div>
            <!--<center>
                <div class="row-fluid">Emails Allocated:</div>
                <div class="row-fluid">Created:<?php //echo $emailsCreated; ?> </div>
                <div class="clear"></div>
            
            <div id="emailAccountGauge"></div>
        
            </center> -->
        </div>
    </div>
</div>
<div class="row-fluid">
    <div id="chart_div" class="bs-docs-example-domainTopDiskUsers"></div>
</div>
<?php else: ?>
<div class="row-fluid span6 offset3">
    <div>You have not created any email accounts yet. <a class="btn btn-inverse" href="<?php echo $this->createAbsoluteUrl('emailAccounts/create'); ?>">Create one here!</a></div>
</div>
<?php endif; ?>

