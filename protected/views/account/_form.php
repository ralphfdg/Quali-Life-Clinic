<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $userModel User */ // IMPORTANT: Assuming controller passes this model
/* @var $form CActiveForm */

// --- IMPORTANT SETUP ---
// Ensure the secondary model is instantiated if not provided (e.g., during initial form load)
if (!isset($userModel)) {
    $userModel = new User;
}

// Check if we are specifically creating a Doctor (assuming 'type' parameter is 3, matching your SuperAdmin code)
$isDoctor = (isset($_GET['type']) && $_GET['type'] == 3);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'account-form',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('class'=>'form-horizontal'),
            )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary(array($model, $userModel), null, null, array('class' => 'alert alert-danger')); ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Account Credentials</h6>
                </div>
                <div class="card-body">
                    
                    <div class="form-group row">
                        <?php echo $form->labelEx($model,'username', array('class'=>'col-sm-3 col-form-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'username'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo $form->labelEx($model,'email_address', array('class'=>'col-sm-3 col-form-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'email_address',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'email_address'); ?>
                        </div>
                    </div>

                    <?php if ($model->isNewRecord): ?>
                        <div class="form-group row">
                            <?php echo $form->labelEx($model,'password', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
                                <?php echo $form->error($model,'password'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <?php echo CHtml::label('Repeat Password', 'password_repeat', array('class'=>'col-sm-3 col-form-label required')); ?>
                            <div class="col-sm-9">
                                <?php echo CHtml::passwordField('password_repeat', '', array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div> <?php if ($isDoctor): ?>
            
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Doctor Profile Information</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'firstname', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php echo $form->textField($userModel,'firstname',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
                                <?php echo $form->error($userModel,'firstname'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'lastname', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php echo $form->textField($userModel,'lastname',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
                                <?php echo $form->error($userModel,'lastname'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'dob', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php 
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model' => $userModel,
                                    'attribute' => 'dob',
                                    'options' => array(
                                        'dateFormat' => 'yy-mm-dd', 
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '1950:'.date('Y'), // Set a reasonable year range
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'form-control',
                                    ),
                                )); ?>
                                <?php echo $form->error($userModel,'dob'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'gender', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php echo $form->dropDownList($userModel, 'gender', array(
                                    1 => 'Male', 
                                    2 => 'Female'
                                ), array('class' => 'form-control', 'prompt' => 'Select Gender')); ?>
                                <?php echo $form->error($userModel,'gender'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'specialization_id', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php 
                                // Assuming Specialization model is available and has 'id' and 'name' fields
                                $specializations = CHtml::listData(Specialization::model()->findAll(), 'id', 'name'); 
                                echo $form->dropDownList($userModel, 'specialization_id', 
                                    $specializations, 
                                    array('class' => 'form-control', 'prompt' => 'Select Specialization')
                                ); ?>
                                <?php echo $form->error($userModel,'specialization_id'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'ptr_number', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php echo $form->textField($userModel,'ptr_number',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
                                <?php echo $form->error($userModel,'ptr_number'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'license_number', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php echo $form->textField($userModel,'license_number',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
                                <?php echo $form->error($userModel,'license_number'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'license_expiration', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php 
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model' => $userModel,
                                    'attribute' => 'license_expiration',
                                    'options' => array(
                                        'dateFormat' => 'yy-mm-dd',
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '2025:2040',
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'form-control',
                                    ),
                                )); ?>
                                <?php echo $form->error($userModel,'license_expiration'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'s2_number', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php echo $form->textField($userModel,'s2_number',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
                                <?php echo $form->error($userModel,'s2_number'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?php echo $form->labelEx($userModel,'s2_expiration', array('class'=>'col-sm-3 col-form-label')); ?>
                            <div class="col-sm-9">
                                <?php 
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model' => $userModel,
                                    'attribute' => 's2_expiration',
                                    'options' => array(
                                        'dateFormat' => 'yy-mm-dd',
                                        'changeYear' => true,
                                        'changeMonth' => true,
                                        'yearRange' => '2025:2040',
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'form-control',
                                    ),
                                )); ?>
                                <?php echo $form->error($userModel,'s2_expiration'); ?>
                            </div>
                        </div>
                        
                    </div>
                </div> <?php endif; ?>

            <div class="form-group row mt-4">
                <div class="col-sm-9 offset-sm-3">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>