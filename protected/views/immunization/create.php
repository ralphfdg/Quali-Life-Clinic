<?php
/* @var $this ImmunizationController */
/* @var $model Immunization */

$this->breadcrumbs=array(
	'Immunizations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Immunization', 'url'=>array('index')),
	array('label'=>'Manage Immunization', 'url'=>array('admin')),
);
?>

<h1>Create Immunization</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>