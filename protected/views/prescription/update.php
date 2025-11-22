<?php
/* @var $this PrescriptionController */
/* @var $model Prescription */

$this->breadcrumbs=array(
	'Prescriptions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Prescription', 'url'=>array('index')),
	array('label'=>'Create Prescription', 'url'=>array('create')),
	array('label'=>'View Prescription', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Prescription', 'url'=>array('admin')),
);
?>

<h1>Update Prescription <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>