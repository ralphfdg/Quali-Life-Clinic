<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	'Book',
);

$this->menu=array(
	array('label'=>'My Appointments', 'url'=>array('myAppointments')),
);
?>

<h1>Book a New Appointment</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'appointment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'doctor_account_id'); ?>
		<?php echo $form->dropDownList($model,'doctor_account_id', $doctorList, array('empty'=>'-- Select a Doctor --')); ?>
		<?php echo $form->error($model,'doctor_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'schedule_datetime'); ?>
		<?php 
        // Simple text field for date/time. 
        // Format: YYYY-MM-DD HH:MM:SS (e.g., 2024-01-30 09:00:00)
        echo $form->textField($model,'schedule_datetime', array('placeholder'=>'YYYY-MM-DD HH:MM:SS')); 
        ?>
		<p class="hint">Please enter date and time (e.g., 2024-12-25 14:00:00)</p>
		<?php echo $form->error($model,'schedule_datetime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Confirm Booking'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<?php
/* @var $this AppointmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Appointments',
);

$this->menu=array(
	array('label'=>'Book New Appointment', 'url'=>array('book')),
);
?>

<h1>My Appointments</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'id'=>'my-appointments-grid',
	'columns'=>array(
		array(
			'name'=>'schedule_datetime',
			'header'=>'Date & Time',
			'value'=>'date("F j, Y, g:i A", strtotime($data->schedule_datetime))',
		),
		array(
			'header'=>'Doctor',
			'value'=>'$data->doctorAccount && $data->doctorAccount->user ? "Dr. " . $data->doctorAccount->user->lastname : "Unknown"',
		),
		array(
			'name'=>'status_id',
			'header'=>'Status',
			'value'=>'$data->appointmentStatus ? $data->appointmentStatus->status_name : "Pending"',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}', // Patients can only view details, not update/delete from here
		),
	),
)); ?>