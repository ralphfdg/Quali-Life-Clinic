<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
    'Accounts'=>array('admin', 'type'=>4), // Link back to patient admin list
    $model->username=>array('view','id'=>$model->id),
    'Patient Records',
);

// Menu structure matching your existing layout
$this->menu=array(
    array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Update Profile', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Manage Patients', 'url'=>array('admin', 'type'=>4)),
);

// Assuming getFullName() is available in the User model to show the full name
$patientName = $model->user ? $model->user->firstname . ' ' . $model->user->lastname : $model->username;
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Patient Records: <span class="text-primary"><?php echo CHtml::encode($patientName); ?></span>
    </h1>
    <div>
        <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to Profile', array('view', 'id' => $model->id), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
    </div>
</div>

<p class="lead text-gray-700">Select a specific record type to view or manage the patient's medical history.</p>

<div class="row">

    <div class="col-lg-4 mb-4">
        <div class="card shadow h-100 border-left-success text-center">
            <div class="card-body">
                <i class="fas fa-syringe fa-3x text-success mb-3"></i>
                <h5 class="card-title font-weight-bold text-success">Immunization Records</h5>
                <p class="card-text text-gray-600">View and manage all vaccination and immunization history.</p>
                <?php
                    // Links to the ImmunizationRecord controller, filtering by the patient's account_id
                    echo CHtml::link(
                        'Manage Records',
                        array('/immunizationRecord/admin', 'ImmunizationRecord[account_id]' => $model->id),
                        array('class' => 'btn btn-success mt-2')
                    );
                ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card shadow h-100 border-left-primary text-center">
            <div class="card-body">
                <i class="fas fa-baby fa-3x text-primary mb-3"></i>
                <h5 class="card-title font-weight-bold text-primary">Birth History</h5>
                <p class="card-text text-gray-600">Enter or view the patient's birth details (weight, length, delivery type).</p>
                <?php
                    // Assuming BirthHistory is a single record, link to view/create.
                    // For simplicity, link to the list/admin view, which can then link to view/create.
                    // You might adjust this to point directly to 'view' or 'create' depending on your controller logic.
                    echo CHtml::link(
                        'View/Add Record',
                        array('/birthHistory/admin', 'BirthHistory[account_id]' => $model->id),
                        array('class' => 'btn btn-primary mt-2')
                    );
                ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card shadow h-100 border-left-info text-center">
            <div class="card-body">
                <i class="fas fa-file-medical fa-3x text-info mb-3"></i>
                <h5 class="card-title font-weight-bold text-info">Consultation History</h5>
                <p class="card-text text-gray-600">Review past medical consultations, diagnosis, and prescriptions.</p>
                <?php
                    // Assuming ConsultationRecord is your general medical history.
                    echo CHtml::link(
                        'View Consultations',
                        array('/consultationRecord/admin', 'ConsultationRecord[account_id]' => $model->id),
                        array('class' => 'btn btn-info mt-2')
                    );
                ?>
            </div>
        </div>
    </div>

</div>