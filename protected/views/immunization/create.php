<?php
/* @var $this ImmunizationController */
/* @var $model Immunization */

$this->breadcrumbs = array(
	'Immunizations' => array('admin'),
	'Create',
);

$this->menu = array(
	array('label' => 'Manage Immunization', 'url' => array('admin')),
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Create New Immunization Type</h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to List', array('admin'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-primary">
		<h6 class="m-0 font-weight-bold text-primary">New Vaccine Entry Form</h6>
	</div>
	<div class="card-body">
		<?php $this->renderPartial('_form', array('model' => $model)); ?>
	</div>
</div>