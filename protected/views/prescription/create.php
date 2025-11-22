<?php
/* @var $this PrescriptionController */
/* @var $model Prescription */

// --- Helper to get Patient Name for display ---
$patientName = "Unknown";
if (!empty($model->patient_account_id)) {
    $pAccount = Account::model()->with('user')->findByPk($model->patient_account_id);
    if ($pAccount && $pAccount->user) {
        $patientName = $pAccount->user->firstname . ' ' . $pAccount->user->lastname;
    }
}

$this->breadcrumbs=array(
    'My Queue'=>array('appointment/myQueue'),
    'Consultation'=>array('consultationRecord/view', 'id'=>$model->consultation_id),
    'Write Prescription',
);
?>

<div style="background-color: #fff; border: 1px solid #ddd; padding: 20px; border-radius: 8px; max-width: 800px; margin: 0 auto;">

    <h2 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px;">
        <i class="fas fa-prescription"></i> New Prescription
    </h2>

    <div style="background-color: #e9f7ef; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <strong>Patient:</strong> <?php echo CHtml::encode($patientName); ?><br>
        <strong>Date:</strong> <?php echo date('F j, Y'); ?>
    </div>

    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'prescription-form',
        'enableAjaxValidation'=>false,
    )); ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->hiddenField($model,'consultation_id'); ?>
        <?php echo $form->hiddenField($model,'patient_account_id'); ?>
        <?php echo $form->hiddenField($model,'doctor_account_id'); ?>
        <?php echo $form->hiddenField($model,'status_id', array('value'=>1)); ?>
        <?php echo $form->hiddenField($model,'date_of_prescription'); ?>

        <div class="row">
            <label style="font-size: 16px; font-weight: bold;">Rx / Medication Instructions <span class="required">*</span></label>
            <p class="hint" style="color: #666; font-size: 0.9em;">
                List the medication name, dosage, frequency, and duration.<br>
                <em>Example: Amoxicillin 500mg - Take 1 tablet every 8 hours for 7 days.</em>
            </p>
            <?php echo $form->textArea($model,'prescription',array(
                'rows'=>8, 
                'style'=>'width:100%; padding: 10px; font-family: monospace; font-size: 14px; border: 1px solid #ccc; border-radius: 4px;'
            )); ?>
            <?php echo $form->error($model,'prescription'); ?>
        </div>

        <div class="row buttons" style="margin-top: 20px; text-align: right;">
            <?php echo CHtml::submitButton('Save & Finish', array(
                'class'=>'btn btn-primary',
                'style'=>'padding: 10px 20px; background-color: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;'
            )); ?>
        </div>

    <?php $this->endWidget(); ?>
    </div></div>