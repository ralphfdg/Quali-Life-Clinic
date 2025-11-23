<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs = array(
	'Accounts' => array('index'),
	$model->username,
);

// Badge Logic
$statusClass = ($model->status_id == 1) ? 'badge-success' : 'badge-danger';
$statusLabel = ($model->status_id == 1) ? 'Active' : 'Inactive';

// Type Logic & Back Button Logic
$typeLabel = 'User';
$backUrl = array('admin'); // Default fallback

if ($model->account_type_id == 3) {
	$typeLabel = 'Doctor';
	$backUrl = array('admin', 'type' => 3); // Go back to Doctor List
} elseif ($model->account_type_id == 4) {
	$typeLabel = 'Patient';
	$backUrl = array('admin', 'type' => 4); // Go back to Patient List
} elseif ($model->account_type_id == 2) {
	$typeLabel = 'Secretary';
	$backUrl = array('admin', 'type' => 2); // Go back to Secretary List
} elseif ($model->account_type_id == 1) {
	$typeLabel = 'Super Admin';
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">
		View Account: <span class="text-primary"><?php echo CHtml::encode($model->username); ?></span>
	</h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-edit"></i> Edit', array('update', 'id' => $model->id), array('class' => 'btn btn-sm btn-warning shadow-sm')); ?>
		<?php echo CHtml::link('<i class="fas fa-trash"></i> Delete', '#', array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?', 'class' => 'btn btn-sm btn-danger shadow-sm')); ?>

		<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back', $backUrl, array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
	</div>
</div>

<div class="row">

	<div class="col-lg-6 mb-4">
		<div class="card shadow h-100 border-left-primary">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Login Credentials</h6>
			</div>
			<div class="card-body">
				<table class="table table-hover">
					<tr>
						<th class="text-gray-600" width="35%">Username</th>
						<td class="font-weight-bold text-gray-900"><?php echo CHtml::encode($model->username); ?></td>
					</tr>
					<tr>
						<th class="text-gray-600">Email</th>
						<td><?php echo CHtml::encode($model->email_address); ?></td>
					</tr>
					<tr>
						<th class="text-gray-600">Account Type</th>
						<td><span class="badge badge-info p-2" style="font-size: 0.85rem;"><?php echo $typeLabel; ?></span></td>
					</tr>
					<tr>
						<th class="text-gray-600">Status</th>
						<td><span class="badge <?php echo $statusClass; ?> p-2" style="font-size: 0.85rem;"><?php echo $statusLabel; ?></span></td>
					</tr>
					<tr>
						<th class="text-gray-600">Date Created</th>
						<td class="small text-muted"><?php echo date('F j, Y - g:i A', strtotime($model->date_created)); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="col-lg-6 mb-4">
		<div class="card shadow h-100 border-left-success">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-success">Personal Profile</h6>
			</div>
			<div class="card-body">

				<?php if ($model->user): ?>
					<div class="text-center mb-4">
						<div class="h4 font-weight-bold text-gray-800">
							<?php echo CHtml::encode($model->user->firstname . ' ' . $model->user->middlename . ' ' . $model->user->lastname); ?>
						</div>
						<div class="text-muted small">
							<?php echo ($model->user->gender == 1 ? '<i class="fas fa-mars text-primary"></i> Male' : '<i class="fas fa-venus text-danger"></i> Female'); ?>
							&bull;
							Age: <?php echo date_diff(date_create($model->user->dob), date_create('today'))->y; ?>
						</div>
					</div>

					<hr>

					<div class="row mt-3">
						<div class="col-md-6 mb-3">
							<small class="text-uppercase text-gray-500 font-weight-bold">Contact Info</small>
							<div class="mt-1">
								<i class="fas fa-phone fa-fw text-gray-400 mr-2"></i>
								<?php echo CHtml::encode($model->user->mobile_number); ?>
							</div>
							<div class="mt-1">
								<i class="fas fa-map-marker-alt fa-fw text-gray-400 mr-2"></i>
								<?php echo CHtml::encode($model->user->address); ?>
							</div>
						</div>

						<?php if ($model->account_type_id == 3): ?>
							<div class="col-md-6 mb-3">
								<div class="bg-gray-100 p-3 rounded border-left-info">
									<h6 class="text-info font-weight-bold mb-2 small text-uppercase">Professional Info</h6>
									<ul class="list-unstyled small mb-0 text-gray-700">
										<li class="mb-1"><strong>Specialization:</strong>
											<?php
											if (isset($model->user->specializationInfo)) {
												echo CHtml::encode($model->user->specializationInfo->specialization_name);
											} else {
												echo !empty($model->user->specialization)
													? CHtml::encode($model->user->specialization)
													: '<span class="text-muted">General</span>';
											}
											?>
										</li>
										<li class="mb-1"><strong>License No:</strong> <?php echo CHtml::encode($model->user->license_number); ?></li>
										<li><strong>PTR No:</strong> <?php echo CHtml::encode($model->user->ptr_number); ?></li>
									</ul>
								</div>
							</div>
						<?php endif; ?>
					</div>

				<?php else: ?>
					<div class="alert alert-warning text-center">
						<i class="fas fa-exclamation-triangle fa-2x mb-2"></i><br>
						No User Profile found.<br>
						<?php echo CHtml::link('Add Profile Now', array('update', 'id' => $model->id), array('class' => 'btn btn-warning btn-sm mt-2')); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>

</div>