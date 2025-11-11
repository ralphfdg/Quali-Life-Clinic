<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */
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
		<?php echo $form->label($model,'doctor_account_id'); ?>
		<?php echo $form->textField($model,'doctor_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'day_of_week'); ?>
		<?php echo $form->textField($model,'day_of_week'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_time'); ?>
		<?php echo $form->textField($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_time'); ?>
		<?php echo $form->textField($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->