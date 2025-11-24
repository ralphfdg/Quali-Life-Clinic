<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */
/* @var $appointment Appointment */ // Passed from controller
/* @var $prescriptionModel Prescription */ // Passed from controller
/* @var $form CActiveForm */

// Fetch patient info for header display
$patient = isset($appointment->patientAccount->user) ? $appointment->patientAccount->user : null;
$patientName = $patient ? $patient->firstname . ' ' . $patient->lastname : 'N/A';
$age = $patient ? date_diff(date_create($patient->dob), date_create('today'))->y : '--';
?>

<div class="card-body">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'consultation-record-form',
        'enableAjaxValidation' => false,
    )); ?>

    <?php echo $form->errorSummary(array($model, $prescriptionModel), null, null, array('class' => 'alert alert-danger small')); ?>

    <?php if ($appointment): ?>
        <?php echo $form->hiddenField($model, 'appointment_id'); ?>
        <?php echo $form->hiddenField($model, 'patient_account_id'); ?>
        <?php echo $form->hiddenField($model, 'doctor_account_id'); ?>
        <?php echo $form->hiddenField($model, 'date_of_consultation'); ?>
    <?php endif; ?>

    <div class="alert alert-light p-3 border mb-4">
        <i class="fas fa-user-injured mr-2 text-success"></i>
        <strong>Patient:</strong> <?php echo CHtml::encode($patientName); ?>
        <span class="ml-4"><strong>Age:</strong> <?php echo $age; ?></span>
        <?php if ($appointment): ?>
            <span class="ml-4"><strong>Appointment:</strong> #<?php echo $appointment->id; ?></span>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h6 class="font-weight-bold text-success mb-1">S - Subjective</h6>
                <span class="text-muted small d-block mb-2">(Patient's reported symptoms/history)</span>
                <?php echo $form->textArea($model, 'subjective', array('rows' => 8, 'class' => 'form-control', 'placeholder' => 'Chief complaint, symptoms, severity...')); ?>
                <?php echo $form->error($model, 'subjective'); ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <h6 class="font-weight-bold text-info mb-1">O - Objective</h6>
                <span class="text-muted small d-block mb-2">(Vitals, physical exam findings, test results)</span>
                <?php echo $form->textArea($model, 'objective', array('rows' => 8, 'class' => 'form-control', 'placeholder' => 'BP, Temp, Weight, Observations...')); ?>
                <?php echo $form->error($model, 'objective'); ?>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h6 class="font-weight-bold text-warning mb-1">A - Assessment</h6>
                <span class="text-muted small d-block mb-2">(Diagnosis/Differential diagnosis)</span>
                <?php echo $form->textArea($model, 'assessment', array('rows' => 4, 'class' => 'form-control', 'placeholder' => 'Primary diagnosis (e.g., Common Cold, Sprain)...')); ?>
                <?php echo $form->error($model, 'assessment'); ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <h6 class="font-weight-bold text-danger mb-1">P - Plan</h6>
                <span class="text-muted small d-block mb-2">(Treatment, follow-up, patient education)</span>
                <?php echo $form->textArea($model, 'plan', array('rows' => 4, 'class' => 'form-control', 'placeholder' => 'Treatment steps, referral, follow-up date...')); ?>
                <?php echo $form->error($model, 'plan'); ?>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <h6 class="font-weight-bold text-info mb-3"><i class="fas fa-prescription-bottle-alt mr-1"></i> Prescription (Optional)</h6>

    <div class="form-group">
        <?php echo $form->labelEx($prescriptionModel, 'prescription'); ?>
        <span class="text-muted small d-block mb-2">(Drug name, dosage, frequency)</span>
        <?php echo $form->textArea($prescriptionModel, 'prescription', array('rows' => 4, 'class' => 'form-control', 'placeholder' => 'e.g. Paracetamol 500mg, Take 1 tablet every 6 hours as needed.')); ?>
        <?php echo $form->error($prescriptionModel, 'prescription'); ?>
    </div>

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'notes'); ?>
        <?php echo $form->textArea($model, 'notes', array('rows' => 2, 'class' => 'form-control')); ?>
    </div>

    <div class="row buttons mt-4">
        <div class="col-12 text-right">
            <?php echo CHtml::link('Cancel', array('appointment/myQueue'), array('class' => 'btn btn-secondary mr-2')); ?>

            <?php echo CHtml::submitButton('Finish Consultation & Save', array(
                'name' => 'save_and_complete', // Name required for Controller logic
                'class' => 'btn btn-success px-4',
            )); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>