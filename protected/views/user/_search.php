<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_id'); ?>
		<?php echo $form->textField($model,'account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'middlename'); ?>
		<?php echo $form->textField($model,'middlename',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qualifier'); ?>
		<?php echo $form->textField($model,'qualifier',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specialization'); ?>
		<?php echo $form->textField($model,'specialization',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specialization_id'); ?>
		<?php echo $form->textField($model,'specialization_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ptr_number'); ?>
		<?php echo $form->textField($model,'ptr_number',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'license_number'); ?>
		<?php echo $form->textField($model,'license_number',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'license_expiration'); ?>
		<?php echo $form->textField($model,'license_expiration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s2_number'); ?>
		<?php echo $form->textField($model,'s2_number',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s2_expiration'); ?>
		<?php echo $form->textField($model,'s2_expiration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maxicare_number'); ?>
		<?php echo $form->textField($model,'maxicare_number',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_of_father'); ?>
		<?php echo $form->textField($model,'name_of_father',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'father_dob'); ?>
		<?php echo $form->textField($model,'father_dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_of_mother'); ?>
		<?php echo $form->textField($model,'name_of_mother',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mother_dob'); ?>
		<?php echo $form->textField($model,'mother_dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school'); ?>
		<?php echo $form->textField($model,'school',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mother_contact_number'); ?>
		<?php echo $form->textField($model,'mother_contact_number',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'father_contact_number'); ?>
		<?php echo $form->textField($model,'father_contact_number',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->