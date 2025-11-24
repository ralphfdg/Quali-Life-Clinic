<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */
/* @var $prescription Prescription */ // Assuming this variable is passed by the controller

$this->breadcrumbs = array(
	'History' => array('appointment/myHistory'),
	'View SOAP',
);

// Determine Status Label
$statusLabel = $model->status_id == 1 ? 'Finalized' : 'Draft';
$statusClass = $model->status_id == 1 ? 'badge-success' : 'badge-warning';

// Assuming loadModel in Controller eager loads doctorAccount.user and patientAccount.user
$patientName = isset($model->patientAccount->user)
	? $model->patientAccount->user->firstname . ' ' . $model->patientAccount->user->lastname
	: 'Unknown Patient';

$doctorName = isset($model->doctorAccount->user)
	? 'Dr. ' . $model->doctorAccount->user->lastname
	: 'Unknown Doctor';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">
		Consultation Record: <span class="text-primary"><?php echo CHtml::encode($patientName); ?></span>
	</h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to History', array('appointment/myHistory'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
	</div>
</div>

<div class="row">

	<div class="col-lg-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3 border-left-primary">
				<h6 class="m-0 font-weight-bold text-primary">
					SOAP Note
					<span class="badge <?php echo $statusClass; ?> ml-2"><?php echo $statusLabel; ?></span>
				</h6>
			</div>
			<div class="card-body">

				<p class="small text-muted mb-0">Consultation Date: <?php echo date('F j, Y', strtotime($model->date_of_consultation)); ?> by <?php echo $doctorName; ?></p>
				<hr>

				<h6 class="font-weight-bold text-success">S - Subjective</h6>
				<div class="alert alert-light p-3 border mb-3"><?php echo nl2br(CHtml::encode($model->subjective)); ?></div>

				<h6 class="font-weight-bold text-info">O - Objective</h6>
				<div class="alert alert-light p-3 border mb-3"><?php echo nl2br(CHtml::encode($model->objective)); ?></div>

				<h6 class="font-weight-bold text-warning">A - Assessment (Diagnosis)</h6>
				<div class="alert alert-light p-3 border mb-3"><?php echo nl2br(CHtml::encode($model->assessment)); ?></div>

				<h6 class="font-weight-bold text-danger">P - Plan</h6>
				<div class="alert alert-light p-3 border"><?php echo nl2br(CHtml::encode($model->plan)); ?></div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">

		<?php if (isset($prescription) && $prescription): ?>
			<div class="card shadow mb-4 border-left-info">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-info"><i class="fas fa-prescription"></i> Prescription</h6>
				</div>
				<div class="card-body">
					<p class="small text-muted">Date: <?php echo date('M j, Y', strtotime($prescription->date_of_prescription)); ?></p>
					<hr>
					<div class="alert alert-info p-3">
						<?php echo nl2br(CHtml::encode($prescription->prescription)); ?>
					</div>
					<?php
					echo CHtml::link('<i class="fas fa-paper-plane"></i> Send to Patient Email', '#', array('class' => 'btn btn-sm btn-outline-info btn-block'));
					?>
				</div>
			</div>
		<?php endif; ?>

		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-secondary">Record Metadata</h6>
			</div>
			<div class="card-body small text-muted">
				<?php
				// Safely retrieve doctor details
				$dUser = isset($model->doctorAccount->user) ? $model->doctorAccount->user : null;
				$pUser = isset($model->patientAccount) ? $model->patientAccount : null;
				?>

				<p class="mb-1"><strong>Record ID:</strong> <?php echo $model->id; ?></p>
				<p class="mb-1"><strong>Appointment ID:</strong> <?php echo $model->appointment_id; ?></p>

				<hr class="my-2">

				<p class="mb-1">
					<strong>Doctor:</strong>
					<?php echo $dUser ? "Dr. " . $dUser->lastname . " (" . $pUser->username . ")" : "ID: " . $model->doctor_account_id; ?>
				</p>
				<p class="mb-1">
					<strong>Patient Account:</strong>
					<?php echo $pUser ? $pUser->username : "ID: " . $model->patient_account_id; ?>
				</p>
			</div>
		</div>

	</div>

</div>