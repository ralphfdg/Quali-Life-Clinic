<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

$this->breadcrumbs = array(
	'Schedules'=>array('admin'),
	'Create',
);

// Determine Role Flags and Title
$isDoctor = Yii::app()->user->isDoctor();
$isManager = Yii::app()->user->isAdmin() || Yii::app()->user->isSuperAdmin();

$title = $isDoctor
	? 'Create New Slot for Dr. ' . Yii::app()->user->getState('displayName')
	: 'Create New Schedule Slot';

// FIX: Determine the correct redirect URL based on role
$backUrl = $isDoctor ? array('mySchedule') : array('admin');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <?php echo $title; ?>
    </h1>
    <div>
        <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to List', $backUrl, array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
    </div>
</div>

<?php 
// Render the form view
$this->renderPartial('_form', array('model' => $model)); 
?>