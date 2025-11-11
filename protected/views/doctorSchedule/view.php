<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

$this->breadcrumbs=array(
	'Doctor Schedules'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DoctorSchedule', 'url'=>array('index')),
	array('label'=>'Create DoctorSchedule', 'url'=>array('create')),
	array('label'=>'Update DoctorSchedule', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DoctorSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DoctorSchedule', 'url'=>array('admin')),
);
?>

<h1>View DoctorSchedule #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'doctor_account_id',
		'day_of_week',
		'start_time',
		'end_time',
		'status_id',
	),
)); ?>
