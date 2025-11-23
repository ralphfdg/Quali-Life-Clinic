<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs = array(
	'Accounts' => array('index'),
	$model->username,
);

// Status Logic
$statusClass = ($model->status_id == 1) ? 'badge-success' : 'badge-danger';
$statusLabel = ($model->status_id == 1) ? 'Active' : 'Inactive';

// Type Logic & Back URL
$typeLabel = 'User';
$backUrl = array('admin');

if ($model->account_type_id == 3) {
	$typeLabel = 'Doctor';
	$backUrl = array('admin', 'type' => 3);
} elseif ($model->account_type_id == 4) {
	$typeLabel = 'Patient';
	$backUrl = array('admin', 'type' => 4);
} elseif ($model->account_type_id == 2) {
	$typeLabel = 'Secretary';
	$backUrl = array('admin', 'type' => 2);
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
			<div class="card-header py-3">
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
						<td><span class="badge badge-info p-2"><?php echo $typeLabel; ?></span></td>
					</tr>
					<tr>
						<th class="text-gray-600">Status</th>
						<td><span class="badge <?php echo $statusClass; ?> p-2"><?php echo $statusLabel; ?></span></td>
					</tr>
					<tr>
						<th class="text-gray-600">Created</th>
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
							<?php
							// Combine Name with Qualifier (e.g. Jr.)
							$fullName = $model->user->firstname . ' ' . $model->user->middlename . ' ' . $model->user->lastname;
							if (!empty($model->user->qualifier)) {
								$fullName .= ' ' . $model->user->qualifier;
							}
							echo CHtml::encode($fullName);
							?>
						</div>
						<div class="text-muted small">
							<?php echo ($model->user->gender == 1 ? '<i class="fas fa-mars text-primary"></i> Male' : '<i class="fas fa-venus text-danger"></i> Female'); ?>
							&bull;
							Age: <?php echo date_diff(date_create($model->user->dob), date_create('today'))->y; ?>
						</div>
					</div>

					<hr>

					<div class="row mt-3">
						<div class="col-md-12 mb-3">
							<div class="d-flex align-items-start mb-2">
								<i class="fas fa-phone fa-fw text-gray-400 mr-3 mt-1"></i>
								<div>
									<div class="small text-gray-500 font-weight-bold text-uppercase">Mobile</div>
									<?php echo CHtml::encode($model->user->mobile_number); ?>
								</div>
							</div>
							<div class="d-flex align-items-start">
								<i class="fas fa-map-marker-alt fa-fw text-gray-400 mr-3 mt-1"></i>
								<div>
									<div class="small text-gray-500 font-weight-bold text-uppercase">Address</div>
									<?php echo CHtml::encode($model->user->address); ?>
								</div>
							</div>
						</div>
					</div>

					<?php if ($model->account_type_id == 3): ?>
						<div class="bg-gray-100 p-3 rounded border-left-info mt-3">
							<h6 class="text-info font-weight-bold mb-2 small text-uppercase">Professional Info</h6>
							<ul class="list-unstyled small mb-0 text-gray-700">

								<li class="mb-2"><strong>Specialization:</strong>
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

								<li class="mb-1">
									<strong>License No:</strong> <?php echo CHtml::encode($model->user->license_number); ?>
								</li>

								<li class="mb-2 text-muted">
									<em>Expires: <?php echo !empty($model->user->license_expiration) ? date('M j, Y', strtotime($model->user->license_expiration)) : '-'; ?></em>
								</li>

								<li class="mb-1">
									<strong>PTR No:</strong> <?php echo CHtml::encode($model->user->ptr_number); ?>
								</li>

								<li>
									<strong>S2 No:</strong> <?php echo !empty($model->user->s2_number) ? CHtml::encode($model->user->s2_number) : '<span class="text-muted">-</span>'; ?>
								</li>

							</ul>
						</div>
					<?php endif; ?>
					<?php if ($model->account_type_id == 4): ?>
						<div class="bg-light-yellow p-3 rounded border-left-warning mt-3" style="background-color: #fffbe6;">
							<h6 class="text-warning font-weight-bold mb-2 small text-uppercase">Patient Details</h6>
							<div class="row small text-gray-700">
								<div class="col-6 mb-2">
									<strong>School:</strong><br>
									<?php echo !empty($model->user->school) ? CHtml::encode($model->user->school) : '-'; ?>
								</div>
								<div class="col-6 mb-2">
									<strong>HMO No:</strong><br>
									<?php echo !empty($model->user->maxicare_number) ? CHtml::encode($model->user->maxicare_number) : '-'; ?>
								</div>

								<div class="col-12">
									<hr class="my-2">
								</div>

								<div class="col-6">
									<strong>Father:</strong><br>
									<?php echo CHtml::encode($model->user->name_of_father); ?><br>
									<span class="text-muted"><?php echo CHtml::encode($model->user->father_contact_number); ?></span>
								</div>
								<div class="col-6">
									<strong>Mother:</strong><br>
									<?php echo CHtml::encode($model->user->name_of_mother); ?><br>
									<span class="text-muted"><?php echo CHtml::encode($model->user->mother_contact_number); ?></span>
								</div>
							</div>
						</div>
					<?php endif; ?>

				<?php else: ?>
					<div class="alert alert-warning text-center">
						No User Profile found.<br>
						<?php echo CHtml::link('Add Profile Now', array('update', 'id' => $model->id), array('class' => 'btn btn-warning btn-sm mt-2')); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>

</div>