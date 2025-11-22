<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */
/* @var $form CActiveForm */

// --- HELPER: Get Patient Name for Display ---
$patientNameDisplay = "";
$isQueueBooking = !empty($model->appointment_id); // Check if this came from the Queue

if ($isQueueBooking && !empty($model->patient_account_id)) {
    $pAccount = Account::model()->with('user')->findByPk($model->patient_account_id);
    if ($pAccount && $pAccount->user) {
        $patientNameDisplay = $pAccount->user->firstname . " " . $pAccount->user->lastname;
    }
}
// --------------------------------------------
?>

<div class="form" style="background: #f8f9fa; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'consultation-record-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model, 'doctor_account_id'); ?>
    <?php echo $form->hiddenField($model, 'appointment_id'); ?>
    <?php echo $form->hiddenField($model, 'status_id', array('value'=>1)); ?>

    <div class="row" style="margin-bottom: 20px; padding: 10px; background: #e9ecef; border-radius: 5px;">
        <div style="width: 100%;">
            <label><strong>Patient Name:</strong></label>
            <?php 
            if ($isQueueBooking) {
                // If linked to appointment: Show Read-Only Name + Hidden ID
                echo CHtml::textField('dummy_name', $patientNameDisplay, array('readonly'=>true, 'style'=>'width:300px; font-weight:bold; background:#fff;'));
                echo $form->hiddenField($model, 'patient_account_id'); 
            } else {
                // Fallback: If created manually via Admin menu, show dropdown
                echo $form->dropDownList($model, 'patient_account_id', 
                    CHtml::listData(Account::model()->with('user')->findAll('account_type_id=4'), 'id', 'user.lastname'),
                    array('empty'=>'Select Patient')
                );
            }
            ?>
        </div>
        <div style="margin-top: 10px;">
            <?php echo $form->labelEx($model,'date_of_consultation'); ?>
            <?php echo $form->dateField($model,'date_of_consultation'); ?>
            <?php echo $form->error($model,'date_of_consultation'); ?>
        </div>
    </div>

    <hr>
    <h3>SOAP Notes</h3>

    <div class="row">
        <?php echo $form->labelEx($model,'subjective'); ?>
        <span style="font-size: 0.9em; color: #666;">(What the patient says / Complaints)</span><br>
        <?php echo $form->textArea($model,'subjective',array('rows'=>4, 'style'=>'width:100%; box-sizing:border-box;')); ?>
        <?php echo $form->error($model,'subjective'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'objective'); ?>
        <span style="font-size: 0.9em; color: #666;">(Vital signs, Physical Exam findings)</span><br>
        <?php echo $form->textArea($model,'objective',array('rows'=>4, 'style'=>'width:100%; box-sizing:border-box;')); ?>
        <?php echo $form->error($model,'objective'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'assessment'); ?>
        <span style="font-size: 0.9em; color: #666;">(Diagnosis)</span><br>
        <?php echo $form->textArea($model,'assessment',array('rows'=>4, 'style'=>'width:100%; box-sizing:border-box;')); ?>
        <?php echo $form->error($model,'assessment'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'plan'); ?>
        <span style="font-size: 0.9em; color: #666;">(Treatment, Prescriptions, Lab requests)</span><br>
        <?php echo $form->textArea($model,'plan',array('rows'=>4, 'style'=>'width:100%; box-sizing:border-box;')); ?>
        <?php echo $form->error($model,'plan'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'notes'); ?>
        <?php echo $form->textArea($model,'notes',array('rows'=>2, 'style'=>'width:100%; box-sizing:border-box;')); ?>
        <?php echo $form->error($model,'notes'); ?>
    </div>

    <div class="row buttons" style="margin-top: 20px;">
        <?php 
        // Standard Save Button (Green)
        echo CHtml::submitButton($model->isNewRecord ? 'Save & Finish' : 'Save Changes', array(
            'class' => 'btn btn-success',
            'style' => 'padding: 10px 20px; margin-right: 10px; background: #28a745; color: white; border: none;'
        )); 
        ?>

        <?php 
        // Save & Prescribe Button (Blue) - Only for new records
        if ($model->isNewRecord) {
            echo CHtml::submitButton('Save & Write Prescription', array(
                'name'  => 'save_and_prescribe', // This name tells the Controller what to do
                'class' => 'btn btn-primary',
                'style' => 'padding: 10px 20px; background: #007bff; color: white; border: none;'
            ));
        }
        ?>
    </div>

<?php $this->endWidget(); ?>

</div>
