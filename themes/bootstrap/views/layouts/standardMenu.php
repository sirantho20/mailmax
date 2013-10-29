<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>

<?php if($this->id =='dashboard'): ?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart","gauge"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        
        var data = google.visualization.arrayToDataTable([<?php $re = new Account(); echo $re->getTopDiskUserData(8); ?>]);

        var options = {
          vAxis: {title: 'Disk Space(MB)',  titleTextStyle: {}, position:'none'},
          legend: {position: 'none'},
          hAxis: {slantedText: true}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        
        var gaugeData = google.visualization.arrayToDataTable([['Label','Value'],['Emails',<?php echo $re->getAccountPackageDiskUsagePercent(); ?>]]);
         var gaugeOptions = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
        
        var gaugeChart = new google.visualization.Gauge(document.getElementById('emailAccountGauge'));
        gaugeChart.draw(gaugeData, gaugeOptions);


      }
    </script>
    <?php endif; ?>
        
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'brand'=>'<img src="'.Yii::app()->baseUrl.'/images/softcube-sugar.png'.'" style="height:25px; width:90%;"/>',
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            
            'items'=>array(
                array('label'=>'Dashboard', 'url'=>array('/dashboard/index')),
                array('label'=>'Emails', 'url'=>array('/emailAccounts')),
                array('label'=>'Groups', 'url'=>array('/groups')),
                array('label'=>'Billing', 'url'=>array('#')),
                //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
            
        ),
      array(
          'class'=>'bootstrap.widgets.TbMenu',
          'htmlOptions'=>array('class'=>'pull-right'),
          'items'=>array(
              array('label'=>  Yii::app()->user->isGuest?'':Yii::app()->user->firstname.'('.Yii::app()->user->businessname.')','url'=>'#','items'=>array(
                  //array('label'=>'Login','url'=>$this->createUrl('login/index')),
                  array('label'=>'Logout','url'=>$this->createUrl('logout/index')),
              )),
          ),
      ),
    ),
)); ?>
    <div style="margin-top: 55px;" class="clear"></div>
    
    <div class="container-fluid content">
    <div class="row-fluid">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif; ?>
        <?php 
            Yii::app()->clientScript->registerScript('autoremoveAlertBox', "
                setTimeout(function() {
                $(\".alert-clear\").remove();
              }, 6000);
            ");
        ?>
        <!--- ajax flash msg -->
        <center><div id="ajaxMsg"></div></center>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

    </div>
    </div><!-- page -->

</body>
</html>

