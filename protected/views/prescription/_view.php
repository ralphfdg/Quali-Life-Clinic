<?php
/* @var $this PrescriptionController */
/* @var $model Prescription */

$this->breadcrumbs=array(
    'Prescriptions'=>array('index'),
    'View #'.$model->id,
);

// Helper to get Doctor and Patient names safely
$docName = "Unknown Doctor";
if(isset($model->doctorAccount->user)) {
    $docName = $model->doctorAccount->user->firstname . ' ' . $model->doctorAccount->user->lastname;
}

$patName = "Unknown Patient";
if(isset($model->patientAccount->user)) {
    $patName = $model->patientAccount->user->firstname . ' ' . $model->patientAccount->user->lastname;
}
?>

<div style="max-width: 700px; margin: 0 auto; background: #fff; border: 2px solid #333; padding: 40px; box-shadow: 5px 5px 15px rgba(0,0,0,0.1);">
    
    <div style="text-align: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px;">
        <h1 style="margin: 0; color: #333; text-transform: uppercase; letter-spacing: 2px;">Quali-Life Clinic</h1>
        <p style="margin: 5px 0; color: #666;">Medical Prescription</p>
    </div>

    <table style="width: 100%; margin-bottom: 30px;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <strong>Prescribed To:</strong><br>
                <span style="font-size: 1.2em;"><?php echo CHtml::encode($patName); ?></span>
            </td>
            <td style="width: 50%; vertical-align: top; text-align: right;">
                <strong>Date:</strong><br>
                <span><?php echo date('F j, Y', strtotime($model->date_of_prescription)); ?></span><br><br>
                <strong>Prescribed By:</strong><br>
                <span>Dr. <?php echo CHtml::encode($docName); ?></span>
            </td>
        </tr>
    </table>

    <div style="background-color: #f9f9f9; border: 1px dashed #ccc; padding: 20px; min-height: 200px;">
        <h2 style="color: #333; font-family: 'Times New Roman', serif; font-style: italic; font-size: 48px; margin: 0 0 10px 0;">Rx</h2>
        <div style="font-size: 16px; line-height: 1.8; font-family: monospace; white-space: pre-wrap;"><?php echo CHtml::encode($model->prescription); ?></div>
    </div>

    <div style="margin-top: 40px; text-align: center; font-size: 0.8em; color: #999;">
        <p>This is a computer-generated prescription from the Quali-Life System.</p>
        <p>Consultation ID: #<?php echo $model->consultation_id; ?> | Prescription ID: #<?php echo $model->id; ?></p>
    </div>
    
    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #333; color: #fff; border: none; border-radius: 4px;">
            <i class="fas fa-print"></i> Print Prescription
        </button>
    </div>

</div>

<style>
    @media print {
        .no-print { display: none; }
        body { background-color: #fff; }
    }
</style>