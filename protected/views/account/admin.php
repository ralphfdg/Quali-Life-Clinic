<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Create Account', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#account-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Accounts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'account-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'email_address',
		// 'password', // Removed for security
		// 'salt',     // Removed for security
		array(
			'name'=>'account_type_id',
			'header'=>'Account Type',
			'value'=>'$data->accountType->type', // Uses the relation defined in Account.php
			'filter'=>CHtml::listData(AccountType::model()->findAll(), 'id', 'type'), // Creates a dropdown filter
		),
		array(
			'name'=>'status_id',
			'header'=>'Status',
			'value'=>'$data->status->status', // Uses the relation
			'filter'=>CHtml::listData(Status::model()->findAll(), 'id', 'status'), // Creates a dropdown filter
		),
		'date_created',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
