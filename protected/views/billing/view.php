<?php
/* @var $this BillingController */
/* @var $model Billing */

$this->breadcrumbs=array(
	'Billings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Billing', 'url'=>array('index')),
	array('label'=>'Create Billing', 'url'=>array('create')),
	array('label'=>'Update Billing', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Billing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Billing', 'url'=>array('admin')),
);
?>

<h1>View Billing #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'appointment_id',
		'patient_account_id',
		'amount',
		'payment_status',
		'date_created',
		'date_paid',
		'created_by_account_id',
		'notes',
	),
)); ?>
