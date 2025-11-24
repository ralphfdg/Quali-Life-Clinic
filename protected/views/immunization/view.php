<?php
/* @var $this ImmunizationController */
/* @var $model Immunization */

$this->breadcrumbs = array(
	'Immunizations' => array('admin'), // Link to the list view
	$model->id,
);

// Helper function to get Status Label and Class
$statusLabel = ($model->status_id == 1) ? 'Active' : 'Inactive';
$statusClass = ($model->status_id == 1) ? 'badge-success' : 'badge-danger';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">
		View Vaccine: <span class="text-primary"><?php echo CHtml::encode($model->immunization); ?></span>
	</h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-edit"></i> Update', array('update', 'id' => $model->id), array('class' => 'btn btn-sm btn-warning shadow-sm')); ?>
		<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to List', array('patientRecord/view'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-primary">
		<h6 class="m-0 font-weight-bold text-primary">Vaccine Details</h6>
	</div>
	<div class="card-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			// Apply table styling consistent with your application design
			'htmlOptions' => array('class' => 'table table-bordered table-striped detail-view'),
			'attributes' => array(
				'id',
				'immunization',
				// Display description, preserving line breaks from the textarea input
				array(
					'name' => 'description',
					'type' => 'raw',
					'value' => nl2br(CHtml::encode($model->description)),
				),
				// Display Status with a colored badge
				array(
					'name' => 'status_id',
					'label' => 'Status',
					'type' => 'raw',
					'value' => '<span class="badge ' . $statusClass . '">' . $statusLabel . '</span>',
				),
			),
		)); ?>
	</div>
</div>