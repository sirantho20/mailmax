<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'brand'=>'<img src="/images/softcube-sugar.png" style="height:25px; width:90%;"/>',
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            
            'items'=>array(
                array('label'=>'Dashboard', 'url'=>array('/dashboard/index')),
                array('label'=>'Emails', 'url'=>array('/emailAccounts')),
                array('label'=>'Groups', 'url'=>array('groups')),
                array('label'=>'Billing', 'url'=>array('/site/contact')),
                array('label'=>'Reseller','url'=>'#','items'=>array(
                    array('label'=>'Accounts','url'=>$this->createUrl('reseller/admin')),
                    array('label'=>'Settings', 'url'=>array('/site/contact')),
                )),
                //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
            
        ),
      array(
          'class'=>'bootstrap.widgets.TbMenu',
          'htmlOptions'=>array('class'=>'pull-right'),
          'items'=>array(
              array('label'=>  Yii::app()->user->isGuest?'':Yii::app()->user->firstname.'('.Yii::app()->user->businessname.')','url'=>'#','items'=>array(
                  array('label'=>'Login','url'=>$this->createUrl('login/index')),
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
	<?php endif?>
        <?php 
            Yii::app()->clientScript->registerScript('autoremoveAlertBox', "
                setTimeout(function() {
                $(\".alert-clear\").remove();
              }, 4000);
            ");
        ?>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

    </div>
    </div><!-- page -->

</body>
</html>

