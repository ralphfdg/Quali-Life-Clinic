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

<?php if(Yii::app()->user->hasFlash('success')): ?>
	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('success'); ?>
	</div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('error')): ?>
	<div class="flash-error">
		<?php echo Yii::app()->user->getFlash('error'); ?>
	</div>
<?php endif; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'my-appointments-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'schedule_datetime',
			'header'=>'Date & Time',
			'value'=>'date("F j, Y - g:i A", strtotime($data->schedule_datetime))',
		),
		array(
			'header'=>'Doctor',
			'name'=>'doctor_account_id',
			'value'=>'$data->doctorAccount->user->firstname . " " . $data->doctorAccount->user->lastname',
		),
		array(
			'name'=>'appointment_status_id',
			'header'=>'Status',
			'value'=>'$data->appointmentStatus->status_name',
			'cssClassExpression'=>'$data->appointment_status_id == 5 ? "status-canceled" : ""', // Optional CSS class for styling
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {cancel}', // Show View and Cancel buttons
			'buttons'=>array(
				'view' => array(
					'label'=>'View Details',
					'url'=>'Yii::app()->createUrl("appointment/view", array("id"=>$data->id))',
				),
				'cancel' => array(
					'label'=>'Cancel Appointment',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png', // Ensure you have an icon or remove this line to use text
					'url'=>'Yii::app()->createUrl("appointment/cancel", array("id"=>$data->id))',
					'visible'=>'$data->appointment_status_id == 1', // Only show if 'Scheduled'
					'options'=>array(
						'confirm'=>'Are you sure you want to cancel this appointment?',
						'class'=>'delete', // Uses Yii's built-in red styling if available
					),
				),
			),
		),
	),
)); ?>