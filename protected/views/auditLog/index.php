<?php
/* @var $this AuditLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Audit Logs',
);

$this->menu=array(
	array('label'=>'Create AuditLog', 'url'=>array('create')),
	array('label'=>'Manage AuditLog', 'url'=>array('admin')),
);
?>

<h1>Audit Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
