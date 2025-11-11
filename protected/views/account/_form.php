<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128, 'value'=>'')); ?>
		<?php if (!$model->isNewRecord): ?>
			<p class="hint">Leave blank to keep the current password.</p>
		<?php endif; ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_address'); ?>
		<?php echo $form->textField($model,'email_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_type_id'); ?>
		<?php echo $form->dropDownList($model, 'account_type_id', 
			CHtml::listData(AccountType::model()->findAll(), 'id', 'type'),
			array('prompt'=>'Select Account Type')
		); ?>
		<?php echo $form->error($model,'account_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->dropDownList($model, 'status_id',
			CHtml::listData(Status::model()->findAll(), 'id', 'status'),
			array('prompt'=>'Select Status')
		); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'expiration_date'); ?>
		<?php // We should use a date picker here, but for now a text field is fine.
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'expiration_date',
			'options' => array(
				'dateFormat' => 'yy-mm-dd', // MySQL format
			),
			'htmlOptions' => array(
				'placeholder' => 'YYYY-MM-DD'
			),
		));
		?>
		<?php echo $form->error($model,'expiration_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>```

---

### Summary of This Step

You now have a functional Yii 1.1 application with:
* A secure login system that uses your database.
* Role-based access and navigation.
* The correct sidebar menu for all 4 user roles.
* A data-driven, unique dashboard for all 4 user roles.

**Next, we will build the core features one by one, starting with the Admin's "Appointment Calendar".**