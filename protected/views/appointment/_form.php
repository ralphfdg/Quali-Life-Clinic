<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
/* @var $form CActiveForm */

// 1. Prepare Lists for Dropdowns
// Doctors
$doctors = Account::model()->with('user')->findAll('account_type_id=3');
$doctorList = CHtml::listData($doctors, 'id', function ($d) {
	return isset($d->user) ? "Dr. " . $d->user->lastname . ", " . $d->user->firstname : $d->username;
});

// Patients
$patients = Account::model()->with('user')->findAll('account_type_id=4');
$patientList = CHtml::listData($patients, 'id', function ($p) {
	return isset($p->user) ? $p->user->lastname . ", " . $p->user->firstname : $p->username;
});

// Statuses
$statusList = CHtml::listData(AppointmentStatus::model()->findAll(), 'id', 'status_name');

// Format Date for HTML5 Input (YYYY-MM-DDTHH:MM)
$formattedDate = ($model->schedule_datetime) ? date('Y-m-d\TH:i', strtotime($model->schedule_datetime)) : '';
?>

<div class="container-fluid">
	<div class="card shadow mb-4" style="max-width: 800px; margin: 0 auto;">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><?php echo $model->isNewRecord ? 'Create Appointment' : 'Update Appointment'; ?></h6>
		</div>
		<div class="card-body">

			<?php $form = $this->beginWidget('CActiveForm', array(
				'id' => 'appointment-form',
				'enableAjaxValidation' => false,
			)); ?>

			<?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger small')); ?>

			<div class="row">
				<div class="col-md-6 form-group">
					<?php echo $form->labelEx($model, 'patient_account_id'); ?>
					<?php echo $form->dropDownList($model, 'patient_account_id', $patientList, array('empty' => '-- Select Patient --', 'class' => 'form-control')); ?>
					<?php echo $form->error($model, 'patient_account_id'); ?>
				</div>
				<div class="col-md-6 form-group">
					<?php echo $form->labelEx($model, 'doctor_account_id'); ?>
					<?php echo $form->dropDownList($model, 'doctor_account_id', $doctorList, array('empty' => '-- Select Doctor --', 'class' => 'form-control')); ?>
					<?php echo $form->error($model, 'doctor_account_id'); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 form-group">
					<?php echo $form->labelEx($model, 'schedule_datetime'); ?>
					<input type="datetime-local"
						name="Appointment[schedule_datetime]"
						value="<?php echo $formattedDate; ?>"
						class="form-control">
					<?php echo $form->error($model, 'schedule_datetime'); ?>
				</div>
				<div class="col-md-6 form-group">
					<?php echo $form->labelEx($model, 'appointment_status_id'); ?>
					<?php echo $form->dropDownList($model, 'appointment_status_id', $statusList, array('class' => 'form-control')); ?>
					<?php echo $form->error($model, 'appointment_status_id'); ?>
				</div>
			</div>

			<hr>

			<div class="form-group">
				<?php echo $form->labelEx($model, 'notes'); ?>
				<?php echo $form->textArea($model, 'notes', array('rows' => 3, 'class' => 'form-control', 'placeholder' => 'Optional notes about the visit...')); ?>
				<?php echo $form->error($model, 'notes'); ?>
			</div>

			<?php if (!$model->isNewRecord): ?>
				<div class="form-group">
					<?php echo $form->labelEx($model, 'cancellation_reason'); ?>
					<?php echo $form->textArea($model, 'cancellation_reason', array('rows' => 2, 'class' => 'form-control', 'placeholder' => 'If canceled, state reason here...')); ?>
					<?php echo $form->error($model, 'cancellation_reason'); ?>
				</div>
			<?php endif; ?>

			<?php if ($model->isNewRecord): ?>
				<?php echo $form->hiddenField($model, 'booked_by_account_id', array('value' => Yii::app()->user->id)); ?>
			<?php endif; ?>

			<div class="form-group mt-4 text-right">
				<?php echo CHtml::link('Cancel', array('appointment/calendar'), array('class' => 'btn btn-secondary mr-2')); ?>
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save Changes', array('class' => 'btn btn-primary px-4')); ?>
			</div>

			<?php $this->endWidget(); ?>

		</div>
	</div>
</div>