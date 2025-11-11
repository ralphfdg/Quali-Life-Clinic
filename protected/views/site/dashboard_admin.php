<?php
/* @var $this SiteController */
/* @var $patientQueue CActiveDataProvider */
/* @var $totalAppointmentsToday integer */
/* @var $patientsWaiting integer */

$this->pageTitle=Yii::app()->name . ' - Admin Dashboard';
?>

<h1>Admin Dashboard (Patient Queue)</h1>

<hr>
<h3>Quick Stats (Today)</h3>

<div style="display: flex; justify-content: space-around;">
	<div style="text-align: center; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
		<h2><?php echo $totalAppointmentsToday; ?></h2>
		<p>Total Appointments Today</p>
	</div>
	<div style="text-align: center; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
		<h2><?php echo $patientsWaiting; ?></h2>
		<p>Patients Waiting</p>
	</div>
</div>

<hr>
<h3>Today's Patient Queue</h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'patient-queue-grid',
	'dataProvider'=>$patientQueue,
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
			'name'=>'doctorAccount.user.firstname',
			'header'=>'Doctor',
			'value'=>'"Dr. " . $data->doctorAccount->user->lastname',
		),
		array(
			'name'=>'appointmentStatus.status_name',
			'header'=>'Status',
			// We will add logic here later to make this updatable (e.g., a dropdown)
			// For now, it's view-only
			'value'=>'$data->appointmentStatus->status_name',
		),
		// We can add a CButtonColumn here later to "Check-in" a patient
		// which would update the status.
	),
)); ?>