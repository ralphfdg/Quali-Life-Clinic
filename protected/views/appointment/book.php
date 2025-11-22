<?php
/* @var $this AppointmentController */
/* @var $model Appointment */

$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	'Book',
);

// Register a small script to handle the slot selection
Yii::app()->clientScript->registerScript('slot-selector', "
function selectTime(time, btn) {
    // Set the hidden field value
    $('#selected_time').val(time);
    
    // Visual feedback
    $('.slot-btn').css('background-color', '#dfd'); // Reset others
    $(btn).css('background-color', '#8f8'); // Highlight selected
    
    // Enable submit button
    $('#submit-btn').prop('disabled', false);
}
", CClientScript::POS_HEAD);
?>

<h1>Book an Appointment</h1>

<div class="form" style="margin-top: 20px; border: 1px solid #e5e5e5; padding: 20px; border-radius: 5px;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'appointment-book-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<label class="required">Specialization <span class="required">*</span></label>
		<?php 
			echo CHtml::dropDownList('specialization_id', '', 
				CHtml::listData(Specialization::model()->findAll(), 'id', 'specialization_name'),
				array(
					'prompt'=>'Select Specialization',
					'ajax' => array(
						'type'=>'POST', 
						'url'=>$this->createUrl('appointment/dynamicDoctors'), 
						'update'=>'#Appointment_doctor_account_id',
						'data'=>array('specialization_id'=>'js:this.value'),
					)
				)
			); 
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doctor_account_id'); ?>
		<?php echo $form->dropDownList($model,'doctor_account_id', array(), array(
			'prompt'=>'-- Select Specialization First --',
			// When doctor changes, reset the slots
			'onchange'=>"$('#slots_container').html(''); $('#Appointment_schedule_datetime').val('');"
		)); ?>
		<?php echo $form->error($model,'doctor_account_id'); ?>
	</div>

	<div class="row">
		<label class="required">Preferred Date <span class="required">*</span></label>
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'schedule_datetime', // This binds to the model but we use it just for the date
			'options' => array(
				'dateFormat' => 'yy-mm-dd',
				'minDate' => 1, // Must be at least tomorrow
				// When date is selected, trigger AJAX to fetch slots
				'onSelect' => 'js:function(selectedDate) {
					var doctorId = $("#Appointment_doctor_account_id").val();
					if(!doctorId) {
						alert("Please select a doctor first.");
						return;
					}
					
					// Send AJAX request
					$.ajax({
						type: "POST",
						url: "'.$this->createUrl('appointment/getAvailableSlots').'",
						data: { doctor_id: doctorId, date: selectedDate },
						success: function(data) {
							$("#slots_container").html(data);
						}
					});
				}',
			),
			'htmlOptions' => array(
				'placeholder' => 'Click to select date',
				'readonly' => true
			),
		));
		?>
		<?php echo $form->error($model,'schedule_datetime'); ?>
	</div>

	<div class="row">
		<label>Available Time Slots</label>
		<div id="slots_container" style="padding: 10px; background: #f9f9f9; border: 1px solid #ddd;">
			<span class="hint">Select a date above to see availability.</span>
		</div>
		
		<?php echo CHtml::hiddenField('selected_time', '', array('id'=>'selected_time')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Confirm Booking', array('id'=>'submit-btn', 'disabled'=>'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>