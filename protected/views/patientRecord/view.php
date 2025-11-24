<?php
/* @var $this PatientRecordController */
/* @var $account Account */
/* @var $birthHistory BirthHistory */
/* @var $immunizationDataProvider CActiveDataProvider */
/* @var $consultationDataProvider CActiveDataProvider */
/* @var $immunizationTypesDataProvider CActiveDataProvider */

$patientName = $account->user ? $account->user->getFullName() : $account->username;
$patientID = $account->id;

$this->breadcrumbs = array(
    'Patients' => array('/account/admin', 'type' => 4),
    $patientName,
    'Records',
);

$this->menu = array(
    array('label' => 'Back to Profile', 'url' => array('/account/view', 'id' => $patientID)),
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Patient Records: <span class="text-primary"><?php echo CHtml::encode($patientName); ?></span>
    </h1>
    <div>
        <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to Profile', array('/account/view', 'id' => $patientID), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
    </div>
</div>

<div class="card shadow mb-4">

    <div class="card-header py-0 border-bottom-0">
        <ul class="nav nav-tabs card-header-tabs" id="recordsTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="birth-tab" data-toggle="tab" href="#birth" role="tab" aria-controls="birth" aria-selected="true">
                    <i class="fas fa-baby mr-1"></i> Birth History
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="immunization-tab" data-toggle="tab" href="#immunization" role="tab" aria-controls="immunization" aria-selected="false">
                    <i class="fas fa-syringe mr-1"></i> Immunizations (<?php echo $immunizationDataProvider->totalItemCount; ?>)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="consultation-tab" data-toggle="tab" href="#consultation" role="tab" aria-controls="consultation" aria-selected="false">
                    <i class="fas fa-notes-medical mr-1"></i> Consultations (<?php echo $consultationDataProvider->totalItemCount; ?>)
                </a>
            </li>
            <?php if (isset($immunizationTypesDataProvider)): ?>
                <li class="nav-item">
                    <a class="nav-link" id="vaccines-tab" data-toggle="tab" href="#vaccines" role="tab" aria-controls="vaccines" aria-selected="false">
                        <i class="fas fa-vial mr-1"></i> Vaccine Master List
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="recordsTabContent">

            <div class="tab-pane fade show active" id="birth" role="tabpanel" aria-labelledby="birth-tab">
                <?php $this->renderPartial('_birth_history', array('model' => $birthHistory, 'patientID' => $patientID)); ?>
            </div>

            <div class="tab-pane fade" id="immunization" role="tabpanel" aria-labelledby="immunization-tab">
                <?php $this->renderPartial('_immunization_records', array('dataProvider' => $immunizationDataProvider, 'patientID' => $patientID)); ?>
            </div>

            <div class="tab-pane fade" id="consultation" role="tabpanel" aria-labelledby="consultation-tab">
                <?php $this->renderPartial('_consultation_records', array('dataProvider' => $consultationDataProvider, 'patientID' => $patientID)); ?>
            </div>

            <?php if (isset($immunizationTypesDataProvider)): ?>
                <div class="tab-pane fade" id="vaccines" role="tabpanel" aria-labelledby="vaccines-tab">
                    <?php $this->renderPartial('_immunization_types', array('dataProvider' => $immunizationTypesDataProvider)); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>