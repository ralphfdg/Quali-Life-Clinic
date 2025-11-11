<?php
/* @var $this SiteController */
/* @var $myPatientQueue CActiveDataProvider */
/* @var $totalAppointmentsToday integer */
/* @var $patientsWaiting integer */

$this->pageTitle=Yii::app()->name . ' - Doctor Dashboard';
?>

<h1>My Patient Queue</h1>

<hr>
<h3>My Quick Stats (Today)</h3>

<div style="display: flex; justify-content: space-around;">
	<div style="text-align: center; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
		<h2><?php echo $totalAppointmentsToday; ?></h2>
		<p>My Appointments Today</p>
	</div>
	<div style="text-align: center; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
		<h2><?php echo $patientsWaiting; ?></h2>
		<p>My Patients Waiting</p>
	</div>
</div>

<hr>
<h3>My Patient List</h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'my-patient-queue-grid',
	'dataProvider'=>$myPatientQueue,
	'columns'=>array(
		array(
			'name'=>'schedule_datetime',
			'header'=>'Time',
			'value'=>'date("g:i A", strtotime($data->schedule_datetime))',
		),
		array(
			'name'=>'patientAccount.user.firstname',
			'header'=>'Patient Name',
			'value'=>'$data->patientAccount->user->firstname . " " . $data->patientAccount->user->lastname',
		),
		array(
			'name'=>'appointmentStatus.status_name',
			'header'=>'Status',
			'value'=>'$data->appointmentStatus->status_name',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {start} {complete}', // Custom buttons
			'buttons'=>array(
				'view' => array(
					'label'=>'View Patient Record',
					'url'=>'Yii::app()->createUrl("user/view", array("id"=>$data->patientAccount->user->id))', // Links to patient profile
				),
				'start' => array(
					'label'=>'Start Consultation',
					'url'=>'Yii::app()->createUrl("appointment/updateStatus", array("id"=>$data->id, "status"=>3))', // 3 = In Consultation
					'visible'=>'$data->appointment_status_id == 2', // Only show if status is 'Arrived' (2)
					'options' => array('class' => 'start-consult'),
				),
				'complete' => array(
					'label'=>'Complete Consultation',
					'url'=>'Yii::app()->createUrl("appointment/updateStatus", array("id"=>$data->id, "status"=>4))', // 4 = Completed
					'visible'=>'$data->appointment_status_id == 3', // Only show if 'In Consultation' (3)
					'options' => array('class' => 'complete-consult'),
				),
			),
		),
	),
)); ?>