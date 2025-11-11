<?php
/* @var $this AuditLogController */
/* @var $model AuditLog */

$this->breadcrumbs=array(
	'Audit Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AuditLog', 'url'=>array('index')),
	array('label'=>'Create AuditLog', 'url'=>array('create')),
	array('label'=>'View AuditLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AuditLog', 'url'=>array('admin')),
);
?>

<h1>Update AuditLog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>