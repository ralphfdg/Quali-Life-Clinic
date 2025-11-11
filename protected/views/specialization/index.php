<?php
/* @var $this SpecializationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Specializations',
);

$this->menu=array(
	array('label'=>'Create Specialization', 'url'=>array('create')),
	array('label'=>'Manage Specialization', 'url'=>array('admin')),
);
?>

<h1>Specializations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
