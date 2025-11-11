<?php
/* @var $this BillingController */
/* @var $model Billing */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'billing-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'appointment_id'); ?>
		<?php echo $form->textField($model,'appointment_id'); ?>
		<?php echo $form->error($model,'appointment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_account_id'); ?>
		<?php echo $form->textField($model,'patient_account_id'); ?>
		<?php echo $form->error($model,'patient_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_status'); ?>
		<?php echo $form->textField($model,'payment_status',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'payment_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_paid'); ?>
		<?php echo $form->textField($model,'date_paid'); ?>
		<?php echo $form->error($model,'date_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by_account_id'); ?>
		<?php echo $form->textField($model,'created_by_account_id'); ?>
		<?php echo $form->error($model,'created_by_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->