<?php
/* @var $this BirthHistoryController */
/* @var $model BirthHistory */

// Fetch patient account details for display
$patientAccount = Account::model()->with('user')->findByPk($model->account_id);
$patientName = $patientAccount->user ? $patientAccount->user->getFullName() : $patientAccount->username;

$this->breadcrumbs=array(
    'Patients'=>array('/account/admin', 'type'=>4),
    $patientAccount->username=>array('/account/view','id'=>$model->account_id),
    'Records'=>array('/patientRecord/view','id'=>$model->account_id),
    'Update Birth History',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update Birth History: <span class="text-warning"><?php echo CHtml::encode($patientName); ?></span></h1>
    <div>
        <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to Records', array('/patientRecord/view', 'id'=>$model->account_id), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
        <h6 class="m-0 font-weight-bold text-warning">Edit Birth History Record #<?php echo $model->id; ?></h6>
    </div>
    <div class="card-body">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>