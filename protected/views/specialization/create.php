<?php
/* @var $this SpecializationController */
/* @var $model Specialization */

$this->breadcrumbs=array(
	'Specializations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Specialization', 'url'=>array('index')),
	array('label'=>'Manage Specialization', 'url'=>array('admin')),
);
?>

<h1>Create Specialization</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>