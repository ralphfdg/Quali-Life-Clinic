<?php
/* @var $this AppointmentController */
/* @var $data Appointment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doctor_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->doctor_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('booked_by_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->booked_by_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('schedule_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->schedule_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appointment_status_id')); ?>:</b>
	<?php echo CHtml::encode($data->appointment_status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cancellation_reason')); ?>:</b>
	<?php echo CHtml::encode($data->cancellation_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_booked')); ?>:</b>
	<?php echo CHtml::encode($data->date_booked); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_reminder_sent')); ?>:</b>
	<?php echo CHtml::encode($data->sms_reminder_sent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_reminder_sent')); ?>:</b>
	<?php echo CHtml::encode($data->email_reminder_sent); ?>
	<br />

	*/ ?>

</div>