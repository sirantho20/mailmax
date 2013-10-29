<div>
    Hello <?php echo $model->firstname; ?>,<br />
    Congratulations! Your account setup is now complete. Below are your login details:<br />
    Username: <?php echo $model->email; ?><br />
    Password: <?php echo $password; ?><br />
    
    <p><?php echo CHtml::link('Click here',array(Yii::app()->createUrl('signup'))); ?> to login to your account. We hope you enjoy using our service.</p>
    <p>We are available 24/7 to provide you all necessary support. Just send us an email on <?php echo Yii::app()->params['mailSupportEmail']; ?> and we will help you in a matter of minutes.</p>
    
    <b>Softcube Team</b><br />
    
</div>