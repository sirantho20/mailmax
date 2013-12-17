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
        
        $('#signUpModal, #signLink').on('click',function(e){
        e.preventDefault();
        $('#myModal').modal({remote:'<?php echo Yii::app()->createUrl('signup/interest'); ?>'});
        
        });
});
        </script>
        
</head>

<body style="padding-top: 0px !important;">
    
    <div class="row-fluid container"><div class="span1">Logo</div><div class="span11">others</div></div>
    <?php // $this->widget('bootstrap.widgets.TbNavbar',array(
//    'brand'=>'',
//    'htmlOptions'=>array('class'=>'navbar-fixed-top'),
//    'items'=>array(
//        array(
//            'class'=>'bootstrap.widgets.TbMenu',
//            
//            'items'=>array(
//                array('label'=>'Home','url'=>'/'),
//                array('label'=>'Features', 'url'=>'#features'),
//                array('label'=>'Pricing', 'url'=>'#pricing'),
//                
//                array('label'=>'Signup', 'url'=>  Yii::app()->createUrl('signup'),'htmlOptions'=>array('id'=>'signupModal')),
//                array('label'=>'Contact', 'url'=>'#contact'),
//                //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//                //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
//            ),
//            
//        ),
//      array(
//          'class'=>'bootstrap.widgets.TbMenu',
//          'htmlOptions'=>array('class'=>'pull-right'),
//          'items'=>array(
//              array('label'=>  'Login','url'=>  Yii::app()->createUrl('login')),
//          ),
//      ),
//    ),
//)); ?>
   <!-- <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
    <a class="brand" href="#">Mailmax</a>
    <ul class="nav">
        <li><a href="<?php //echo Yii::app()->createUrl('/') ?>#home">Home</a></li>
    <li><a href="<?php //echo Yii::app()->createUrl('/') ?>#features">Features</a></li>
    <li><a href="<?php //echo Yii::app()->createUrl('/') ?>#pricing">Pricing</a></li>
    <li><a href="<?php //echo Yii::app()->createUrl('/') ?>#contact">Contact</a></li>
    </ul>
       <ul class="nav pull-right">
           <li><a href="<?php echo Yii::app()->createUrl('login'); ?>">login</a></li>
    </ul>
    </div>
    </div> -->
    <a id="home"></a>
    <div style="margin-top: 100px;" class="clear"></div>

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
        <div class="row-fluid">
            
            <?php echo $content; ?>
            
        </div>
	

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

    </div>
    </div><!-- page -->

</body>
</html>

