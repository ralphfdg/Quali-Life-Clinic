<?php
/* @var $this BillingController */
/* @var $model Billing */
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
		<?php echo $form->label($model,'appointment_id'); ?>
		<?php echo $form->textField($model,'appointment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_account_id'); ?>
		<?php echo $form->textField($model,'patient_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payment_status'); ?>
		<?php echo $form->textField($model,'payment_status',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_paid'); ?>
		<?php echo $form->textField($model,'date_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by_account_id'); ?>
		<?php echo $form->textField($model,'created_by_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->