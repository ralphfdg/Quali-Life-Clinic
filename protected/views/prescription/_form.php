<?php
/* @var $this PrescriptionController */
/* @var $model Prescription */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prescription-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_account_id'); ?>
		<?php echo $form->textField($model,'patient_account_id'); ?>
		<?php echo $form->error($model,'patient_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doctor_account_id'); ?>
		<?php echo $form->textField($model,'doctor_account_id'); ?>
		<?php echo $form->error($model,'doctor_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'consultation_id'); ?>
		<?php echo $form->textField($model,'consultation_id'); ?>
		<?php echo $form->error($model,'consultation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prescription'); ?>
		<?php echo $form->textArea($model,'prescription',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'prescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_of_prescription'); ?>
		<?php echo $form->textField($model,'date_of_prescription'); ?>
		<?php echo $form->error($model,'date_of_prescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->