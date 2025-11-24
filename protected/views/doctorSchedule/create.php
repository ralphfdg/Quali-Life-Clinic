<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

$this->breadcrumbs = array(
	'Schedules' => array('admin'),
	'Create',
);

// Determine Title based on Role
$isDoctor = Yii::app()->user->isDoctor();
$title = $isDoctor
	? 'Create New Slot for Dr. ' . Yii::app()->user->getState('displayName')
	: 'Create New Schedule Slot';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">
		<?php echo $title; ?>
	</h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to List', array('mySchedule'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
	</div>
</div>

<?php
// Render the form view
$this->renderPartial('_form', array('model' => $model));
?>