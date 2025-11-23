<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */
// CHANGE: Page Title
$this->pageTitle = 'Secretary Dashboard';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Secretary Dashboard (Patient Queue)</h1>
	<a href="<?php echo $this->createUrl('appointment/calendar'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		<i class="fas fa-calendar fa-sm text-white-50"></i> Full Calendar
	</a>
</div>

<div class="row">
	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Appointments (Today)</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countTotal; ?></div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Patients Arrived (Waiting)</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countWaiting; ?></div>
			</div>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Today's Appointments</h6>
	</div>
	<div class="card-body">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'admin-queue-grid',
			'dataProvider' => $dataProvider,
			'itemsCssClass' => 'table table-bordered',
			'columns' => array(
				array(
					'header' => 'Time',
					'value' => 'date("g:i A", strtotime($data->schedule_datetime))',
				),
				array(
					'header' => 'Patient',
					'value' => '$data->patientAccount->user->firstname . " " . $data->patientAccount->user->lastname',
				),
				array(
					'header' => 'Doctor',
					'value' => '"Dr. " . $data->doctorAccount->user->lastname',
				),
				array(
					'header' => 'Status',
					'value' => '$data->appointmentStatus->status_name',
				),
				// Action Button: Mark Arrived
				array(
					'header' => 'Actions',
					'type' => 'raw',
					'value' => function ($data) {
						if ($data->appointment_status_id == 1) { // Scheduled
							return CHtml::link("Mark Arrived", array("appointment/updateStatus", "id" => $data->id, "status" => 2), array("class" => "btn btn-sm btn-success"));
						}
						return "";
					},
				),
			),
		)); ?>
	</div>
</div>