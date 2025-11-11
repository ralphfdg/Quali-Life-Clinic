<?php
/* @var $this BillingController */
/* @var $data Billing */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appointment_id')); ?>:</b>
	<?php echo CHtml::encode($data->appointment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_status')); ?>:</b>
	<?php echo CHtml::encode($data->payment_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_paid')); ?>:</b>
	<?php echo CHtml::encode($data->date_paid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->created_by_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	*/ ?>

</div>