<?php
/* @var $this SpecializationController */
/* @var $model Specialization */
/* @var $form CActiveForm */
?>

<div class="container-fluid">

    <div class="card shadow mb-4" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $model->isNewRecord ? 'Create Specialization' : 'Update Specialization'; ?></h6>
        </div>

        <div class="card-body">

            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'specialization-form',
                'enableAjaxValidation' => false,
            )); ?>

            <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger small')); ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'specialization_name'); ?>
                <?php echo $form->textField($model, 'specialization_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255, 'placeholder' => 'e.g. Pediatrics')); ?>
                <?php echo $form->error($model, 'specialization_name'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'status_id'); ?>
                <?php echo $form->dropDownList($model, 'status_id', array(1 => 'Active', 2 => 'Inactive'), array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'status_id'); ?>
            </div>

            <div class="form-group mt-4 text-right">
                <?php echo CHtml::link('Cancel', array('admin'), array('class' => 'btn btn-secondary mr-2')); ?>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save Changes', array('class' => 'btn btn-primary px-4')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>

</div>