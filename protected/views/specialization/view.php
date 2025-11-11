<?php
/* @var $this SpecializationController */
/* @var $model Specialization */

$this->breadcrumbs=array(
	'Specializations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Specialization', 'url'=>array('index')),
	array('label'=>'Create Specialization', 'url'=>array('create')),
	array('label'=>'Update Specialization', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Specialization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Specialization', 'url'=>array('admin')),
);
?>

<h1>View Specialization #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'specialization_name',
		'status_id',
	),
)); ?>
