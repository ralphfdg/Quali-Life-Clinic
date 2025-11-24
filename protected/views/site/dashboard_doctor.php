<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */
/* @var $myTotal integer */
/* @var $myWaiting integer */

$this->pageTitle = Yii::app()->name . ' - Doctor Dashboard';
$today = date('F j, Y');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">My Dashboard <small class="text-muted h6 ml-2"><?php echo $today; ?></small></h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-history fa-sm text-white-50 mr-1"></i> View My History', array('appointment/myHistory'), array('class' => 'btn btn-sm btn-info shadow-sm')); ?>
	</div>
</div>

<div class="row">
	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">My Appointments (Today)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $myTotal; ?></div>
					</div>
					<div class="col-auto"><i class="fas fa-calendar-check fa-2x text-gray-300"></i></div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Patients Waiting</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $myWaiting; ?></div>
					</div>
					<div class="col-auto"><i class="fas fa-user-clock fa-2x text-gray-300"></i></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-success">
		<h6 class="m-0 font-weight-bold text-success">My Patient Queue</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'doctor-queue-grid',
				'dataProvider' => $dataProvider,
				'itemsCssClass' => 'table table-hover',
				'summaryText' => '',
				'emptyText' => '<div class="text-center p-4 text-muted">No patients in your queue today.</div>',
				'columns' => array(

					// Time (Styled)
					array(
						'header' => 'Time',
						'value' => 'date("g:i A", strtotime($data->schedule_datetime))',
						'htmlOptions' => array('style' => 'font-weight:bold; width:10%; color:#4e73df;'),
					),

					// Patient Info (Name + Gender + Age)
					array(
						'header' => 'Patient Name',
						'type' => 'raw',
						'value' => function ($data) {
							$user = isset($data->patientAccount->user) ? $data->patientAccount->user : null;
							if (!$user) return "Unknown";

							$name = $user->firstname . ' ' . $user->lastname;
							$gender = ($user->gender == 1) ? 'Male' : 'Female';
							$age = date_diff(date_create($user->dob), date_create('today'))->y;

							return '<div class="font-weight-bold">' . $name . '</div>'
								. '<div class="small text-muted">' . $gender . ', ' . $age . ' yrs old</div>';
						},
						'htmlOptions' => array('width' => '30%'),
					),

					// Current Status (Badges)
					array(
						'header' => 'Status',
						'type' => 'raw',
						'value' => function ($data) {
							$s = $data->appointment_status_id;
							if ($s == 1) return '<span class="badge badge-primary">Scheduled</span>';
							if ($s == 2) return '<span class="badge badge-success">Arrived / Waiting</span>';
							if ($s == 3) return '<span class="badge badge-warning">In Consultation</span>';
							if ($s == 4) return '<span class="badge badge-dark">Completed</span>';
							if ($s == 5) return '<span class="badge badge-danger">Canceled</span>';
							return '<span class="badge badge-secondary">Unknown</span>';
						},
						'htmlOptions' => array('style' => 'text-align:center; width:15%;'),
					),

					// ACTION: START CONSULTATION
					array(
						'header' => 'Action',
						'type' => 'raw',
						'value' => function ($data) {
							$isConsulting = $data->appointment_status_id == 3;
							$isArrived = $data->appointment_status_id == 2;
							$isDone = $data->appointment_status_id >= 4;

							if ($isArrived || $isConsulting) {
								// This link calls actionUpdateStatus -> sets status to 3 -> Controller redirects to SOAP Form
								$buttonClass = $isConsulting ? 'btn-primary' : 'btn-success';
								$buttonText = $isConsulting ? 'Continue SOAP' : 'Start Consultation';

								return CHtml::link(
									'<i class="fas fa-stethoscope mr-1"></i> ' . $buttonText,
									array('appointment/updateStatus', 'id' => $data->id, 'status' => 3),
									array('class' => 'btn btn-sm ' . $buttonClass . ' shadow-sm font-weight-bold btn-block')
								);
							}
							// If completed or not arrived
							if ($isDone) {
								return '<button class="btn btn-sm btn-light btn-block text-muted" disabled><i class="fas fa-check"></i> Done</button>';
							}
							if ($data->appointment_status_id == 1) {
								return '<button class="btn btn-sm btn-secondary btn-block" disabled>Not Arrived</button>';
							}
							return '-';
						},
						'htmlOptions' => array('style' => 'text-align:center; width:25%;'),
					),
				),
			)); ?>
		</div>
	</div>
</div>

<script>
	// This assumes SiteController::actionIndex calls renderDoctorDashboard
	// If not, this script needs to be placed directly in myQueue.php
	setTimeout(function() {
		window.location.reload(1);
	}, 60000);
</script>