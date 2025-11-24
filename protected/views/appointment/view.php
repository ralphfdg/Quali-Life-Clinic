<?php
/* @var $this AppointmentController */
/* @var $model Appointment */

$this->breadcrumbs = array(
	'Appointments' => array('index'),
	'#' . $model->id,
);

// 1. Resolve Status Color & Label
$statusClass = 'badge-secondary';
$statusLabel = isset($model->appointmentStatus) ? $model->appointmentStatus->status_name : 'Unknown';

if ($model->appointment_status_id == 1) $statusClass = 'badge-primary';   // Scheduled
if ($model->appointment_status_id == 2) $statusClass = 'badge-success';   // Arrived
if ($model->appointment_status_id == 3) $statusClass = 'badge-warning';   // In Consultation
if ($model->appointment_status_id == 4) $statusClass = 'badge-dark';      // Completed
if ($model->appointment_status_id == 5) $statusClass = 'badge-danger';    // Canceled

// 2. Resolve Names (Safe Handling)
$patientName = isset($model->patientAccount->user)
	? $model->patientAccount->user->firstname . ' ' . $model->patientAccount->user->lastname
	: 'Unknown (ID: ' . $model->patient_account_id . ')';

$doctorName = isset($model->doctorAccount->user)
	? 'Dr. ' . $model->doctorAccount->user->lastname
	: 'Unknown (ID: ' . $model->doctor_account_id . ')';

// 3. Smart Back Button Logic
$backUrl = array('appointment/calendar'); // Default for Admin
$backLabel = 'Back';

if (Yii::app()->controller->isDoctor()) {
	$backUrl = array('myQueue');
	$backLabel = 'Back to Queue';
} elseif (Yii::app()->controller->isPatient()) {
	$backUrl = array('myAppointments');
	$backLabel = 'Back to My Apps';
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">
		Appointment <span class="text-primary">#<?php echo $model->id; ?></span>
	</h1>
	<div>
		<?php
		// Only Admins/Secretaries can edit details
		if (Yii::app()->controller->isAdmin() || Yii::app()->controller->isSuperAdmin()): ?>
			<?php echo CHtml::link('<i class="fas fa-edit"></i> Edit', array('update', 'id' => $model->id), array('class' => 'btn btn-sm btn-warning shadow-sm')); ?>
		<?php endif; ?>

		<?php if ($model->appointment_status_id == 1): ?>
			<?php echo CHtml::link('<i class="fas fa-times"></i> Cancel', array('cancel', 'id' => $model->id), array('class' => 'btn btn-sm btn-danger shadow-sm', 'confirm' => 'Are you sure you want to cancel this appointment?')); ?>
		<?php endif; ?>

		<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> ' . $backLabel, $backUrl, array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
	</div>
</div>

<div class="row">

	<div class="col-lg-6 mb-4">
		<div class="card shadow h-100 border-left-primary">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Appointment Details</h6>
			</div>
			<div class="card-body">
				<table class="table table-borderless">
					<tr>
						<th class="text-gray-600" width="35%">Date</th>
						<td class="font-weight-bold text-gray-900" style="font-size: 1.1rem;">
							<?php echo date('F j, Y', strtotime($model->schedule_datetime)); ?>
						</td>
					</tr>
					<tr>
						<th class="text-gray-600">Time</th>
						<td class="font-weight-bold text-primary" style="font-size: 1.1rem;">
							<?php echo date('g:i A', strtotime($model->schedule_datetime)); ?>
						</td>
					</tr>
					<tr>
						<th class="text-gray-600">Status</th>
						<td>
							<span class="badge <?php echo $statusClass; ?> p-2"><?php echo $statusLabel; ?></span>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr>
						</td>
					</tr>
					<tr>
						<th class="text-gray-600">Patient</th>
						<td>
							<div class="font-weight-bold"><?php echo CHtml::encode($patientName); ?></div>
							<?php if (isset($model->patientAccount->user)): ?>
								<div class="small text-muted">
									<i class="fas fa-phone fa-xs"></i> <?php echo CHtml::encode($model->patientAccount->user->mobile_number); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<th class="text-gray-600">Doctor</th>
						<td class="font-weight-bold text-info"><?php echo CHtml::encode($doctorName); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="col-lg-6 mb-4">
		<div class="card shadow h-100 border-left-info">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-info">Notes & History</h6>
			</div>
			<div class="card-body">

				<div class="mb-4">
					<div class="small text-uppercase text-gray-500 font-weight-bold mb-1">Notes</div>
					<div class="p-3 bg-gray-100 rounded border">
						<?php echo !empty($model->notes) ? CHtml::encode($model->notes) : '<em class="text-muted">No notes provided.</em>'; ?>
					</div>
				</div>

				<?php if ($model->appointment_status_id == 5): ?>
					<div class="mb-4">
						<div class="small text-uppercase text-danger font-weight-bold mb-1">Cancellation Reason</div>
						<div class="p-3 bg-danger text-white rounded">
							<?php echo CHtml::encode($model->cancellation_reason); ?>
						</div>
					</div>
				<?php endif; ?>

				<hr>

				<div class="row small text-muted">
					<div class="col-6">
						<strong>Date Booked:</strong><br>
						<?php echo date('M j, Y h:i A', strtotime($model->date_booked)); ?>
					</div>
					<div class="col-6">
						<strong>Reminders:</strong><br>
						<?php if ($model->sms_reminder_sent): ?>
							<span class="text-success"><i class="fas fa-check-circle"></i> SMS Sent</span>
						<?php else: ?>
							<span><i class="fas fa-clock"></i> Pending</span>
						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</div>

</div>