<?php
/* @var $this ImmunizationController */
/* @var $model Immunization */

$this->breadcrumbs = array(
	'Immunizations' => array('admin'),
	$model->id => array('view', 'id' => $model->id),
	'Update',
);

$this->menu = array(
	array('label' => 'View Immunization', 'url' => array('view', 'id' => $model->id)),
	array('label' => 'Manage Immunization', 'url' => array('admin')),
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Update Immunization Type: <span class="text-warning"><?php echo CHtml::encode($model->immunization); ?></span></h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-eye"></i> View Details', array('view', 'id' => $model->id), array('class' => 'btn btn-sm btn-info shadow-sm')); ?>
		<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to List', array('patientRecord/view'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-warning">
		<h6 class="m-0 font-weight-bold text-warning">Edit Vaccine Details</h6>
	</div>
	<div class="card-body">
		<?php $this->renderPartial('_form', array('model' => $model)); ?>
	</div>
</div>