<?php
/* @var $this SpecializationController */
/* @var $model Specialization */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'specialization-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'specialization_name'); ?>
		<?php echo $form->textField($model,'specialization_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'specialization_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->dropDownList($model, 'status_id',
			CHtml::listData(Status::model()->findAll(), 'id', 'status'),
			array('prompt'=>'Select Status')
		); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>

<?php
/* @var $this SpecializationController */
/* @var $model Specialization */

$this->breadcrumbs=array(
	'Specializations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Specialization', 'url'=>array('index')),
	array('label'=>'Create Specialization', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#specialization-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Specializations</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'specialization-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'specialization_name',
		array(
			'name'=>'status_id',
			'header'=>'Status',
			'value'=>'$data->status->status', // Use the 'status' relation
			'filter'=>CHtml::listData(Status::model()->findAll(), 'id', 'status'),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>