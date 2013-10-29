<?php 
if(Yii::app()->user->isGuest)
{
    include 'public.php';
}
elseif(Yii::app()->user->IsReseller) 
{
    include('resellerMenu.php');
}
else 
{
    include 'standardMenu.php';
}
?>