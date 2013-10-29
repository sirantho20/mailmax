    <!DOCTYPE html>
    <html>
    <head>
    <title>iMail</title>
    <?php 
    $baseUrl = Yii::app()->theme->baseUrl;
    $cs = Yii::app()->getClientScript();
     $cs->registerCssFile($baseUrl.'/css/main.css');
     Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/main.css');
    ?>
    </head>
    <body>
<?php
if(!Yii::app()->user->isGuest)
{
    require_once 'menu.php';
}
 else {
    require_once 'menuGuest.php';
}

?>
        <div class="container-fluid" style="padding-top: 40px; width: 940px; margin-left: auto;margin-right: auto;">
<?php
                //require_once 'menu.php';

echo $content;
?>
        </div>
    </body>