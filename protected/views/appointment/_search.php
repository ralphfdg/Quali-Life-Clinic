<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_account_id'); ?>
		<?php echo $form->textField($model,'patient_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doctor_account_id'); ?>
		<?php echo $form->textField($model,'doctor_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booked_by_account_id'); ?>
		<?php echo $form->textField($model,'booked_by_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'schedule_datetime'); ?>
		<?php echo $form->textField($model,'schedule_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'appointment_status_id'); ?>
		<?php echo $form->textField($model,'appointment_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancellation_reason'); ?>
		<?php echo $form->textArea($model,'cancellation_reason',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_booked'); ?>
		<?php echo $form->textField($model,'date_booked'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_reminder_sent'); ?>
		<?php echo $form->textField($model,'sms_reminder_sent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_reminder_sent'); ?>
		<?php echo $form->textField($model,'email_reminder_sent'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->