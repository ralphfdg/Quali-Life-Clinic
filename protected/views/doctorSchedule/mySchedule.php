<?php
/* @var $this DoctorScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctor Schedules'=>array('index'),
	'My Schedule',
);

// Only show "Create" if you want doctors to add their own slots
$this->menu=array(
    // array('label'=>'Create Schedule', 'url'=>array('create')),
);
?>

<h1>My Weekly Schedule</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'my-schedule-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'day_of_week',
			'header'=>'Day',
			'value'=>'$data->getDayName()', // Uses the helper we saw in your Model
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
			'name'=>'status.status_name',
			'header'=>'Status',
		),
	),
)); ?>