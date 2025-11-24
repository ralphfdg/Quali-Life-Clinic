<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */
/* @var $appointment Appointment */ // Passed from controller
/* @var $prescriptionModel Prescription */ // Passed from controller

$this->breadcrumbs=array(
    'Queue'=>array('appointment/myQueue'),
    'Consultation',
);

// Get names for header display (must use safe checks for rendering)
$patientName = (isset($appointment) && isset($appointment->patientAccount->user)) 
    ? $appointment->patientAccount->user->firstname . ' ' . $appointment->patientAccount->user->lastname 
    : 'New Record';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        SOAP Note: <span class="text-primary"><?php echo CHtml::encode($patientName); ?></span>
    </h1>
    <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to Queue', array('appointment/myQueue'), array('class'=>'btn btn-sm btn-secondary shadow-sm')); ?>
</div>

<?php 
// REMOVED Gii menu array as we use header buttons

// CRITICAL FIX: Pass all three models required by the form partial
$this->renderPartial('_form', array(
    'model'=>$model, 
    'appointment'=>$appointment, // Needed for header info
    'prescriptionModel'=>$prescriptionModel, // Needed for prescription fields
)); 
?>