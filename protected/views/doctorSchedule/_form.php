<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-schedule-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'doctor_account_id'); ?>
		<?php 
			// Fetch all active doctors for the dropdown
			// We join with 'user' to get their real names
			$doctors = Account::model()->with('user')->findAll('account_type_id=3 AND status_id=1');
			$doctorList = CHtml::listData($doctors, 'id', function($account) {
				return 'Dr. ' . $account->user->firstname . ' ' . $account->user->lastname;
			});
			
			echo $form->dropDownList($model, 'doctor_account_id', $doctorList, array('prompt'=>'Select a Doctor'));
		?>
		<?php echo $form->error($model,'doctor_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day_of_week'); ?>
		<?php 
			// Use the helper method from the model
			echo $form->dropDownList($model, 'day_of_week', $model->getDayOptions(), array('prompt'=>'Select Day')); 
		?>
		<?php echo $form->error($model,'day_of_week'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->timeField($model,'start_time',array('size'=>60,'maxlength'=>60, 'placeholder'=>'09:00:00')); ?>
		<div class="hint">Format: HH:MM (e.g., 09:00 or 14:30)</div>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php echo $form->timeField($model,'end_time',array('size'=>60,'maxlength'=>60, 'placeholder'=>'17:00:00')); ?>
		<div class="hint">Format: HH:MM (e.g., 17:00 or 18:00)</div>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->dropDownList($model, 'status_id', 
			CHtml::listData(Status::model()->findAll(), 'id', 'status')
		); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Schedule' : 'Save Changes'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>

<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

$this->breadcrumbs=array(
	'Doctor Schedules'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create New Schedule', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#doctor-schedule-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Doctor Schedules</h1>

<p>
You can optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctor-schedule-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// Custom Column: Doctor Name
		array(
			'header'=>'Doctor',
			'name'=>'doctor_account_id',
			'value'=>'$data->doctorAccount->user->firstname . " " . $data->doctorAccount->user->lastname',
			'filter'=>CHtml::listData(Account::model()->with('user')->findAll('account_type_id=3'), 'id', function($acc){
				return $acc->user->firstname . ' ' . $acc->user->lastname;
			}),
		),
		// Custom Column: Day of Week (Mapped)
		array(
			'name'=>'day_of_week',
			'value'=>'$data->getDayName()',
			'filter'=>$model->getDayOptions(),
		),
		array(
			'name'=>'start_time',
			'value'=>'date("g:i A", strtotime($data->start_time))',
		),
		array(
			'name'=>'end_time',
			'value'=>'date("g:i A", strtotime($data->end_time))',
		),
		array(
			'name'=>'status_id',
			'value'=>'$data->status->status',
			'filter'=>CHtml::listData(Status::model()->findAll(), 'id', 'status'),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>