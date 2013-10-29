<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Offside' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
        <script>
        $(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash,
	    $target = $(target);
	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
        
});
        </script>
        
</head>

<body style="padding-top: 0px !important;">
    <?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'brand'=>'<img src="'.Yii::app()->baseUrl.'/images/logo.fw.png'.'" style="height:25px; width:90%;"/>',
    'htmlOptions'=>array('class'=>'fixed-top'),
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/')),
                //array('label'=>'Pricing', 'url'=>'#pricing'),
                //array('label'=>'Signup', 'url'=>'#signup'),
                //array('label'=>'Contact', 'url'=>'#contact'),
                //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
            
        ),
      array(
          'class'=>'bootstrap.widgets.TbMenu',
          'htmlOptions'=>array('class'=>'pull-right'),
          'items'=>array(
              array('label'=>  'Login','url'=>  Yii::app()->createUrl('login')),
          ),
      ),
    ),
)); ?>
    <div style="margin-top: 45px;" class="clear"></div>

    <div class="row-fluid">
        <?php 
            Yii::app()->clientScript->registerScript('autoremoveAlertBox', "
                setTimeout(function() {
                $(\".alert-clear\").remove();
              }, 4000);
            ");
        ?>
        <!--- ajax flash msg -->
        <center><div id="ajaxMsg"></div></center>
        <div class="row-fluid offset2 span8">
            <div class="container-fluid content">
                <?php echo $content; ?>
            </div>
            
            
        </div>
	

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

    </div>
    </div><!-- page -->

</body>
</html>

