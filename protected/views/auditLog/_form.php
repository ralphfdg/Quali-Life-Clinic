<?php
/* @var $this AuditLogController */
/* @var $model AuditLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'audit-log-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_account_id'); ?>
		<?php echo $form->textField($model,'user_account_id'); ?>
		<?php echo $form->error($model,'user_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'target_entity'); ?>
		<?php echo $form->textField($model,'target_entity',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'target_entity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'target_id'); ?>
		<?php echo $form->textField($model,'target_id'); ?>
		<?php echo $form->error($model,'target_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'details'); ?>
		<?php echo $form->textArea($model,'details',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'details'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip_address'); ?>
		<?php echo $form->textField($model,'ip_address',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ip_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->