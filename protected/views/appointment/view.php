<?php
/* @var $this AppointmentController */
/* @var $model Appointment */

$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Appointment', 'url'=>array('index')),
	array('label'=>'Create Appointment', 'url'=>array('create')),
	array('label'=>'Update Appointment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Appointment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Appointment', 'url'=>array('admin')),
);
?>

<h1>View Appointment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_account_id',
		'doctor_account_id',
		'booked_by_account_id',
		'schedule_datetime',
		'appointment_status_id',
		'notes',
		'cancellation_reason',
		'date_booked',
		'sms_reminder_sent',
		'email_reminder_sent',
	),
)); ?>
