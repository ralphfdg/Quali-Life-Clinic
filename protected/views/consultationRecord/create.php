<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */

$this->breadcrumbs=array(
	'Consultation Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ConsultationRecord', 'url'=>array('index')),
	array('label'=>'Manage ConsultationRecord', 'url'=>array('admin')),
);
?>

<h1>Create ConsultationRecord</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>