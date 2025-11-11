<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'appointment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_account_id'); ?>
		<?php echo $form->textField($model,'patient_account_id'); ?>
		<?php echo $form->error($model,'patient_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doctor_account_id'); ?>
		<?php echo $form->textField($model,'doctor_account_id'); ?>
		<?php echo $form->error($model,'doctor_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'booked_by_account_id'); ?>
		<?php echo $form->textField($model,'booked_by_account_id'); ?>
		<?php echo $form->error($model,'booked_by_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'schedule_datetime'); ?>
		<?php echo $form->textField($model,'schedule_datetime'); ?>
		<?php echo $form->error($model,'schedule_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'appointment_status_id'); ?>
		<?php echo $form->textField($model,'appointment_status_id'); ?>
		<?php echo $form->error($model,'appointment_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancellation_reason'); ?>
		<?php echo $form->textArea($model,'cancellation_reason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cancellation_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_booked'); ?>
		<?php echo $form->textField($model,'date_booked'); ?>
		<?php echo $form->error($model,'date_booked'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms_reminder_sent'); ?>
		<?php echo $form->textField($model,'sms_reminder_sent'); ?>
		<?php echo $form->error($model,'sms_reminder_sent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_reminder_sent'); ?>
		<?php echo $form->textField($model,'email_reminder_sent'); ?>
		<?php echo $form->error($model,'email_reminder_sent'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->