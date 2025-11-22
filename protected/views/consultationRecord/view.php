<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */

$this->breadcrumbs=array(
	'Consultation Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ConsultationRecord', 'url'=>array('index')),
	array('label'=>'Create ConsultationRecord', 'url'=>array('create')),
	array('label'=>'Update ConsultationRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ConsultationRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConsultationRecord', 'url'=>array('admin')),
);
?>

<h1>View ConsultationRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_account_id',
		'doctor_account_id',
		'appointment_id',
		'subjective',
		'objective',
		'assessment',
		'plan',
		'notes',
		'date_of_consultation',
		'status_id',
	),
)); ?>
