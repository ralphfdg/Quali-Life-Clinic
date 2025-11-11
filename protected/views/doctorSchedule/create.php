<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

$this->breadcrumbs=array(
	'Doctor Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DoctorSchedule', 'url'=>array('index')),
	array('label'=>'Manage DoctorSchedule', 'url'=>array('admin')),
);
?>

<h1>Create DoctorSchedule</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>