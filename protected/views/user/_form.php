<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'account_id'); ?>
		<?php echo $form->textField($model,'account_id'); ?>
		<?php echo $form->error($model,'account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'middlename'); ?>
		<?php echo $form->textField($model,'middlename',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'middlename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qualifier'); ?>
		<?php echo $form->textField($model,'qualifier',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'qualifier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specialization'); ?>
		<?php echo $form->textField($model,'specialization',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'specialization'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specialization_id'); ?>
		<?php echo $form->textField($model,'specialization_id'); ?>
		<?php echo $form->error($model,'specialization_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ptr_number'); ?>
		<?php echo $form->textField($model,'ptr_number',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'ptr_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'license_number'); ?>
		<?php echo $form->textField($model,'license_number',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'license_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'license_expiration'); ?>
		<?php echo $form->textField($model,'license_expiration'); ?>
		<?php echo $form->error($model,'license_expiration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s2_number'); ?>
		<?php echo $form->textField($model,'s2_number',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'s2_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s2_expiration'); ?>
		<?php echo $form->textField($model,'s2_expiration'); ?>
		<?php echo $form->error($model,'s2_expiration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maxicare_number'); ?>
		<?php echo $form->textField($model,'maxicare_number',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'maxicare_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
    <?php echo $form->labelEx($model,'mobile_number'); ?> 
    <?php echo $form->textField($model,'mobile_number',array('size'=>11,'maxlength'=>11, 'placeholder'=>'09...')); ?>
    <?php echo $form->error($model,'mobile_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_of_father'); ?>
		<?php echo $form->textField($model,'name_of_father',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name_of_father'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'father_dob'); ?>
		<?php echo $form->textField($model,'father_dob'); ?>
		<?php echo $form->error($model,'father_dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_of_mother'); ?>
		<?php echo $form->textField($model,'name_of_mother',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name_of_mother'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mother_dob'); ?>
		<?php echo $form->textField($model,'mother_dob'); ?>
		<?php echo $form->error($model,'mother_dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school'); ?>
		<?php echo $form->textField($model,'school',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'school'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mother_contact_number'); ?>
		<?php echo $form->textField($model,'mother_contact_number',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'mother_contact_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'father_contact_number'); ?>
		<?php echo $form->textField($model,'father_contact_number',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'father_contact_number'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->