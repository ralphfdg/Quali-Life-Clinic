<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $model->isNewRecord ? 'Create New Account' : 'Update Account'; ?></h6>
        </div>
        
        <div class="card-body">

            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'account-form',
                'enableAjaxValidation'=>false,
            )); ?>

                <p class="note">Fields with <span class="required">*</span> are required.</p>

                <?php echo $form->errorSummary($model); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'username'); ?>
                    <?php echo $form->textField($model,'username',array('class'=>'form-control', 'size'=>60,'maxlength'=>128)); ?>
                    <?php echo $form->error($model,'username'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'password'); ?>
                    <?php echo $form->passwordField($model,'password',array('class'=>'form-control', 'size'=>60,'maxlength'=>128, 'value'=>'')); ?>
                    <?php if (!$model->isNewRecord): ?>
                        <p class="hint">Leave blank to keep the current password.</p>
                    <?php endif; ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'email_address'); ?>
                    <?php echo $form->textField($model,'email_address',array('class'=>'form-control', 'size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'email_address'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'account_type_id'); ?>
                    <?php 
                    // Use a hidden field to pass the fixed value 2 to the server
                    echo $form->hiddenField($model, 'account_type_id', array('value' => 3)); 
                    // Display a read-only field for user reference
                    echo CHtml::textField('AccountTypeFixed', 'Doctor', array('class' => 'form-control', 'readonly' => 'readonly', 'style' => 'background-color: #f8f9fc;'));
                    ?>
                    <?php echo $form->error($model,'account_type_id'); ?>
                </div>
                
                <div class="form-group">
                    <?php echo $form->labelEx($model,'status_id'); ?>
                    <?php 
                    // Replaced the dropdown with a standard text field
                    echo $form->textField($model,'status_id', array('class'=>'form-control')); 
                    ?>
                    <?php echo $form->error($model,'status_id'); ?>
                </div>
                
                <div class="form-group">
                    <?php echo $form->labelEx($model,'expiration_date'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'expiration_date',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', // MySQL format
                        ),
                        'htmlOptions' => array(
                            'placeholder' => 'YYYY-MM-DD',
                            'class' => 'form-control', // Apply Bootstrap class
                        ),
                    ));
                    ?>
                    <?php echo $form->error($model,'expiration_date'); ?>
                </div>

                <div class="row buttons mt-4">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary btn-block')); ?>
                </div>

            <?php $this->endWidget(); ?>
        
        </div> </div> </div> ```
