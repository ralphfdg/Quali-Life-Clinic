<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

$this->breadcrumbs=array(
	'Doctor Schedules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DoctorSchedule', 'url'=>array('index')),
	array('label'=>'Create DoctorSchedule', 'url'=>array('create')),
	array('label'=>'View DoctorSchedule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DoctorSchedule', 'url'=>array('admin')),
);
?>

<h1>Update DoctorSchedule <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>