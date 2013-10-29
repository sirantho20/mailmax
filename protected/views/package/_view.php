<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('package_name')); ?>:</b>
	<?php echo CHtml::encode($data->package_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_limit')); ?>:</b>
	<?php echo CHtml::encode($data->email_limit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('space_limit')); ?>:</b>
	<?php echo CHtml::encode($data->space_limit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration_months')); ?>:</b>
	<?php echo CHtml::encode($data->duration_months); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domain_limit')); ?>:</b>
	<?php echo CHtml::encode($data->domain_limit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('package_price')); ?>:</b>
	<?php echo CHtml::encode($data->package_price); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('account')); ?>:</b>
	<?php echo CHtml::encode($data->account); ?>
	<br />

	*/ ?>

</div>