<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
/* @var $patientList array */
/* @var $isAdminOrSuperAdmin boolean */

$this->breadcrumbs = array(
	'Appointments' => array('index'),
	'Book',
);

// Register a small script to handle the slot selection
Yii::app()->clientScript->registerScript('slot-selector', "
function selectTime(time, btn) {
    // Set the hidden field value
    $('#selected_time').val(time);
    
    // Visual feedback
    $('.slot-btn').removeClass('active-slot').css('background-color', '#dfd'); // Reset others
    $(btn).addClass('active-slot').css('background-color', '#8f8'); // Highlight selected
    
    // Enable submit button
    $('#submit-btn').prop('disabled', false);
}
// Clear slots and button when a change in doctor/date occurs
function clearSlots() {
    $('#slots_container').html('<span class=\"hint\">Select a date above to see availability.</span>');
    $('#selected_time').val('');
    $('#submit-btn').prop('disabled', true);
}
", CClientScript::POS_HEAD);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><?php echo $isAdminOrSuperAdmin ? 'Book Appointment for Patient' : 'Book New Appointment'; ?></h1>
</div>

<div class="form card shadow mb-4 p-4">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'appointment-book-form',
		'enableAjaxValidation' => false,
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>

	<?php if ($isAdminOrSuperAdmin): ?>
		<div class="row mb-3 p-3 border rounded" style="background-color: #f8f9fc;">
			<h6 class="text-primary font-weight-bold mb-3 col-12">1. Select Patient or Register New</h6>

			<div class="col-md-6 form-group">
				<label class="required">Select Existing Patient <span class="required">*</span></label>
				<?php echo CHtml::dropDownList(
					'selected_patient_id',
					'',
					$patientList,
					array(
						'prompt' => '-- Choose Patient --',
						'class' => 'form-control',
						'onchange' => 'clearSlots();' // Clear slots when patient changes
					)
				); ?>
			</div>

			<div class="col-md-6 form-group text-right align-self-end">
				<?php echo CHtml::link('+ Register New Patient', array('/account/create', 'type' => 4), array('class' => 'btn btn-success')); ?>
			</div>
		</div>
	<?php endif; ?>
	<h6 class="text-primary font-weight-bold mb-3 col-12">
		<?php echo $isAdminOrSuperAdmin ? '2. Select Doctor & Time' : '1. Select Doctor & Time'; ?>
	</h6>

	<div class="row">
		<div class="col-md-6 form-group">
			<label class="required">Specialization <span class="required">*</span></label>
			<?php
			echo CHtml::dropDownList(
				'specialization_id',
				'',
				CHtml::listData(Specialization::model()->findAll(), 'id', 'specialization_name'),
				array(
					'prompt' => 'Select Specialization',
					'class' => 'form-control',
					'onchange' => 'clearSlots();',
					'ajax' => array(
						'type' => 'POST',
						'url' => $this->createUrl('appointment/dynamicDoctors'),
						'update' => '#Appointment_doctor_account_id',
						'data' => array('specialization_id' => 'js:this.value'),
					)
				)
			);
			?>
		</div>

		<div class="col-md-6 form-group">
			<?php echo $form->labelEx($model, 'doctor_account_id'); ?>
			<?php echo $form->dropDownList($model, 'doctor_account_id', array(), array(
				'prompt' => '-- Select Specialization First --',
				'class' => 'form-control',
				'onchange' => "clearSlots();" // Clear slots when doctor changes
			)); ?>
			<?php echo $form->error($model, 'doctor_account_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<label class="required">Preferred Date <span class="required">*</span></label>
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'schedule_datetime',
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					'minDate' => 0, // Must be at least tomorrow
					'onSelect' => 'js:function(selectedDate) {
    var doctorId = $("#Appointment_doctor_account_id").val();
    var finalPatientId = ' . $patientId . '; // Use the PHP variable initialized in controller

    // Override finalPatientId if Admin is booking for someone else
    if (' . ($isAdminOrSuperAdmin ? 'true' : 'false') . ') {
        finalPatientId = $("#selected_patient_id").val();
    }

    if(!doctorId) {
        alert("Please select a doctor first.");
        return;
    }
    
    // Check if a patient is selected/known
    if(!finalPatientId) {
        alert("Please select a patient or log in.");
        return;
    }

    // Send AJAX request
    $.ajax({
        type: "POST",
        url: "' . $this->createUrl('appointment/getAvailableSlots') . '",
        data: { doctor_id: doctorId, date: selectedDate }, // Patient ID is not needed for slots, only Doctor/Date
        success: function(data) {
            $("#slots_container").html(data);
        }
    });
}',
				),
				'htmlOptions' => array('placeholder' => 'Click to select date', 'class' => 'form-control', 'readonly' => true),
			));
			?>
			<?php echo $form->error($model, 'schedule_datetime'); ?>
		</div>

		<div class="col-md-6 form-group">
			<label>Available Time Slots</label>
			<div id="slots_container" class="p-3 border rounded" style="background: #f9f9f9;">
				<span class="hint">Select a date above to see availability.</span>
			</div>

			<?php echo CHtml::hiddenField('selected_time', '', array('id' => 'selected_time')); ?>
		</div>
	</div>

	<div class="row buttons mt-4">
		<?php echo CHtml::submitButton('Confirm Booking', array('id' => 'submit-btn', 'disabled' => 'disabled', 'class' => 'btn btn-primary btn-lg')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>