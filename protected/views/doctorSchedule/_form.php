<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */
/* @var $form CActiveForm */

// 1. Prepare Doctor List
$doctors = Account::model()->with('user')->findAll('account_type_id=3 AND status_id=1');
$doctorList = array();
foreach ($doctors as $doc) {
    $name = isset($doc->user) ? $doc->user->lastname . ', ' . $doc->user->firstname : $doc->username;
    $doctorList[$doc->id] = "Dr. " . $name;
}

// 2. Prepare Days (Keep as is)
$days = array(1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 0 => 'Sunday');

// 3. TIME SLOTS (Keep as is)
$timeSlots = array();
$start = strtotime('08:00'); 
$end = strtotime('17:00'); 
while ($start <= $end) {
    $dbValue = date('H:i:s', $start);
    $display = date('g:i A', $start);
    $timeSlots[$dbValue] = $display;
    $start = strtotime('+30 minutes', $start);
}

// Helper flags
$isDoctor = Yii::app()->user->isDoctor();
$isManager = Yii::app()->user->isSuperAdmin() || Yii::app()->user->isAdmin();
?>

<div class="container-fluid">
    <div class="card shadow mb-4" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $model->isNewRecord ? 'Add Schedule Slot' : 'Edit Schedule Slot'; ?></h6>
        </div>
        <div class="card-body">
            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'doctor-schedule-form', 'enableAjaxValidation' => false)); ?>
            <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger small')); ?>

            <div class="row">
                
                <?php if ($isManager): // SHOW DROPDOWN FOR MANAGERS ?>
                <div class="col-md-6 form-group">
                    <label class="required">Select Doctor <span class="required">*</span></label>
                    <?php echo $form->dropDownList($model, 'doctor_account_id', $doctorList, array('empty' => '-- Choose Doctor --', 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'doctor_account_id'); ?>
                </div>
                <?php endif; ?>

                <?php if ($isDoctor): // SHOW READ-ONLY FIELD FOR DOCTORS ?>
                <div class="col-md-6 form-group">
                    <label>Doctor</label>
                    <input type="text" class="form-control" readonly 
                           value="<?php echo Yii::app()->user->getState('displayName'); ?>" 
                           style="background-color: #f8f9fc;">
                    </div>
                <?php endif; ?>
                
                <div class="col-md-6 form-group">
                    <?php echo $form->labelEx($model, 'day_of_week'); ?>
                    <?php echo $form->dropDownList($model, 'day_of_week', $days, array('empty' => '-- Choose Day --', 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'day_of_week'); ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="required">Start Time <span class="required">*</span></label>
                    <?php echo $form->dropDownList($model, 'start_time', $timeSlots, array('empty' => '-- Select Start --', 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'start_time'); ?>
                </div>
                <div class="col-md-6 form-group">
                    <label class="required">End Time <span class="required">*</span></label>
                    <?php echo $form->dropDownList($model, 'end_time', $timeSlots, array('empty' => '-- Select End --', 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'end_time'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'status_id'); ?>
                <?php echo $form->dropDownList($model, 'status_id', array(1 => 'Active', 2 => 'Inactive'), array('class' => 'form-control')); ?>
            </div>
            <div class="form-group mt-4 text-right">
                <?php echo CHtml::link('Cancel', array('mySchedule'), array('class' => 'btn btn-secondary mr-2')); ?>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Schedule' : 'Save Changes', array('class' => 'btn btn-primary px-4')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>