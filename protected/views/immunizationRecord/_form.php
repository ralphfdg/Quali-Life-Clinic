<?php
/* @var $this ImmunizationRecordController */
/* @var $model ImmunizationRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'immunization-record-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'col-lg-10'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model, '<div class="alert alert-danger">', '</div>'); ?>

    <?php echo $form->hiddenField($model,'account_id'); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model,'immunization_id'); ?>
                <?php 
                    echo $form->dropDownList($model, 'immunization_id', 
                        CHtml::listData(Immunization::model()->findAll(), 'id', 'immunization'),
                        array('empty' => 'Select Immunization', 'class' => 'form-control')
                    ); 
                ?>
                <?php echo $form->error($model,'immunization_id'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model,'date'); ?>
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'date',
                        'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'showAnim'=>'fold',
                            'maxDate'=>'0',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-control',
                            'style'=>'height:34px;'
                        ),
                    ));
                ?>
                <?php echo $form->error($model,'date'); ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo $form->labelEx($model,'remarks'); ?>
                <?php echo $form->textArea($model,'remarks',array('rows'=>6, 'class' => 'form-control')); ?>
                <?php echo $form->error($model,'remarks'); ?>
            </div>
        </div>
    </div>
    
    <div class="row buttons mt-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Record' : 'Save Changes', array('class' => 'btn btn-primary shadow-sm')); ?>
    </div>

<?php $this->endWidget(); ?>

</div>
