<div>
    Hello <span><?php echo $model->firstname; ?></span>,
    <p>Thanks for showing interest in our email services. Your account has been created and you are just a few steps from getting your account ready for use.</p>
    <p>
        Please click below link to complete setting up your account:
       <br /><?php echo CHtml::link('Setup your account', Yii::app()->createAbsoluteUrl('signup/index',array('ch'=>$model->email,'hid'=>$model->hash_id))); ?>
    </p>
    Thanks for using our services.<br />
    <br />
    <b>Softcube Team</b>
</div>