<div>
Dear <?php echo $model->firstName; ?>, 
Your email administrator has reset your password. Find your login details below: 
<p>
    <span><b>Username</b>: <?php echo $model->username; ?></span><br />
    <span><b>Password</b>: <?php echo $password; ?></span>
</p>
<p>Click <?php echo CHtml::link('here',  Yii::app()->createUrl('/')); ?> to login to your account.</p>

Thanks for using our services. 
<p>
Softcube Team<br />
www.softcube.com
</p>
</div>
