<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */

$this->breadcrumbs=array(
	'Consultation Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConsultationRecord', 'url'=>array('index')),
	array('label'=>'Create ConsultationRecord', 'url'=>array('create')),
	array('label'=>'View ConsultationRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ConsultationRecord', 'url'=>array('admin')),
);
?>

<h1>Update ConsultationRecord <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>