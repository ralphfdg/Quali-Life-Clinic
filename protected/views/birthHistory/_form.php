<?php
/* @var $this BirthHistoryController */
/* @var $model BirthHistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'birth-history-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'col-lg-8'), // Limit form width for better design
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model, '<div class="alert alert-danger">', '</div>'); ?>
    
    <?php echo $form->hiddenField($model,'account_id'); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model,'blood_type'); ?>
                <?php echo $form->textField($model,'blood_type', array('class' => 'form-control')); ?>
                <?php echo $form->error($model,'blood_type'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model,'term'); ?>
                <?php 
                      echo $form->dropDownList($model,'term', array('1' => 'Full Term', '2' => 'Pre-term', '3' => 'Post-term'), array('empty' => 'Select Term', 'class' => 'form-control')); 
                ?>
                <?php echo $form->error($model,'term'); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model,'type_of_delivery'); ?>
                <?php 
                      echo $form->dropDownList($model,'type_of_delivery', array('1' => 'NSVD', '2' => 'CS', '3' => 'Assisted'), array('empty' => 'Select Delivery Type', 'class' => 'form-control')); 
                ?>
                <?php echo $form->error($model,'type_of_delivery'); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model,'birth_weight'); ?>
                <?php echo $form->textField($model,'birth_weight', array('class' => 'form-control', 'placeholder' => 'kg')); ?>
                <?php echo $form->error($model,'birth_weight'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model,'birth_length'); ?>
                <?php echo $form->textField($model,'birth_length', array('class' => 'form-control', 'placeholder' => 'cm')); ?>
                <?php echo $form->error($model,'birth_length'); ?>
            </div>
        </div>
        </div>

    <div class="row buttons mt-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Record' : 'Save Changes', array('class' => 'btn btn-primary shadow-sm')); ?>
    </div>

<?php $this->endWidget(); ?>

</div>
