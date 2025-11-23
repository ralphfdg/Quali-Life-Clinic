<?php
/* @var $this SiteController */
$this->pageTitle = 'My Health Dashboard';
?>

<div class="text-center mb-5">
	<h1 class="h3 text-gray-800">Welcome back, <?php echo Yii::app()->user->getState('displayName'); ?>!</h1>
</div>

<div class="row justify-content-center">
	<div class="col-lg-6">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Next Upcoming Appointment</h6>
			</div>
			<div class="card-body text-center">
				<?php if ($nextAppt): ?>
					<div style="font-size: 4rem; color: #4e73df;">
						<i class="fas fa-calendar-day"></i>
					</div>
					<h3 class="mt-3"><?php echo date('F j, Y', strtotime($nextAppt->schedule_datetime)); ?></h3>
					<h4 class="text-gray-600"><?php echo date('g:i A', strtotime($nextAppt->schedule_datetime)); ?></h4>
					<hr>
					<p class="mb-0">
						With <strong>Dr. <?php echo CHtml::encode($nextAppt->doctorAccount->user->lastname); ?></strong>
					</p>
				<?php else: ?>
					<div class="py-5">
						<p class="text-gray-500 mb-4">You have no upcoming appointments.</p>
						<a href="<?php echo $this->createUrl('appointment/book'); ?>" class="btn btn-primary btn-lg">
							Book Now
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Quick Links</h6>
			</div>
			<div class="list-group list-group-flush">
				<a href="<?php echo $this->createUrl('appointment/book'); ?>" class="list-group-item list-group-item-action">
					<i class="fas fa-plus-circle mr-2"></i> Book New Appointment
				</a>
				<a href="<?php echo $this->createUrl('appointment/myAppointments'); ?>" class="list-group-item list-group-item-action">
					<i class="fas fa-list mr-2"></i> View History
				</a>
				<a href="<?php echo $this->createUrl('prescription/myPrescriptions'); ?>" class="list-group-item list-group-item-action">
					<i class="fas fa-pills mr-2"></i> My Prescriptions
				</a>
			</div>
		</div>
	</div>
</div>