<?php
/* @var $this BillingController */
/* @var $model Billing */
/* @var $form CActiveForm */
/* @var $availableAppointments array */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'billing-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'appointment_id'); ?>
		<?php 
		if ($model->isNewRecord) {
			// Create a user-friendly list for the dropdown
			$appointmentList = CHtml::listData($availableAppointments, 'id', function($app) {
				return sprintf('%s - Dr. %s - %s', 
					date("M j, Y g:i A", strtotime($app->schedule_datetime)),
					$app->doctorAccount->user->lastname,
					$app->patientAccount->user->firstname . ' ' . $app->patientAccount->user->lastname
				);
			});
			
			echo $form->dropDownList($model, 'appointment_id', $appointmentList, 
				array('prompt'=>'Select a completed appointment...')
			);
		} else {
			// If updating, just show the appointment info as text
			echo CHtml::textField(
				'appointment_info', 
				sprintf('%s - Dr. %s - %s', 
					date("M j, Y g:i A", strtotime($model->appointment->schedule_datetime)),
					$model->appointment->doctorAccount->user->lastname,
					$model->patientAccount->user->firstname . ' ' . $model->patientAccount->user->lastname
				),
				array('disabled'=>true, 'style'=>'width: 400px;')
			);
			echo $form->hiddenField($model, 'appointment_id');
		}
		?>
		<?php echo $form->error($model,'appointment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_status'); ?>
		<?php echo $form->dropDownList($model, 'payment_status', 
			array('Pending'=>'Pending', 'Paid'=>'Paid', 'Waived'=>'Waived')
		); ?>
		<?php echo $form->error($model,'payment_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<?php if (!$model->isNewRecord): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'date_paid'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'date_paid',
			'options' => array(
				'dateFormat' => 'yy-mm-dd', // MySQL format
			),
			'htmlOptions' => array(
				'placeholder' => 'YYYY-MM-DD (Set automatically if "Paid")'
			),
		)); ?>
		<?php echo $form->error($model,'date_paid'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Bill' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>```
<hr>

### 4. `protected/views/billing/view.php`

Finally, I've updated the "View" page to show the related names instead of IDs.

```php
<?php
/* @var $this BillingController */
/* @var $model Billing */

$this->breadcrumbs=array(
	'Billings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Billing', 'url'=>array('index')),
	array('label'=>'Create Billing', 'url'=>array('create')),
	array('label'=>'Update Billing', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Billing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Billing', 'url'=>array('admin')),
);
?>

<h1>View Billing #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Patient',
			'value'=>$model->patientAccount->user ? $model->patientAccount->user->firstname . " " . $model->patientAccount->user->lastname : "N/A",
		),
		array(
			'label'=>'Appointment',
			'value'=>$model->appointment ? date("M j, Y g:i A", strtotime($model->appointment->schedule_datetime)) : "N/A",
		),
		array(
			'label'=>'Doctor',
			'value'=>$model->appointment->doctorAccount->user ? "Dr. " . $model->appointment->doctorAccount->user->lastname : "N/A",
		),
		'amount',
		'payment_status',
		'date_created',
		'date_paid',
		array(
			'label'=>'Billed By',
			'value'=>$model->createdByAccount ? $model->createdByAccount->username : "N/A",
		),
		'notes',
	),
)); ?>