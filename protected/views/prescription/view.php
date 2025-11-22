<?php
/* @var $this PrescriptionController */
/* @var $model Prescription */

$this->breadcrumbs=array(
	'Prescriptions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Prescription', 'url'=>array('index')),
	array('label'=>'Create Prescription', 'url'=>array('create')),
	array('label'=>'Update Prescription', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Prescription', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Prescription', 'url'=>array('admin')),
);
?>

<h1>View Prescription #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_account_id',
		'doctor_account_id',
		'consultation_id',
		'prescription',
		'date_of_prescription',
		'status_id',
	),
)); ?>
