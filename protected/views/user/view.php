<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'account_id',
		'firstname',
		'middlename',
		'lastname',
		'qualifier',
		'dob',
		'specialization',
		'specialization_id',
		'ptr_number',
		'license_number',
		'license_expiration',
		's2_number',
		's2_expiration',
		'maxicare_number',
		'address',
		'name_of_father',
		'father_dob',
		'name_of_mother',
		'mother_dob',
		'school',
		'gender',
		'mother_contact_number',
		'father_contact_number',
	),
)); ?>
