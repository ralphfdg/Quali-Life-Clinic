<?php
/* @var $this AppointmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	'Calendar',
);

$this->menu=array(
	array('label'=>'List Appointments', 'url'=>array('index')),
	array('label'=>'Create Appointment', 'url'=>array('create')),
	array('label'=>'Manage Appointments', 'url'=>array('admin')),
);
?>

<h1>Appointment Calendar</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'appointment-calendar-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'schedule_datetime',
			'header'=>'Date & Time',
			'value'=>'date("F j, Y, g:i A", strtotime($data->schedule_datetime))',
		),
		array(
			'header'=>'Patient',
			'name'=>'patient_id', 
			'value'=>'$data->patientAccount && $data->patientAccount->user ? $data->patientAccount->user->firstname . " " . $data->patientAccount->user->lastname : "Unknown"',
		),
		array(
			'header'=>'Doctor',
			'name'=>'doctor_id',
			'value'=>'$data->doctorAccount && $data->doctorAccount->user ? "Dr. " . $data->doctorAccount->user->lastname : "Unassigned"',
		),
		array(
			'header'=>'Status',
			'name'=>'status_id',
			'value'=>'$data->appointmentStatus ? $data->appointmentStatus->status_name : "N/A"',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}',
		),
	),
)); ?>