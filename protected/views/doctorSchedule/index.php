<?php
/* @var $this DoctorScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctor Schedules',
);

$this->menu=array(
	array('label'=>'Create DoctorSchedule', 'url'=>array('create')),
	array('label'=>'Manage DoctorSchedule', 'url'=>array('admin')),
);
?>

<h1>Doctor Schedules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
