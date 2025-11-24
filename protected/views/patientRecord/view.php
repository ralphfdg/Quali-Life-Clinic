<?php
/* @var $this PatientRecordController */
/* @var $account Account */
/* @var $birthHistory BirthHistory */
/* @var $immunizationDataProvider CActiveDataProvider */
/* @var $consultationDataProvider CActiveDataProvider */
/* @var $immunizationTypesDataProvider CActiveDataProvider */ // Added var doc

$patientName = $account->user ? $account->user->getFullName() : $account->username; 
$patientID = $account->id;

$this->breadcrumbs=array(
    'Patients'=>array('/account/admin', 'type'=>4),
    $patientName,
    'Records',
);

$this->menu=array(
    array('label'=>'Back to Profile', 'url'=>array('/account/view', 'id'=>$patientID)),
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Patient Records: <span class="text-primary"><?php echo CHtml::encode($patientName); ?></span>
    </h1>
</div>

<?php 
// 1. Setup Tab Structure
$tabs = array();

// Birth History Tab
$birthHistoryContent = $this->renderPartial('_birth_history', array('model' => $birthHistory, 'patientID' => $patientID), true);
$tabs['birthHistory'] = array(
    'title' => 'Birth History',
    'content' => $birthHistoryContent,
    'active' => true,
);

// ... existing code ...

// 1. Immunization Records Tab (Patient's History)
// MUST use $immunizationDataProvider (from ImmunizationRecord model)
$immunizationContent = $this->renderPartial('_immunization_records', array(
    'dataProvider' => $immunizationDataProvider, 
    'patientID' => $patientID
), true);

$tabs['immunizationRecords'] = array(
    'title' => 'Immunizations (' . $immunizationDataProvider->totalItemCount . ')',
    'content' => $immunizationContent,
);

// 2. Immunization Types Tab (Manage Vaccine List)
// MUST use $immunizationTypesDataProvider (from Immunization model)
// If you use $immunizationDataProvider here by mistake, IT WILL CRASH with your error.
$immunizationTypesContent = $this->renderPartial('_immunization_types', array(
    'dataProvider' => $immunizationTypesDataProvider
), true);

$tabs['immunizationTypes'] = array(
    'title' => 'Immunization Types', 
    'content' => $immunizationTypesContent,
);

// ... rest of code ...
// --------------------------------------------------------


if (isset($immunizationTypesDataProvider)) {
    $immunizationTypesContent = $this->renderPartial('_immunization_types', array('dataProvider' => $immunizationTypesDataProvider), true);
    $tabs['immunizationTypes'] = array(
        'title' => 'Immunization Types', 
        'content' => $immunizationTypesContent,
    );
}

// Consultation Records Tab
$consultationContent = $this->renderPartial('_consultation_records', array('dataProvider' => $consultationDataProvider, 'patientID' => $patientID), true);
$tabs['consultationRecords'] = array(
    'title' => 'Consultations (' . $consultationDataProvider->totalItemCount . ')',
    'content' => $consultationContent,
);

// 2. Render Tabs
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => $tabs,
    'options' => array(
        'collapsible' => false,
    ),
    'htmlOptions' => array('class' => 'shadow mb-4'),
));
?>