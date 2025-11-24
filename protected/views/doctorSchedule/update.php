<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

// 1. Get readable data for the title
$doctorName = isset($model->doctorAccount->user) ? "Dr. " . $model->doctorAccount->user->lastname : 'Unknown Doctor';
$dayName = $model->getDayName(); // Uses the helper in DoctorSchedule.php

$this->breadcrumbs = array(
	'Schedules' => array('admin'),
	$dayName => array('view', 'id' => $model->id),
	'Update',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">
		Update Schedule for <span class="text-primary"><?php echo CHtml::encode($doctorName); ?></span>
		on <span class="text-info"><?php echo CHtml::encode($dayName); ?></span>
	</h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to List', array('mySchedule'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
	</div>
</div>

<?php
// Render the form view
$this->renderPartial('_form', array('model' => $model));
?>