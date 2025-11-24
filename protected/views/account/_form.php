<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $user User */
/* @var $form CActiveForm */

$typeId = isset($_GET['type']) ? (int)$_GET['type'] : $model->account_type_id;
$typeName = 'Account';
if ($typeId == 3) $typeName = 'Doctor';
if ($typeId == 4) $typeName = 'Patient';
if ($typeId == 2) $typeName = 'Secretary';

$model->account_type_id = $typeId;
?>

<div class="container-fluid">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'account-form',
        'enableAjaxValidation' => false,
    )); ?>

    <?php echo $form->errorSummary(array($model, $user)); ?>

    <div class="row">

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Login Credentials</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Account Type</label>
                        <input type="text" class="form-control" value="<?php echo $typeName; ?>" readonly style="background-color: #eaecf4;">
                        <?php echo $form->hiddenField($model, 'account_type_id'); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'username'); ?>
                        <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'e.g. pat_juan')); ?>
                        <?php echo $form->error($model, 'username'); ?>
                    </div>

                    <?php 
                    // FIX: Show password field ONLY if:
                    // 1. It is a New Record (creating account)
                    // OR
                    // 2. The logged-in user is editing their OWN account (ID matches).
                    if ($model->isNewRecord || (Yii::app()->user->id == $model->id)): 
                    ?>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'password'); ?>
                            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
                            <?php if (!$model->isNewRecord): ?><small class="text-muted"></small><?php endif; ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>
                        
                        <?php 
                        // Optional: You can also show the retype field here if you want consistency,
                        // but your current Model validation rules only check retype on 'insert' (create).
                        ?>
                    <?php endif; ?>

                    <?php if ($model->isNewRecord): ?>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'retypepassword'); ?>
                            <?php echo $form->passwordField($model, 'retypepassword', array('class' => 'form-control')); ?>
                            <?php echo $form->error($model, 'retypepassword'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'email_address'); ?>
                        <?php echo $form->textField($model, 'email_address', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'email_address'); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'status_id'); ?>
                        <?php echo $form->dropDownList($model, 'status_id', array(1 => 'Active', 2 => 'Inactive'), array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Personal Information</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <?php echo $form->labelEx($user, 'firstname'); ?>
                            <?php echo $form->textField($user, 'firstname', array('class' => 'form-control')); ?>
                            <?php echo $form->error($user, 'firstname'); ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <?php echo $form->labelEx($user, 'lastname'); ?>
                            <?php echo $form->textField($user, 'lastname', array('class' => 'form-control')); ?>
                            <?php echo $form->error($user, 'lastname'); ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <?php echo $form->labelEx($user, 'middlename'); ?>
                            <?php echo $form->textField($user, 'middlename', array('class' => 'form-control')); ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <?php echo $form->labelEx($user, 'qualifier'); ?>
                            <?php echo $form->textField($user, 'qualifier', array('class' => 'form-control', 'placeholder' => 'Jr/Sr')); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <?php echo $form->labelEx($user, 'dob'); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $user,
                                'attribute' => 'dob',
                                'options' => array('dateFormat' => 'yy-mm-dd', 'changeYear' => true, 'yearRange' => '1920:2025'),
                                'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'YYYY-MM-DD'),
                            ));
                            ?>
                            <?php echo $form->error($user, 'dob'); ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <?php echo $form->labelEx($user, 'gender'); ?>
                            <?php echo $form->dropDownList($user, 'gender', array(1 => 'Male', 2 => 'Female'), array('class' => 'form-control')); ?>
                            <?php echo $form->error($user, 'gender'); ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <?php echo $form->labelEx($user, 'mobile_number'); ?>
                            <?php echo $form->textField($user, 'mobile_number', array('class' => 'form-control', 'maxlength' => 11)); ?>
                            <?php echo $form->error($user, 'mobile_number'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($user, 'address'); ?>
                        <?php echo $form->textArea($user, 'address', array('class' => 'form-control', 'rows' => 2)); ?>
                        <?php echo $form->error($user, 'address'); ?>
                    </div>

                    <hr>

                    <?php if ($typeId == 3): ?>
                        <div class="doctor-fields p-3 mb-3" style="background-color: #f8f9fc; border-left: 4px solid #4e73df; border-radius: 4px;">
                            <h6 class="text-primary font-weight-bold mb-3">Professional Credentials</h6>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="required">Specialization <span class="required">*</span></label>
                                    <?php
                                    $specs = CHtml::listData(Specialization::model()->findAll(), 'id', 'specialization_name');
                                    echo $form->dropDownList($user, 'specialization_id', $specs, array('empty' => 'Select Specialization', 'class' => 'form-control'));
                                    ?>
                                    <?php echo $form->error($user, 'specialization_id'); ?>
                                </div>
                                <div class="col-md-6 form-group">
                                    <?php echo $form->labelEx($user, 'license_number'); ?>
                                    <?php echo $form->textField($user, 'license_number', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($user, 'license_number'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <?php echo $form->labelEx($user, 'ptr_number'); ?>
                                    <?php echo $form->textField($user, 'ptr_number', array('class' => 'form-control')); ?>
                                </div>
                                <div class="col-md-6 form-group">
                                    <?php echo $form->labelEx($user, 'license_expiration'); ?>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $user,
                                        'attribute' => 'license_expiration',
                                        'options' => array('dateFormat' => 'yy-mm-dd', 'changeYear' => true, 'yearRange' => '2024:2035'),
                                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'YYYY-MM-DD'),
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($typeId == 4): ?>
                        <div class="patient-fields p-3 mb-3" style="background-color: #fff3cd; border-left: 4px solid #f6c23e; border-radius: 4px;">
                            <h6 class="text-warning font-weight-bold mb-3">Detailed Patient Info</h6>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <?php echo $form->labelEx($user, 'school'); ?>
                                    <?php echo $form->textField($user, 'school', array('class' => 'form-control', 'placeholder' => 'School Name')); ?>
                                </div>
                                <div class="col-md-6 form-group">
                                    <?php echo $form->labelEx($user, 'maxicare_number'); ?>
                                    <?php echo $form->textField($user, 'maxicare_number', array('class' => 'form-control', 'placeholder' => 'HMO Number')); ?>
                                </div>
                            </div>

                            <hr style="border-top: 1px dashed #f6c23e;">

                            <h6 class="small font-weight-bold text-gray-600">Father's Details</h6>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <?php echo $form->labelEx($user, 'name_of_father'); ?>
                                    <?php echo $form->textField($user, 'name_of_father', array('class' => 'form-control')); ?>
                                </div>
                                <div class="col-md-4 form-group">
                                    <?php echo $form->labelEx($user, 'father_contact_number'); ?>
                                    <?php echo $form->textField($user, 'father_contact_number', array('class' => 'form-control', 'maxlength' => 11)); ?>
                                </div>
                                <div class="col-md-4 form-group">
                                    <?php echo $form->labelEx($user, 'father_dob'); ?>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $user,
                                        'attribute' => 'father_dob',
                                        'options' => array('dateFormat' => 'yy-mm-dd', 'changeYear' => true, 'yearRange' => '1950:2025'),
                                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'YYYY-MM-DD'),
                                    ));
                                    ?>
                                </div>
                            </div>

                            <h6 class="small font-weight-bold text-gray-600">Mother's Details</h6>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <?php echo $form->labelEx($user, 'name_of_mother'); ?>
                                    <?php echo $form->textField($user, 'name_of_mother', array('class' => 'form-control')); ?>
                                </div>
                                <div class="col-md-4 form-group">
                                    <?php echo $form->labelEx($user, 'mother_contact_number'); ?>
                                    <?php echo $form->textField($user, 'mother_contact_number', array('class' => 'form-control', 'maxlength' => 11)); ?>
                                </div>
                                <div class="col-md-4 form-group">
                                    <?php echo $form->labelEx($user, 'mother_dob'); ?>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $user,
                                        'attribute' => 'mother_dob',
                                        'options' => array('dateFormat' => 'yy-mm-dd', 'changeYear' => true, 'yearRange' => '1950:2025'),
                                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'YYYY-MM-DD'),
                                    ));
                                    ?>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>

                    <div class="form-group mt-4 text-right">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Account' : 'Save Changes', array('class' => 'btn btn-success btn-lg icon-split')); ?>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php $this->endWidget(); ?>

</div>