<?php
/* @var $this DoctorScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
	'Doctor Schedules',
	'My Schedule',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">My Weekly Schedule</h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-plus"></i> Add New Slot', array('create'), array('class' => 'btn btn-sm btn-primary shadow-sm')); ?>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-info">
		<h6 class="m-0 font-weight-bold text-info">Current Active Hours</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'my-schedule-grid',
				'dataProvider' => $dataProvider,
				'itemsCssClass' => 'table table-hover',
				'summaryText' => '',
				'emptyText' => '<div class="text-center p-4 text-muted">You have not set any active schedule hours. Click "Add New Slot" to begin.</div>',
				'columns' => array(

					// 1. Day (Uses Model Helper)
					array(
						'name' => 'day_of_week',
						'header' => 'Day',
						'value' => '$data->getDayName()', // This uses the model helper you created
						'htmlOptions' => array('width' => '20%', 'font-weight' => 'bold'),
					),

					// 2. Start Time
					array(
						'name' => 'start_time',
						'header' => 'Start Time',
						'value' => 'date("g:i A", strtotime($data->start_time))',
						'htmlOptions' => array('width' => '20%'),
					),

					// 3. End Time
					array(
						'name' => 'end_time',
						'header' => 'End Time',
						'value' => 'date("g:i A", strtotime($data->end_time))',
						'htmlOptions' => array('width' => '20%'),
					),

					// 4. Status
					array(
						'name' => 'status_id',
						'header' => 'Status',
						'type' => 'raw',
						'value' => '($data->status_id == 1) ? "<span class=\"badge badge-success\">Active</span>" : "<span class=\"badge badge-danger\">Inactive</span>"',
						'htmlOptions' => array('style' => 'text-align:center; width:15%;'),
					),

					// 5. Actions (Edit/Delete)
					array(
						'class' => 'CButtonColumn',
						'header' => 'Actions',
						'template' => '{update} {delete}',
						'buttons' => array(
							'update' => array(
								'imageUrl' => false,
								'label' => '<i class="fas fa-edit"></i>',
								'options' => array('class' => 'btn btn-warning btn-sm mx-1', 'title' => 'Edit Slot'),
							),
							'delete' => array(
								'imageUrl' => false,
								'label' => '<i class="fas fa-trash"></i>',
								'options' => array('class' => 'btn btn-danger btn-sm', 'title' => 'Delete Slot'),
								'url' => 'Yii::app()->createUrl("doctorSchedule/delete", array("id"=>$data->id))',
								'click' => 'function(){return confirm("Are you sure you want to delete this schedule slot?");}'
							),
						),
						'htmlOptions' => array('style' => 'width: 100px; text-align:center;'),
					),
				),
			)); ?>
		</div>
	</div>
</div>