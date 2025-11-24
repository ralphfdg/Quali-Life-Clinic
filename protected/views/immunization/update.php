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
		<?php
		// 1. Retrieve the Patient ID passed from the Patient Record view.
		$patientID = Yii::app()->request->getQuery('patient_id');

		// 2. Set the destination URL. If for some reason the ID is missing (which shouldn't happen 
		//    if links are correctly built), it will throw the standard 'Your request is invalid' error, 
		//    which is better than silently redirecting to an irrelevant admin page.
		$backUrl = array('patientRecord/view', 'id' => $patientID);
		$buttonText = '<i class="fas fa-arrow-left"></i> Back';

		echo CHtml::link($buttonText, $backUrl, array('class' => 'btn btn-sm btn-secondary shadow-sm'));
		?> </div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-warning">
		<h6 class="m-0 font-weight-bold text-warning">Edit Vaccine Details</h6>
	</div>
	<div class="card-body">
		<?php $this->renderPartial('_form', array('model' => $model)); ?>
	</div>
</div>