<?php
/* @var $this BirthHistoryController */
/* @var $model BirthHistory */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'birth-history-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'col-lg-8'), // Limit form width for better design
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model, '<div class="alert alert-danger">', '</div>'); ?>

    <?php echo $form->hiddenField($model, 'account_id'); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model,'blood_type'); ?>
                <?php 
                    // Use the centralized helper function to populate the dropdown
                    echo $form->dropDownList($model, 'blood_type', 
                        $model->getBloodTypeOptions(), // Calls the method defined in the model
                        array('empty' => 'Select Blood Type', 'class' => 'form-control')
                    ); 
                ?>
                <?php echo $form->error($model,'blood_type'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'term'); ?>
                <?php
                echo $form->dropDownList($model, 'term', array('1' => 'Full Term', '2' => 'Pre-term', '3' => 'Post-term'), array('empty' => 'Select Term', 'class' => 'form-control'));
                ?>
                <?php echo $form->error($model, 'term'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'type_of_delivery'); ?>
                <?php
                echo $form->dropDownList($model, 'type_of_delivery', array('1' => 'NSVD', '2' => 'CS', '3' => 'Assisted'), array('empty' => 'Select Delivery Type', 'class' => 'form-control'));
                ?>
                <?php echo $form->error($model, 'type_of_delivery'); ?>
            </div>
        </div>
    </div>

    <hr class="my-4">
    <h6 class="text-primary font-weight-bold mb-3">Measurements (in kg / cm)</h6>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'birth_weight'); ?>
                <?php echo $form->textField($model, 'birth_weight', array('class' => 'form-control', 'placeholder' => 'Weight (kg)')); ?>
                <?php echo $form->error($model, 'birth_weight'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'birth_length'); ?>
                <?php echo $form->textField($model, 'birth_length', array('class' => 'form-control', 'placeholder' => 'Length (cm)')); ?>
                <?php echo $form->error($model, 'birth_length'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'birth_head_circumference'); ?>
                <?php echo $form->textField($model, 'birth_head_circumference', array('class' => 'form-control', 'placeholder' => 'Head Circumference (cm)')); ?>
                <?php echo $form->error($model, 'birth_head_circumference'); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'birth_chest_circumference'); ?>
                <?php echo $form->textField($model, 'birth_chest_circumference', array('class' => 'form-control', 'placeholder' => 'Chest Circumference (cm)')); ?>
                <?php echo $form->error($model, 'birth_chest_circumference'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'birth_abdominal_circumference'); ?>
                <?php echo $form->textField($model, 'birth_abdominal_circumference', array('class' => 'form-control', 'placeholder' => 'Abdominal Circumference (cm)')); ?>
                <?php echo $form->error($model, 'birth_abdominal_circumference'); ?>
            </div>
        </div>
    </div>

    <div class="row buttons mt-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Record' : 'Save Changes', array('class' => 'btn btn-primary shadow-sm')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>