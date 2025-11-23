<?php
/* @var $this SiteController */
$this->pageTitle = 'Doctor Dashboard';
?>

<h1 class="h3 mb-4 text-gray-800">My Dashboard</h1>

<div class="row">
	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="text-xs font-weight-bold text-info text-uppercase mb-1">My Appointments (Today)</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $myTotal; ?></div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Waiting Room</div>
				<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $myWaiting; ?></div>
			</div>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">My Patient Queue</h6>
	</div>
	<div class="card-body">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider' => $dataProvider,
			'itemsCssClass' => 'table table-bordered table-striped',
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
					'header' => 'Status',
					'name' => 'appointmentStatus.status_name',
				),
				// Quick Actions Link
				array(
					'header' => 'Action',
					'type' => 'raw',
					'value' => function ($data) {
						if ($data->appointment_status_id == 2) { // Arrived
							return CHtml::link("Start Consult", array("appointment/updateStatus", "id" => $data->id, "status" => 3), array("class" => "btn btn-sm btn-warning"));
						}
						if ($data->appointment_status_id == 3) { // In Consult
							return CHtml::link("Continue", array("consultationRecord/create", "appointment_id" => $data->id), array("class" => "btn btn-sm btn-primary"));
						}
						return "";
					}
				),
			),
		)); ?>
	</div>
</div>