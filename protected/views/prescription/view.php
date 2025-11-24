<?php
/* @var $this PrescriptionController */
/* @var $model Prescription */

// Set page title
$this->pageTitle = 'Digital Prescription - #' . $model->id;

// Breadcrumbs
$this->breadcrumbs = array(
    'Prescriptions' => array('index'),
    $model->id,
);

// Context Menu (Only show Management options for Doctors/Admins)
if (Yii::app()->user->isDoctor() || Yii::app()->user->isAdmin() || Yii::app()->user->isSuperAdmin()) {
    $this->menu = array(
        array('label' => 'List Prescription', 'url' => array('index')),
        array('label' => 'Create Prescription', 'url' => array('create')),
        array('label' => 'Update Prescription', 'url' => array('update', 'id' => $model->id)),
        //array('label' => 'Delete Prescription', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage Prescription', 'url' => array('admin')),
    );
}
?>

<div class="container-fluid">

    <div class="mb-4">
        <?php if (Yii::app()->user->isPatient()): ?>
            <a href="<?php echo $this->createUrl('prescription/myPrescriptions'); ?>" class="btn btn-secondary btn-icon-split btn-sm">
                <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                <span class="text">Back to My Prescriptions</span>
            </a>
        <?php else: ?>
            <a href="<?php echo $this->createUrl('prescription/index'); ?>" class="btn btn-secondary btn-icon-split btn-sm">
                <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                <span class="text">Back to List</span>
            </a>
        <?php endif; ?>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow mb-4 border-left-primary">
                
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f8f9fc;">
                    <div class="d-flex align-items-center">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" alt="Logo" style="height: 50px; width: 50px; margin-right: 15px;">
                        <div>
                            <h5 class="m-0 font-weight-bold text-primary">Quali-Life Health Center</h5>
                            <small class="text-muted">Digital Medical Prescription</small>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-weight-bold text-gray-800">RX #: <?php echo $model->id; ?></div>
                        <div class="text-xs text-gray-500"><?php echo date('F j, Y', strtotime($model->date_of_prescription)); ?></div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="row mb-4 pt-2 pb-4 border-bottom">
                        <div class="col-md-6 border-right">
                            <h6 class="text-uppercase text-secondary font-weight-bold mb-3 small">Patient Details</h6>
                            <div class="pl-2">
                                <h4 class="font-weight-bold text-gray-800 mb-1">
                                    <?php 
                                    if(isset($model->patientAccount->user)) {
                                        echo CHtml::encode($model->patientAccount->user->firstname . ' ' . $model->patientAccount->user->lastname);
                                    } else {
                                        echo "Unknown Patient";
                                    }
                                    ?>
                                </h4>
                                <p class="mb-0 text-gray-600">
                                    <i class="fas fa-id-card-alt mr-2"></i> 
                                    ID: <?php echo $model->patient_account_id; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 pl-md-4">
                            <h6 class="text-uppercase text-secondary font-weight-bold mb-3 small">Prescribing Doctor</h6>
                            <div class="pl-2">
                                <h4 class="font-weight-bold text-primary mb-1">
                                    <?php 
                                    if(isset($model->doctorAccount->user)) {
                                        echo "Dr. " . CHtml::encode($model->doctorAccount->user->firstname . ' ' . $model->doctorAccount->user->lastname);
                                    } else {
                                        echo "Unknown Doctor";
                                    }
                                    ?>
                                </h4>
                                <p class="mb-0 text-gray-600">
                                    <i class="fas fa-user-md mr-2"></i> 
                                    General Physician
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-2">
                        <i class="fas fa-prescription fa-3x text-secondary opacity-50" style="opacity: 0.2;"></i>
                    </div>

                    <div class="p-4 rounded mb-4" style="background-color: #fff; min-height: 200px; font-size: 1.1rem; line-height: 1.8;">
                        <?php 
                            // Convert newlines to breaks for proper display
                            echo nl2br(CHtml::encode($model->prescription)); 
                        ?>
                    </div>

                    <div class="row mt-5 pt-4">
                        <div class="col-md-8 text-muted small">
                            <p class="mb-1"><strong>Instructions:</strong> Please present this digital script to your pharmacy.</p>
                            <p class="mb-0">This document is electronically generated by the Quali-Life System and is valid without a physical signature.</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="border-bottom mb-2" style="border-bottom: 1px solid #000; width: 80%; margin: 0 auto;">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/signature_placeholder.png" onerror="this.style.display='none'" style="height: 40px; opacity: 0.6;">
                            </div>
                            <small class="font-weight-bold text-uppercase">Doctor's Signature</small>
                        </div>
                    </div>

                </div>

                <div class="card-footer text-center bg-light">
                    <a href="<?php echo $this->createUrl('prescription/print', array('id'=>$model->id)); ?>" target="_blank" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-print mr-2"></i> Print Prescription
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
        }
        .btn, .breadcrumb, .navbar, .sidebar, footer {
            display: none !important;
        }
    }
</style>