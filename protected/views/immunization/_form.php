<?php
/* @var $this ImmunizationController */
/* @var $model Immunization */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'immunization-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'col-lg-8'), // Constrain width for better look
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '<div class="alert alert-danger">', '</div>'); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<?php echo $form->labelEx($model, 'immunization'); ?>
				<?php echo $form->textField($model, 'immunization', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'immunization'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<?php echo $form->labelEx($model, 'description'); ?>
				<?php echo $form->textArea($model, 'description', array('rows' => 4, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'description'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<?php echo $form->labelEx($model, 'status_id'); ?>
				<?php
				// Use a dropdown list for status_id
				echo $form->dropDownList(
					$model,
					'status_id',
					array(1 => 'Active', 2 => 'Inactive'), // Assuming 1=Active, 2=Inactive based on schema
					array('class' => 'form-control')
				);
				?>
				<?php echo $form->error($model, 'status_id'); ?>
			</div>
		</div>
	</div>

	<div class="row buttons mt-4">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Vaccine' : 'Save Changes', array('class' => 'btn btn-primary shadow-sm')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>