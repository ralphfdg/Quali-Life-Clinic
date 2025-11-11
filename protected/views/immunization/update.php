<?php
/* @var $this ImmunizationController */
/* @var $model Immunization */

$this->breadcrumbs=array(
	'Immunizations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Immunization', 'url'=>array('index')),
	array('label'=>'Create Immunization', 'url'=>array('create')),
	array('label'=>'View Immunization', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Immunization', 'url'=>array('admin')),
);
?>

<h1>Update Immunization <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>